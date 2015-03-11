<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 13:26
 * @var $this Controller
 * @var $tickets_all_provider CActiveDataProvider
 * @var $tickets_my_provider CActiveDataProvider
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                asd
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Общие тикеты</h5>
            </div>
            <div class="ibox-content">
                <?php if ($tickets_all_provider->totalItemCount > 0 || true):?>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'dataProvider'=>$tickets_all_provider,
                        'itemsCssClass' => 'table table-hover',
                        'columns'=>array(
                            array(
                                'name' => 'title',
                                'htmlOptions' => array('class'=>'project-title'),
                                'headerHtmlOptions' => array('class'=>''),
                                'value' => function(Page $page) {
                                    return $page->title;
                                }
                            ),
                            array(
                                'name' => 'title',
                                'value' => function(Page $page) {
                                    return $page->title;
                                }
                            ),
                        )
                    ));?>
                <?php endif;?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Мои тикеты</h5>
            </div>
            <div class="ibox-content">

            </div>
        </div>
    </div>
</div>