<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.04.2015
 * Time: 15:20
 * @var $changes array
 * @var $history PageHistory
 */
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Diffs</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <?php echo CHtml::link(
                                    'View ticket',
                                    array(
                                        'project/view',
                                        'id' => $history->page->project_id,
                                        'module'=>'tickets',
                                        'action'=>'view',
                                        'ticket_id'=> $history->page_id
                                    ),
                                    array('class'=>'btn btn-primary')
                            );?>
                        </div>
                    </div>
                    <table class="table">
                        <colgroup>
                            <col width="20px">
                            <col>
                        </colgroup>
                        <?php foreach ($changes as $change):?>
                            <?php if ($change[1]==1):?>
                                <tr class="success">
                                    <td>+</td>
                                    <td><?php echo htmlspecialchars($change[0]);?></td>
                                </tr>
                            <?php elseif($change[1]==2):?>
                                <tr class="danger">
                                    <td>-</td>
                                    <td><?php echo htmlspecialchars($change[0]);?></td>
                                </tr>
                            <?php else:?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><?php echo htmlspecialchars($change[0]);?></td>
                                </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>