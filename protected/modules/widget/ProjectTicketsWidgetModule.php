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

    public function configure($config) {
        $this->_config = array_merge(
            $this->_config,
            $config
        );
    }


    public function draw() {
        /** @var GraphAbstract $graph */
        $graph = Graph::model()->findByPk($this->_config['graph_id']);
        foreach ($this->_getData() as $row) {
            $graph->addData($row);
        }
        Yii::app()->controller->renderPartial(
            '//modules/widget/project/_view',
            array(
                'graph' => $graph,
            )
        );
    }

    protected function _getData() {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'pagesCount' => array('on' => 'pagesCount.page_type_id in :page_types')
        );
        $criteria->params[':page_types'] = array(
            PAGE_TYPE_TICKETS
        );
        $criteria->compare('t.project_id',$this->_config['projects']);
        $projects = Project::model()->findAll($criteria);
        $result = array();
        foreach ($projects as $project) {
            $result[] = new GraphData(
                $project->title,
                array('tickets' => $project->pagesCount)
            );
        }
        return $result;
    }
}