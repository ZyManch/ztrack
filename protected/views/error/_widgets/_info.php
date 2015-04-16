<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 14:23
 * @var Request $request
 * @var Error $error
 */
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><?php echo CHtml::encode($error->title); ?></h5>
    </div>
    <div class="ibox-content">
        <table class="table table-responsive table-bordered">
            <colgroup>
                <col width="150px">
                <col>
            </colgroup>
            <tr>
                <th style="text-align: right">Level</th>
                <td><?php echo $error->level->title;?></td>
            </tr>
            <tr>
                <th style="text-align: right">Project</th>
                <td><?php echo $error->project ? CHtml::encode($error->project->title) : '-';?></td>
            </tr>
            <tr>
                <th style="text-align: right">Error count</th>
                <td><?php echo $error->total_count;?></td>
            </tr>
            <?php if (isset($request)):?>
                <tr>
                    <th style="text-align: right">Date</th>
                    <td><?php echo $request->changed;?></td>
                </tr>
            <?php else:?>
                <tr>
                    <th style="text-align: right">Last error</th>
                    <td><?php echo $error->changed;?></td>
                </tr>
            <?php endif;?>
            <tr>
                <th style="text-align: right">Branch</th>
                <td><?php echo CHtml::encode($error->branch->title);?></td>
            </tr>
            <?php if (isset($request)):?>
                <tr>
                    <th style="text-align: right">OS</th>
                    <td><?php echo CHtml::encode($request->os->os);?> <?php echo $request->os->version;?></td>
                </tr>
                <tr>
                    <th style="text-align: right">Browser</th>
                    <td><?php echo CHtml::encode($request->browser->browser);?> <?php echo $request->browser->version;?></td>
                </tr>
                <tr>
                    <th style="text-align: right">IP</th>
                    <td><?php echo long2ip($request->user_ip);?>  (<?php echo $request->country->name;?>)</td>
                </tr>
                <?php if ($request->code):?>
                    <tr>
                        <th style="text-align: right">Code</th>
                        <td><?php echo $request->code;?></td>
                    </tr>
                <?php endif;?>
                <tr>
                    <th style="text-align: right">Url</th>
                    <td><?php echo $request->method->title;?>
                        <?php echo CHtml::link(
                            CHtml::encode($request->url->protocol.'://'.$request->url->domain.$request->url->url),
                            $request->url->protocol.'://'.$request->url->domain.$request->url->url,
                            array('target'=>'_top')
                        );?></td>
                </tr>
                <?php if ($request->referer_url_id):?>
                    <tr>
                        <th style="text-align: right">Referer URL</th>
                        <td><?php echo CHtml::link(
                                CHtml::encode($request->refererUrl->protocol.'://'.$request->refererUrl->domain.$request->refererUrl->url),
                                $request->refererUrl->protocol.'://'.$request->refererUrl->domain.$request->refererUrl->url,
                                array('target'=>'_top')
                            );?></td>
                    </tr>
                <?php endif;?>
                <tr>
                    <th style="text-align: right">Server</th>
                    <td><?php echo $request->server->title;?></td>
                </tr>
            <?php endif;?>
        </table>
    </div>
</div>