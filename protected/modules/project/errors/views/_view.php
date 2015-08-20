<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 15:58
 * @var SearchError $search
 * @var Project $project
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="text-right">
                    <?php echo CHtml::link(
                        'Get Token Hash',
                        '#',
                        array(
                            'class'=>'btn btn-warning',
                            'data-toggle'=>'modal',
                            'data-target'=>'#token-form'
                        )
                    );?>
                    <?php echo CHtml::link(
                        'All errors',
                        array(
                            'error/admin',
                        ),
                        array(
                            'class'=>'btn btn-primary'
                        )
                    );?>
                </div>
                <?php $this->renderPartial('//error/_list',array('model'=>$model));?>
            </div>
        </div>
    </div>
</div>

<div id="token-form" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Current Token</h4>
            </div>
            <div class="modal-body">
                Current token hash is:
                <strong><?php echo $project->tokens ? $project->tokens[0]->hash: 'none';?></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>