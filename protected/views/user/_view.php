<?php
/* @var $this UserController */
/* @var $data User */
?>
<div class="col-lg-4 col-md-6 ">
    <div class="contact-box">
        <a href="<?php echo CHtml::normalizeUrl(array('user/view','id'=>$data->id));?>">
            <div class="col-sm-4">
                <div class="text-center">
                    <?php echo $data->getGravatarImage(64);?>
                </div>
            </div>

            <div class="col-sm-8">
                <h3><?php echo CHtml::encode($data->username);?></h3>
                <p>as</p>
            </div>
            <div class="clearfix"></div>
        </a>


    </div>
</div>