<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.06.2015
 * Time: 15:57
 * @var $search_query
 * @var $foundErrors
 * @var $foundWiki
 * @var $foundTicket
 */
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>Search: <?php echo CHtml::encode($search_query);?></h2>
        </div>
    </div>

    <div class="wrapper wrapper-content  animated fadeInRight">
        <?php if ($foundWiki):?>
        <?php echo CHtml::link(
                'Search in WIKI  <br><small>[found '.$foundWiki.' result]</small>',
                array('wiki','q'=> $search_query),
                array('class'=>'btn btn-primary')
            );?>
       <?php endif;?>
        <?php if ($foundTicket):?>
            <?php echo CHtml::link(
                'Search in Tickets <br><small>[found '.$foundTicket.' result]</small>',
                array('ticket','q'=> $search_query),
                array('class'=>'btn btn-primary')
            );?>
        <?php endif;?>
        <?php if ($foundErrors):?>
            <?php echo CHtml::link(
                'Search in errors  <br><small>[found '.$foundErrors.' result]</small>',
                array('error','q'=> $search_query),
                array('class'=>'btn btn-primary')
            );?>
        <?php endif;?>
        <?php if (!$foundWiki && !$foundErrors && !$foundTicket):?>
            Nothing Found
        <?php endif;?>
    </div>
</div>