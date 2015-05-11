<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 19.04.2015
 * Time: 20:47
 * @var $error Error
 */
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Tickets</h5>
    </div>
    <div class="ibox-content">
        <?php
        $widget = new TicketsWidgetModule();
        $widget->configure(array(
            'page_type_id' => array(PAGE_TYPE_TICKETS,PAGE_TYPE_ERROR),
            'error_id' => $error->id
        ));
        $widget->renderWidget();
        ?>
    </div>
</div>