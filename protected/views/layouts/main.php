<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" class="gt-ie8 gt-ie9 not-ie">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="/"/>
    <?php
    $clientScript = Yii::app()->clientScript;
    $clientScript->registerCssFile('/css/styles.css');
    $clientScript->registerCssFile('/css/bootstrap.min.css');
    $clientScript->registerCssFile('/css/pixel-admin.min.css');
    $clientScript->registerCssFile('/css/widgets.min.css');
    $clientScript->registerCssFile('/css/rtl.min.css');
    $clientScript->registerCssFile('/css/themes.min.css');
    $clientScript->registerCoreScript('jquery');
    $clientScript->registerScriptFile('/js/bootstrap.min.js');
    $clientScript->registerScriptFile('/js/pixel-admin.min.js');
    $clientScript->registerScript('pixelAdminStart','window.pixelInit = [];',CClientScript::POS_HEAD);
    $clientScript->registerScript('pixelAdminFinish','window.PixelAdmin.start(window.pixelInit);',CClientScript::POS_END);
    ?>
    <!--[if lt IE 9]>
    <script src="/js/ie.min.js"></script>
    <![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="theme-silver main-menu-animated animate-mm-sm animate-mm-md animate-mm-lg">
<div id="main-wrapper">
    <?php $this->renderPartial('//layouts/_topMenu');?>
    <?php if (!Yii::app()->user->isGuest):?>
        <?php $this->renderPartial('//layouts/_mainMenu');?>
    <?php endif;?>


    <div id="content-wrapper">

        <?php echo $content; ?>
    </div>
    <?php if (!Yii::app()->user->isGuest):?>
    <div id="main-menu-bg"></div>
    <?php endif;?>
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
