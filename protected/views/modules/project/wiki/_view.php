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
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo CHtml::encode($model->title?$model->title:'Unknown');?></h5>
                <div class="ibox-tools">
                    <?php echo CHtml::link(
                        'Edit',
                        array(
                            'project/view',
                            'id'=>Yii::app()->request->getParam('id'),
                            'module'=>'wiki',
                            'action' => 'update',
                            'wiki' => Yii::app()->request->getParam('wiki','')
                        ),
                        array('class'=>'btn btn-primary btn-xs')
                    );?>
                </div>
            </div>
            <div class="ibox-content">
                <?php echo $model->getBodyAsHtml();?>
            </div>
        </div>
    </div>
</div>