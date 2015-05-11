<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.04.2015
 * Time: 8:22
 */
class ProjectTicketsWidgetModule extends AbstractWidgetModule {

    protected $_config = array(
        'graph_id' => GRAPH_CHART_BAR,
        'projects' => null
    );

    public function getTitle() {
        return 'Project statistics';
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
            Yii::app()->controller->renderPartial('//modules/widget/projectTickets/_view', array(
                'graph' => $graph,
            ));
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }

    public function convertPostToConfigure($postData) {
        return $postData;
    }

    protected function _getData() {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'pagesCount' => array('on' => 'pagesCount.page_type_id in :page_types')
        );
        $criteria->compare('t.id',$this->_config['projects']);
        $projects = Project::model()->findAll($criteria);
        $result = array();
        foreach ($projects as $project) {
            $result[] = new GraphData(
                $project->title,
                array('tickets' => (int)$project->pagesCount)
            );
        }
        return $result;
    }
}