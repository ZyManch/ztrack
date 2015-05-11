<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 05.04.2015
 * Time: 22:51
 * @var StatisticWidgetModule $system_module
 * @var DashboardController $this
 * @var Statistic $statistic
 */
$clientScript = Yii::app()->clientScript;
$clientScript->registerScript(
    'add-axes-y-button',
    '$(".add-axes-y-button").click(function() {
        var $this = $(this),
            $row = $(this).parents(".statistic"),
            template = $row.find(".axis-y-template").html(),
            $container = $row.find(".axis-y-list"),
            index = parseInt($this.data("index"),10);
        $this.data("index",index+1)
        $container.append(template.split("temporary_index").join(index));
    });'
);
$clientScript->registerScript(
    'add-filter-button',
    '$(".add-filter-button").click(function() {
        var $this = $(this),
            $row = $(this).parents(".filter"),
            template = $row.find(".filter-template").html(),
            $container = $row.find(".filter-list"),
            index = parseInt($this.data("index"),10);
        $this.data("index",index+1)
        $container.append(template.split("temporary_index").join(index));
    });'
);
?>
<?php $this->renderPartial('//modules/widget/statistic/field/_graph',array(
    'system_module' => $system_module,
    'statistic' => $statistic,
    'config' => $config,
));?>

<?php $this->renderPartial('//modules/widget/statistic/field/_statistic',array(
    'system_module' => $system_module,
    'statistic' => $statistic,
    'config' => $config,
));?>

<?php foreach (Yii::app()->user->getUser()->getAvailableStatistics() as $statistic):?>
    <?php
    if (isset($config['statistic_id']) && $config['statistic_id']==$statistic->id) {
        $isSelected = true;
    } else {
        $isSelected = false;
    }
    $columns = array_values($statistic->statisticColumns);
    $firstColumn = $columns[0];
    $axisYList = ($isSelected && isset($config['axis-y']) ? $config['axis-y'] : array());
    $filterList = ($isSelected && isset($config['filter']) ? $config['filter'] : array());
    ?>
    <div class="statistic" id="statistic-<?php echo $statistic->id;?>"<?php if (!$isSelected):?> style="display:none"<?php endif;?>>

        <?php $this->renderPartial('//modules/widget/statistic/field/_axisX',array(
            'system_module' => $system_module,
            'statistic' => $statistic,
            'valueColumn' => $isSelected && isset($config['axis-x']['column']) ? $config['axis-x']['column'] : null,
            'valueType' => $isSelected && isset($config['axis-x']['column']) && isset($statistic->statisticColumns[$config['axis-x']['column']]) ?
                $statistic->statisticColumns[$config['axis-x']['column']]->type :
                $firstColumn->type,
            'valueFormat' => $isSelected && isset($config['axis-x']['format']) ? $config['axis-x']['format'] : null,
        ));?>
        <div class="axis-y-list">
            <?php foreach ($axisYList as $index => $axisY):?>
                <?php $selectedColumn = (isset($statistic->statisticColumns[$axisY['column']]) ? $statistic->statisticColumns[$axisY['column']] : null);?>
                <?php $this->renderPartial('//modules/widget/statistic/field/_axisY',array(
                    'system_module' => $system_module,
                    'statistic' => $statistic,
                    'valueColumn' => $axisY['column'],
                    'valueType' => $selectedColumn ? $selectedColumn->type : null,
                    'valueFormat' => isset($axisY['format']) ? $axisY['format'] : null,
                    'index' => $index
                ));?>
            <?php endforeach;?>
        </div>
        <div class="row">
            <div class="col-sm-push-3 col-sm-9">
                <div style="display: none" class="axis-y-template">
                    <?php $this->renderPartial('//modules/widget/statistic/field/_axisY',array(
                        'system_module' => $system_module,
                        'statistic' => $statistic,
                        'valueColumn' => $firstColumn->id,
                        'valueType' => $firstColumn->type,
                        'valueFormat' => null,
                        'index' => 'temporary_index'
                    ));?>
                </div>
                <?php echo CHtml::button(
                    'Add Y axis',
                    array('class' => 'btn btn-primary add-axes-y-button','data-index'=>sizeof($axisYList))
                ); ?>
            </div>
        </div>
        <div class="filter">
            <div class="filter-list">
                <?php foreach ($filterList as $index => $filter):?>
                    <?php $selectedColumn = (isset($statistic->statisticColumns[$filter['column']]) ? $statistic->statisticColumns[$filter['column']] : null);?>
                    <?php $this->renderPartial('//modules/widget/statistic/field/_filter',array(
                        'system_module' => $system_module,
                        'statistic' => $statistic,
                        'value' => $filter['value'],
                        'valueColumn' => $filter['column'],
                        'valueType' => $selectedColumn ? $selectedColumn->type : null,
                        'valueComparison' => isset($filter['comparison']) ? $filter['comparison'] : null,
                        'index' => $index
                    ));?>
                <?php endforeach;?>
            </div>
            <div class="row">
                <div class="col-sm-push-3 col-sm-9">
                    <div style="display: none" class="filter-template">
                        <?php $this->renderPartial('//modules/widget/statistic/field/_filter',array(
                            'system_module' => $system_module,
                            'statistic' => $statistic,
                            'value' => '',
                            'valueColumn' => $firstColumn->id,
                            'valueType' => $firstColumn->type,
                            'valueFormat' => null,
                            'index' => 'temporary_index'
                        ));?>
                    </div>
                    <?php echo CHtml::button(
                        'Add filter',
                        array('class' => 'btn btn-primary add-filter-button','data-index'=>sizeof($filterList))
                    ); ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>
