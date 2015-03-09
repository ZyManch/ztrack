<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 13:40
 * @var $this Controller
 * @var $model Page
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel colourable">
            <div class="panel-heading">
                <span class="panel-title"><?php echo CHtml::encode($model->title?$model->title:'Без имени');?></span>
                <div class="panel-heading-controls">
                    <?php echo CHtml::link(
                        'Edit',
                        array(
                            'project/view',
                            'id'=>Yii::app()->request->getParam('id'),
                            'action'=>'editWiki'
                        ),
                        array('class'=>'btn btn-primary')
                    );?>
                </div>
            </div>
            <div class="panel-body">
                <?php echo CHtml::encode($model->body);?>
            </div>
        </div>
    </div>
</div>