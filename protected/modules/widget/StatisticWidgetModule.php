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
        return $postData;
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