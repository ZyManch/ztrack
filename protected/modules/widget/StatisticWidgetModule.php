<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 08.04.2015
 * Time: 11:18
 */
class StatisticWidgetModule  extends AbstractWidgetModule {

    protected $_config = array(
        'graph_id' => GRAPH_CHART_LINE,
    );

    public function getTitle() {
        return 'Статистика';
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
        $stats = Statistic::model()->findAllByPk($this->_config['statistics']);
        $result = array();
        foreach ($stats as $stat) {
            $result[] = new GraphData(
                $stat->name,
                $stat->getLastPoints($this->_config['count'])
            );
        }
        return $result;
    }
}