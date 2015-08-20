<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 12:24
 * @var StatisticWidgetModule $system_module
 * @var Statistic $statistic
 * @var $valueColumn
 * @var $valueType
 * @var $valueFormat
 */
$clientScript =Yii::app()->clientScript;
$clientScript->registerScript(
    'axis-x',
    '$(".axis-x").change(function() {
        var $this = $(this),
            $row = $this.parents(".form-group"),
            statId = $this.data("statistic"),
            columnType;
        $row.find(".axis-filter").hide();
        columnType = window.statColumns[statId][$this.val()];
        $("#axis-x-format-"+columnType+"-"+statId).show();

    });'
);
$statColumns = array();
foreach ($statistic->statisticColumns as $column) {
    $statColumns[$column->id] = $column->type;
}
$clientScript->registerScript(
    'column-'.$statistic->id,
    'if (typeof window.statColumns == "undefined") {
        window.statColumns = {};
    }
    window.statColumns['.$statistic->id.'] = '.json_encode($statColumns).';'
)
?>
<div class="form-group">
    <?php echo CHtml::label(
        'Axis X',
        'axis-x-'.$statistic->id,
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-2">
        <?php foreach (StatisticColumn::getAvailableTypes() as $type => $column):?>
            <?php echo CHtml::dropDownList(
                'config['.$statistic->id.'][axis-x]['.$type.']',
                $valueFormat,
                $column->getFormatList(),
                array(
                    'class'=>'form-control axis-filter',
                    'id'=>'axis-x-format-'.$type.'-'.$statistic->id,
                    'style'=>$valueType == $type ? '' : 'display:none'
                )
            ); ?>
        <?php endforeach;?>
    </div>
    <div class="col-sm-7">
        <?php echo CHtml::dropDownList(
            'config['.$statistic->id.'][axis-x][column]',
            $valueColumn,
            CHtml::listData($statistic->statisticColumns,'id','label'),
            array(
                'class'=>'form-control axis-x',
                'id'=>'axis-x-'.$statistic->id,'data-statistic'=>$statistic->id
            )
        ); ?>
    </div>
</div>