<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 14:28
 * @var Request $request
 */
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Trace</h5>
    </div>
    <div class="ibox-content">
        <div class="panel-group" id="trace">
            <?php $isFirst = true;?>
            <?php foreach ($request->traces as $trace):?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a href="#trace-<?php echo $trace->id;?>" data-toggle="collapse">
                                <?php echo CHtml::encode($trace->filename).':'.$trace->line;?>
                            </a>
                        </h5>
                    </div>
                    <div id="trace-<?php echo $trace->id;?>" class="panel-collapse collapse<?php if($isFirst):?> in<?php endif;?>">
                        <div class="panel-body">
                            <?php
                            $highlight = new HighlightCode('php',$trace->traceCodes,$trace->line);
                            echo $highlight;
                            ?>
                        </div>
                    </div>
                </div>
                <?php $isFirst = false;?>
            <?php endforeach;?>
        </div>
    </div>
</div>