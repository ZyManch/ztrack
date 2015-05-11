<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 14.03.2015
 * Time: 23:15
 * @var $search_model SearchPage
 * @var $last_release Page
 * @var $this Controller
 */
if ($last_release):?>
    <?php $this->renderPartial('//modules/widget/tickets/_view', array('search_model' => $search_model));;?>
<?php else:?>

<?php endif;?>
