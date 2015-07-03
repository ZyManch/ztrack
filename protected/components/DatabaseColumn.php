<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 03.07.2015
 * Time: 13:54
 * @property $name
 * @property $type
 * @property $size
 * @property $params
 * @property $null
 * @property $key
 * @property $default
 * @property $ai
 * @property $attr
 * @property $default_type
 */
class DatabaseColumn {

    const REGEXP_VALID_STRING = '/^[a-zA-Z0-9]*$/';

    const DEFAULT_TYPE_NO = 'no';
    const DEFAULT_TYPE_VALUE = 'value';
    const DEFAULT_TYPE_NULL = 'null';
    const DEFAULT_TYPE_TIMESTAMP = 'timestamp';

    protected $_data = array(
        'name' => null,
        'type' => null,
        'size' => null,
        'params' => array(),
        'null' => null,
        'key' => '',
        'default' => null,
        'ai' => false,
        'attr' => '',
        'default_type' => null,
    );

    public function __set($key, $value) {
        switch ($key) {
            case 'null':
            case 'ai':
                $value = (bool)$value;
                break;
            case 'key':
                $value = (string)$value;
                break;
            case 'params':
                break;
            case 'size':
                if (in_array($this->type, array('enum', 'set'))) {

                }
                break;
            default:
                if (!preg_match(self::REGEXP_VALID_STRING, $value)) {
                    throw new Exception('Wrong value for ' . $key . ' column:' . $value);
                }
        }
        if(array_key_exists($key, $this->_data)) {
            $this->_data[$key] = $value;
        }
    }

    public function __get($key) {
        if(!array_key_exists($key, $this->_data)) {
            throw new Exception('Undefined property '.$key);
        }
        return $this->_data[$key];
    }

    public function getSizeVariant() {
        $size = array_map(
            function($value) {return trim($value,"'");},
            explode(',',$this->size)
        );
        return array_combine($size, $size);
    }

    public function isSizeIsElements() {
        return in_array($this->type,array('enum','set'));
    }

    public static function create($attributes = array()) {
        $column = new self();
        foreach ($attributes as $key => $val) {
            $column->$key = $val;
        }
        return $column;
    }

    public function isEqual(DatabaseColumn $column) {
        return $this->name == $column->name &&
            $this->type == $column->type &&
            $this->size == $column->size &&
            $this->null == $column->null &&
            $this->default == $column->default &&
            $this->ai == $column->ai &&
            $this->default_type == $column->default_type &&
            $this->attr == $column->attr;
    }

    public function __toString() {
        $default = '';
        switch ($this->default_type) {
            case self::DEFAULT_TYPE_NULL:
                $default = 'DEFAULT NULL';
                break;
            case self::DEFAULT_TYPE_TIMESTAMP:
                $default = 'DEFAULT TIMESTAMP';
                break;
            case self::DEFAULT_TYPE_VALUE:
                $default = sprintf('DEFAULT %s',Yii::app()->db->quoteValue($this->default));
                break;
        }
        return sprintf(
            '`%s` %s %s  %s %s %s %s',
            $this->name,
            strtoupper($this->type),
            $this->size ? '('.$this->size.')' : '',
            $this->attr,
            $this->null ? 'NULL' : 'NOT NULL',
            $default,
            $this->ai ? 'AUTO_INCREMENT' : ''

        );
    }

}