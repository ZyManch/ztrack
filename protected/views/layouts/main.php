<?php
/**
 * @var $this Controller
 */
$miniNavbar =  (isset($_COOKIE['mini-menu']) && $_COOKIE['mini-menu']);
if ($miniNavbar) {
    Yii::app()->clientScript->registerScript('mini-menu','SmoothlyMenu()');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" class="gt-ie8 gt-ie9 not-ie">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="/"/>
    <?php
    // http://infinite-woodland-5276.herokuapp.com/index.html
    $clientScript = Yii::app()->clientScript;
    $clientScript->registerCssFile('/css/bootstrap.min.css');
    $clientScript->registerCssFile('/css/font-awesome.css');
    $clientScript->registerCssFile('/css/animate.css');
    $clientScript->registerCssFile('/css/styles.css');
    $clientScript->registerCssFile('/css/style.css');


    $clientScript->registerCoreScript('jquery');
    $clientScript->registerScriptFile('/js/bootstrap.min.js');
    $clientScript->registerScriptFile('/js/jquery.metisMenu.js');
    $clientScript->registerScriptFile('/js/jquery.slimscroll.min.js');
    $clientScript->registerScriptFile('/js/jquery.nestable.js');
    $clientScript->registerScriptFile('/js/jquery.cookie.js');
    $clientScript->registerScriptFile('/js/jquery-ui.min.js');
    $clientScript->registerScriptFile('/js/jquery.ui.swappable.js');
    $clientScript->registerScriptFile('/js/inspinia.js');
    $clientScript->registerScriptFile('/js/pace.min.js');
    ?>
    <!--[if lt IE 9]>
    <script src="/js/ie.min.js"></script>
    <![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="skin-3<?php if($miniNavbar):?> mini-navbar<?php endif;?>">
    <div id="wrapper">

        <?php if (!Yii::app()->user->isGuest):?>
            <?php $this->renderPartial('//layouts/_mainMenu');?>
        <?php endif;?>
        <div id="page-wrapper" class="gray-bg">
            <?php $this->renderPartial('//layouts/_topMenu');?>

            <?php if (Yii::app()->user->hasFlash('error')):?>
            <div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error');?></div>
            <?php endif;?>
            <?php if (Yii::app()->user->hasFlash('success')):?>
                <div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('success');?></div>
            <?php endif;?>

            <?php echo $content; ?>
        </div>

    </div>
</body>
</html>
