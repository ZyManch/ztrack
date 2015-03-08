<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */


?>

<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Создание <?php echo $this->modelClass; ?></h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
    </div>
</div>
