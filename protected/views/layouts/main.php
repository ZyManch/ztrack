<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="/"/>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>$this->menu,

        ),
    ),
    'brand' => $this->renderPartial('//layouts/logo',null,true),
    'htmlOptions' => array('id' => 'logo')
)); ?>


<div id="content">
    <?php $this->widget('bootstrap.widgets.TbAlert', array()); ?>
    <?php echo $content; ?>
    <div id="footer-spacer"></div>
</div>


<div id="footer">
    Copyright &copy; <?php echo date('Y'); ?> by My Company.
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ошибка</h4>
            </div>
            <div class="modal-body" id="myModalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
