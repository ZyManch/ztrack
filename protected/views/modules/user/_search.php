<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:04
 */
?>
    <form role="search" class="navbar-form-custom" action="<?php echo CHtml::normalizeUrl(array('search/index'));?>">
        <div class="form-group">
            <input type="text" placeholder="Search for something..." class="form-control" name="q">
        </div>
    </form>
