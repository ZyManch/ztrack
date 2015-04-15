<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 15.04.2015
 * Time: 18:10
 */
class GeoipCommand extends CConsoleCommand {

    public function actionUpdate() {
        $filename = Yii::getPathOfAlias('application.extensions.tabgeo_country_v4.tabgeo_country_v4').'.dat';
        $db_md5 = file_get_contents('http://tabgeo.com/api/v4/country/db/md5/');
        if(md5_file($filename) <> $db_md5){
            print "Found new geoip database.";
            $db_content = file_get_contents('http://tabgeo.com/api/v4/country/db/get/');
            if($db_md5 == md5($db_content)){
                file_put_contents($filename, $db_content);
            } else {
                print "Downloaded geoip is wrong.";
            }
        } else {
            print "Geoip is already updated.";
        }

    }
}