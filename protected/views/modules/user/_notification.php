<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:07
 */
?>
<li class="nav-icon-btn nav-icon-btn-danger dropdown">
    <a href="#notifications" class="dropdown-toggle" data-toggle="dropdown">
        <span class="label">5</span>
        <i class="nav-icon fa fa-bullhorn"></i>
        <span class="small-screen-text">Notifications</span>
    </a>

    <!-- NOTIFICATIONS -->


    <div class="dropdown-menu widget-notifications no-padding" style="width: 300px">
        <div class="notifications-list" id="main-navbar-notifications">

            <div class="notification">
                <div class="notification-title text-danger">SYSTEM</div>
                <div class="notification-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
                <div class="notification-ago">12h ago</div>
                <div class="notification-icon fa fa-hdd-o bg-danger"></div>
            </div> <!-- / .notification -->

            <div class="notification">
                <div class="notification-title text-info">STORE</div>
                <div class="notification-description">You have <strong>9</strong> new orders.</div>
                <div class="notification-ago">12h ago</div>
                <div class="notification-icon fa fa-truck bg-info"></div>
            </div> <!-- / .notification -->

            <div class="notification">
                <div class="notification-title text-default">CRON DAEMON</div>
                <div class="notification-description">Job <strong>"Clean DB"</strong> has been completed.</div>
                <div class="notification-ago">12h ago</div>
                <div class="notification-icon fa fa-clock-o bg-default"></div>
            </div> <!-- / .notification -->

            <div class="notification">
                <div class="notification-title text-success">SYSTEM</div>
                <div class="notification-description">Server <strong>up</strong>.</div>
                <div class="notification-ago">12h ago</div>
                <div class="notification-icon fa fa-hdd-o bg-success"></div>
            </div> <!-- / .notification -->

            <div class="notification">
                <div class="notification-title text-warning">SYSTEM</div>
                <div class="notification-description"><strong>Warning</strong>: Processor load <strong>92%</strong>.</div>
                <div class="notification-ago">12h ago</div>
                <div class="notification-icon fa fa-hdd-o bg-warning"></div>
            </div> <!-- / .notification -->

        </div> <!-- / .notifications-list -->
        <a href="#" class="notifications-link">MORE NOTIFICATIONS</a>
    </div> <!-- / .dropdown-menu -->
</li>