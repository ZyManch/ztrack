<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 19.04.2015
 * Time: 9:57
 * @var $this ProjectController
 * @var $release ReleasePage
 */


?>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-9">
                        <h1>Create release</h1>
                    </div>
                    <div class="col-md-3 text-right">

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $this->renderPartial('//modules/project/release/_form', array('model'=>$release)); ?>    </div>
                </div>
            </div>
        </div>
    </div>
</div>
