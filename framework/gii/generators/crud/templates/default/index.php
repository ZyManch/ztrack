<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $dataProvider CActiveDataProvider */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));

?>

?>

<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1><?php echo $label; ?></h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
        )); ?>
    </div>
</div>
