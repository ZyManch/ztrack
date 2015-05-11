<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 12:24
 * @var StatisticWidgetModule $system_module
 * @var Statistic $statistic
 * @var $valueColumn
 * @var $valueType
 * @var $valueFormat
 * @var $index
 */
$clientScript =Yii::app()->clientScript;
$clientScript->registerScript(
    'axis-y',
    'var changeFilterForAxesY =  function (checkBox) {
        var $this = $(checkBox),
            $row = $this.parents(".form-group"),
            statId = $this.data("statistic"),
            columnType;
        $row.find(".axis-filter").hide();
        columnType = window.statColumns[statId][$this.val()];
        $row.find(".axis-filter-"+columnType).show();

    };',
    CClientScript::POS_END
);
$statColumns = array();
foreach ($statistic->statisticColumns as $column) {
    $statColumns[$column->id] = $column->type;
}
$clientScript->registerScript(
    'column-'.$statistic->id,
    'if (typeof window.statColumns == "undefined") {
        window.statColumns = {};
    }
    window.statColumns['.$statistic->id.'] = '.json_encode($statColumns).';'
)
?>
<div class="form-group">
    <?php echo CHtml::label(
        'Axis Y',
        'axis-y-'.$index.'-'.$statistic->id,
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-2">
        <?php foreach (StatisticColumn::getAvailableTypes() as $type => $column):?>
            <?php echo CHtml::dropDownList(
                'config['.$statistic->id.'][axis-y]['.$index.']['.$type.']',
                $valueFormat,
                $column->getFormatList(),
                array(
                    'class'=>'form-control axis-filter axis-filter-'.$type,
                    'style'=>$valueType == $type ? '' : 'display:none'
                )
            ); ?>
        <?php endforeach;?>
    </div>
    <div class="col-sm-7">
        <?php echo CHtml::dropDownList(
            'config['.$statistic->id.'][axis-y]['.$index.'][column]',
            $valueColumn,
            CHtml::listData($statistic->statisticColumns,'id','label'),
            array(
                'id' => 'axis-y-'.$index.'-'.$statistic->id,
                'class'=>'form-control',
                'data-statistic'=>$statistic->id,
                'data-index'=>$index,
                'onchange' => 'changeFilterForAxesY(this)'
            )
        ); ?>
    </div>
</div>