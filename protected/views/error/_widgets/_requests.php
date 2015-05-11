<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 14:29
 * @var Error $error
 */
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Last errors</h5>
    </div>
    <div class="ibox-content">
        <?php
        $search = $error->getRequestSearch();
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'error-grid',
            'dataProvider'=>$search->search(),
            'template'=>'{items} {summary} {pager}',
            'itemsCssClass' => 'table table-hover',
            'htmlOptions' => array('class'=>'project-list'),
            'columns'=>array(
                array(
                    'name' => 'changed',
                    'value' => function(Request $error) {
                        $timestamp = strtotime($error->changed);
                        $today = strtotime(date('Y-m-d 00:00:00'));
                        return Yii::app()->dateFormatter->formatDateTime(
                            $timestamp,
                            $timestamp < $today ? 'short' : false,
                            'medium'
                        );
                    }
                ),
                array(
                    'name'=>'browser_id',
                    'type' => 'raw',
                    'value'=>function(Request $error) {
                        return CHtml::tag(
                            'div',
                            array(

                            ),
                            $error->browser->browser.' '.$error->browser->version
                        );
                    }
                ),
                array(
                    'name'=>'os_id',
                    'type' => 'raw',
                    'value'=>function(Request $error) {
                        return CHtml::tag(
                            'div',
                            array(

                            ),
                            $error->os->os.' '.$error->os->version
                        );
                    }
                ),
                array(
                    'name'=>'user_ip',
                    'type' => 'raw',
                    'value'=>function(Request $error) {
                        return CHtml::tag(
                            'div',
                            array(

                            ),
                            long2ip($error->user_ip)
                        );
                    }
                ),
                array(
                    'name'=>'method_id',
                    'value'=>function(Request $error) {
                        return $error->method->title;
                    }
                ),
                array(
                    'name'=>'url_id',
                    'type'=>'raw',
                    'value'=>function(Request $error) {
                        $url = $error->url;
                        return CHtml::link(
                            CHtml::encode(
                                $url->protocol.'://...'.
                                (strlen($url->url) > 30 ?
                                    substr($url->url,0,30).'...' :
                                    $url->url)
                            ),
                            $url->protocol.'://'.$url->domain.$url->url
                        );
                    }
                ),
                array(
                    'name'=>'server_id',
                    'value'=>function(Request $error) {
                        return $error->server->title;
                    }
                ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("error/viewRequest",array("request_id"=>$data->primaryKey))',
                    'viewButtonOptions'=>array('class'=>'btn btn-primary btn-xs'),
                    'viewButtonImageUrl'=>array(),
                ),
            ),
        ));
        ?>
    </div>
</div>