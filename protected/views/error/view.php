<?php
/* @var $this ErrorController */
/* @var $model Error */

?>
<div class="wrapper wrapper-content">
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo CHtml::encode($model->title); ?></h5>
            </div>
            <div class="ibox-content">
                <table class="table table-responsive table-bordered">
                    <colgroup>
                        <col width="150px">
                        <col>
                    </colgroup>
                    <tr>
                        <th style="text-align: right">Level</th>
                        <td><?php echo $model->level->title;?></td>
                    </tr>
                    <tr>
                        <th style="text-align: right">Project</th>
                        <td><?php echo $model->project ? CHtml::encode($model->project->title) : '-';?></td>
                    </tr>
                    <tr>
                        <th style="text-align: right">Error count</th>
                        <td><?php echo $model->total_count;?></td>
                    </tr>
                    <tr>
                        <th style="text-align: right">Last error</th>
                        <td><?php echo $model->changed;?></td>
                    </tr>
                </table>
                <div>
                <?php
                $graph = new ChartBarGraph();
                $requests = $model->getGroupedByDateRequest();
                $graph->addData(new GraphData(
                    'Errors',
                    CHtml::listData($requests,'changed','count')
                ));
                echo $graph->render(array('style'=>'width:100%;height:200px'));
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Система</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        $oss = $model->getGroupedOs();
                        $graph = new ChartPieGraph();
                        foreach ($oss as $os) {
                            $graph->addData(new GraphData($os->os,array(intval($os->count))));
                        }
                        echo $graph->render(array('style'=>'width:100%;height:200px'));
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $browsers = $model->getGroupedBrowsers();
                        $graph = new ChartPieGraph();
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
                        $countries = $model->getGroupedByCountryRequest();
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
    </div>
</div>

