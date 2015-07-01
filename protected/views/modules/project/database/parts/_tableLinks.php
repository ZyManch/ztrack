<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 15:32
 * @var $projectDatabase ProjectDatabase
 */
?>
<ul class="nav ">
    <?php foreach ($projectDatabase->getGroupedTables() as $suffix => $tables):?>
        <?php if (sizeof($tables) > 1):?>
            <li>
                <a >
                    <?php echo $suffix;?>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <?php foreach ($tables as $table):?>
                        <li>
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
            <li>
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