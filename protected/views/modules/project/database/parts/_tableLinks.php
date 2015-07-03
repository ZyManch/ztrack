<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 15:32
 * @var $projectDatabase ProjectDatabase
 */
?>
<ul class="nav nav-pills nav-stacked">
    <?php foreach ($projectDatabase->getGroupedTables() as $suffix => $tables):?>
        <?php if (sizeof($tables) > 1):?>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#<?php echo $suffix;?>">
                    <?php echo $suffix;?>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level" id="<?php echo $suffix;?>">
                    <?php foreach ($tables as $table):?>
                        <li class="<?php echo $table['Name']==$projectDatabase->getCurrentTable()?' active':'';?>">
                            <?php $this->renderPartial(
                                '//modules/project/database/parts/_tableLink',
                                array(
                                    'table'=>$table,
                                    'projectDatabase'=>$projectDatabase,
                                    'isSub' => true
                                )
                            );?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </>
        <?php else:?>
            <li class="<?php echo $tables[0]['Name']==$projectDatabase->getCurrentTable()?' active':'';?>">
            <?php $this->renderPartial(
                '//modules/project/database/parts/_tableLink',
                array(
                    'table'=>$tables[0],
                    'projectDatabase'=>$projectDatabase,
                    'isSub' => false
                )
            );?>
            </li>
        <?php endif;?>
    <?php endforeach;?>
</ul>