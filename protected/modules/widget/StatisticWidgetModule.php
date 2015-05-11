<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 08.04.2015
 * Time: 11:18
 */
class StatisticWidgetModule  extends AbstractWidgetModule {

    protected $_columns = array();

    protected $_config = array(
        'graph_id' => GRAPH_CHART_LINE,
    );

    public function getTitle() {
        return 'Statistic';
    }


    public function configure($config) {
        $this->_config = array_merge(
            $this->_config,
            $config
        );
    }


    protected function _renderWidget() {
        /** @var GraphAbstract $graph */
        $graph = Graph::model()->findByPk($this->_config['graph_id']);
        foreach ($this->_getData() as $row) {
            $graph->addData($row);
        }
        try {
            Yii::app()->controller->renderPartial(
                '//modules/widget/statistic/_view',
                array(
                    'graph' => $graph,
                )
            );
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }

    public function convertPostToConfigure($postData) {
        $result = array(
            'graph_id' => null,
            'statistic_id' => null,
            'axis-x' => array(),
            'axis-y' => array(),
            'filter' => array(),
        );
        foreach (array('graph_id','statistic_id') as $field) {
            if (!is_numeric($postData[$field])) {
                throw new Exception($field.' must be as number');
            }
            $result[$field] = (int)$postData[$field];
        }
        $statId = $result['statistic_id'];
        $stat = Statistic::model()->findByAttributes(array(
            'id' => $statId,
            'company_id' => Yii::app()->user->getUser()->company_id
        ));
        if (!$stat) {
            throw new Exception('Statistic not found');
        }
        $axisXList = (isset($postData[$statId]['axis-x']) ? $postData[$statId]['axis-x'] : array());
        $axisYList = (isset($postData[$statId]['axis-y']) ? $postData[$statId]['axis-y'] : array());
        $filterList = (isset($postData[$statId]['filter']) ? $postData[$statId]['filter'] : array());
        if (!is_array($axisXList) || !is_array($axisYList) || !is_array($filterList)) {
            throw new Exception('Wrong Axis or Filter format');
        }
        $columns = $stat->statisticColumns;
        $column = (int)$axisXList['column'];
        if (!isset($columns[$column])) {
            throw new Exception('Column '.$column.' not found');
        }
        $result['axis-x'] = array(
            'column' => $column,
            'format' => $axisXList[$columns[$column]->type]
        );
        foreach ($axisYList as $index => $axisY) {
            if (is_numeric($index)) {
                $column = (int)$axisY['column'];
                if (!isset($columns[$column])) {
                    throw new Exception('Column '.$column.' not found');
                }
                $result['axis-y'][] = array(
                    'column' => $column,
                    'format' => $axisY[$columns[$column]->type]
                );
            }
        }
        foreach ($filterList as $index => $filter) {
            if (is_numeric($index)) {
                $column = (int)$filter['column'];
                if (!isset($columns[$column])) {
                    throw new Exception('Column '.$column.' not found');
                }
                $result['filter'][] = array(
                    'value' => $filter['value'],
                    'column' => $column,
                    'comparison' => $filter[$columns[$column]->type]
                );
            }
        }
        return $result;
    }

    protected function _getData() {
        $availableStats = Yii::app()->user->getUser()->getAvailableStatistics();
        if (!isset($availableStats[$this->_config['statistic_id']])) {
            throw new Exception('You haven`t access to this statistic');
        }
        /** @var Statistic $stat */
        $stat = $availableStats[$this->_config['statistic_id']];
        $dataRows = $this->_getDataRow($stat);
        $result = array();
        foreach ($this->_config['axis-y'] as $index => $axisY) {
            $label = $stat->statisticColumns[$axisY['column']]->label;
            $filterClass = ucfirst($axisY['format']).'DataFormatter';
            /** @var AbstractDataFormatter $filter */
            $filter = new $filterClass(null);
            $result[] = new GraphData(
                $filter->formatLabel($label),
                CHtml::listData($dataRows,'value_key','value_'.$index)
            );
        }

        return $result;
    }

    protected function _getDataRow(Statistic $statistic) {
        $select = array();
        $query = Yii::app()->db->createCommand();
        $query->from('statistic_point t');
        $axisX = $this->_config['axis-x'];
        $this->_joinStatData($statistic,$query,$axisX['column']);
        $filterClass = ucfirst($axisX['format']).'DataFormatter';
        $filter = new $filterClass(
            sprintf('col%d.value',$axisX['column'])
        );
        $select[] = $filter.' as value_key';
        $query->group(array((string)$filter));
        $query->order($filter.' ASC');
        foreach ($this->_config['axis-y'] as $index => $axisY) {
            $this->_joinStatData($statistic,$query,$axisY['column']);
            $filterClass = ucfirst($axisY['format']).'DataFormatter';
            $filter = new $filterClass(
                sprintf('col%d.value',$axisY['column'])
            );
            $select[] = $filter.' as value_'.$index;
        }
        foreach ($this->_config['filter'] as $filter) {
            $this->_joinStatData($statistic,$query,$filter['column']);
            $dataFilterClass = ucfirst($filter['comparison']).'DataFilter';
            /** @var AbstractDataFilter $dataFilter */
            $dataFilter = new $dataFilterClass($filter['value']);
            $dataFilter->applyToQuery(
                $query,
                sprintf('col%d.value',$filter['column'])
            );
        }

        $query->select($select);
        return $query->queryAll();
    }

    protected function _joinStatData(Statistic $statistic, CDbCommand $query, $column) {
        if (in_array($column,$this->_columns)) {
            return false;
        }
        if (!isset($statistic->statisticColumns[$column])) {
            throw new Exception('Column '.$column.' not found');
        }
        $this->_columns[] = $column;
        $columnInfo = $statistic->statisticColumns[$column];
        $query->leftJoin(
            sprintf('statistic_data_%s col%d',strtolower($columnInfo->type),$column),
            sprintf('col%1$d.statistic_point_id=t.id AND col%1$d.statistic_column_id=%1$d',$column)
        );
        return true;
    }
}