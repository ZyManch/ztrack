<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 14:27
 * @var Error $error
 */ 
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>System</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-md-6">
                <?php
                $oss = $error->getGroupedOs();
                $graph = Graph::model()->findByPk(GRAPH_CHART_PIE);
                foreach ($oss as $os) {
                    $graph->addData(new GraphData($os->os,array(intval($os->count))));
                }
                echo $graph->render(array('style'=>'width:100%;height:200px'));
                ?>
            </div>
            <div class="col-md-6">
                <?php
                $browsers = $error->getGroupedBrowsers();
                $graph = Graph::model()->findByPk(GRAPH_CHART_PIE);
                foreach ($browsers as $browser) {
                    $graph->addData(new GraphData($browser->browser,array(intval($browser->count))));
                }
                echo $graph->render(array('style'=>'width:100%;height:200px'));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $countries = $error->getGroupedByCountryRequest();
                $data = new GraphData(
                    'Countries',
                    CHtml::listData($countries,'country.code','count')
                );
                $graph = new WorldMap($data);
                $graph->setHtmlOptions(array('style'=>'height:200px'));
                echo $graph;
                ?>
            </div>
        </div>
    </div>
</div>