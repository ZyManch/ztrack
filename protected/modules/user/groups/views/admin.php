<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $module GroupsUserModule  */


?>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-xs-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Groups</h5>
                    <div class="ibox-tools">
                        <?php echo CHtml::link(
                            'Create new group',
                            array('group/create'),
                            array('class'=>'btn btn-primary btn-xs')
                        ); ?>
                    </div>
                </div>
                <div class="ibox-content">
                    <p>
                    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
                    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
                    </p>

                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'group-grid',
                        'dataProvider'=>$model->search(),
                        'filter'=>$model,
                        'template'=>'{items} {summary} {pager}',
                        'itemsCssClass' => 'table table-hover',
                        'htmlOptions' => array('class'=>'project-list'),
                        'columns'=>array(
                            array(
                                'name' => 'id',
                                'htmlOptions' => array('style'=>'width:160px')
                            ),
                            'title',
                            array(
                                'class'=>'CButtonColumn',
                                'htmlOptions' => array('style'=>'width:100px'),
                                'template' => '{update} {delete}',
                                'viewButtonUrl'=>function($data) use($module) {
                                    return $module->normalizeUrl(array("view", "group_id" => $data->primaryKey));
                                },
                                'updateButtonUrl'=>function($data)  use($module){
                                    return $module->normalizeUrl(array("update", "group_id" => $data->primaryKey));
                                },
                                'deleteButtonUrl'=>function($data) use($module) {
                                    return $module->normalizeUrl(array("delete", "group_id" => $data->primaryKey));
                                }
                            )
                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>