<?php

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 17:05
 */
class ErrorCommand extends CConsoleCommand {

    public function actionTestRollbar() {

        $demo = array(
            "access_token" => "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
            "data"         => array(
                "environment"  => "master",
                "body"         => array(

                    "trace"        => array(
                        "frames"    => array(
                            array(
                                "filename" => "/Users/brian/www/mox/mox/views/project.py",
                                "lineno"   => rand(24,27),
                                "colno"    => 8,
                                "method"   => "index",
                                "code"     => "_save_last_project(request, project_id, force=True)",
                                "context"  => array(
                                    "pre"  => array(
                                        "project = request.context", "project_id = project.id"
                                    ),
                                    "post" => array()
                                ),
                                "args"     => array("<Request object>", 25),

                            ),
                            array(
                                "filename" => "/Users/brian/www/mox/mox/views/project.py", "lineno" => 497,
                                "method"   => "_save_last_project", "code" => "user = foo"
                            )
                        ),

                        "exception" => array(
                            "class"       => "NameError",
                            "message"     => "global name 'foo' is not defined",
                            "description" => "Something went wrong while trying to save the user object"
                        )

                    ),
                    "message"      => array(

                        "body"  => "Request over threshold of 10 seconds",
                        "route" => "home#index", "time_elapsed" => 15.23

                    ),
                    "crash_report" => array(
                        "raw" => "<crash report here>"
                    )

                ),
                "level"        => "error",
                "timestamp"    => time(),
                "platform"     => "linux",
                "language"     => "python",
                "context"      => "project#index",
                "request"      => array(
                    "url"          => "https://rollbar.com/project/1",
                    "method"       => "GET",
                    "headers"      => array(
                        "Accept" => "text/html", "Referer" => "https://rollbar.com/"
                    ),
                    "params"       => array(
                        "controller" => "project", "action" => "index"
                    ),
                    "GET"          => array(),
                    "query_string" => "",
                    "POST"         => array(),
                    "body"         => "",
                    "user_ip"      => rand(1,255).'.'.rand(1,255).'.'.rand(1,255).'.'.rand(1,255)

                ),

                "person"       => array(
                    "id"       => "12345",
                    "username" => "brianr",
                    "email"    => "brian@rollbar.com"
                ),

                "server"       => array(
                    "host"         => "web4",
                    "root"         => "/Users/brian/www/mox",
                    "branch"       => "master",
                    "code_version" => "b6437f45b7bbbb15f5eddc2eace4c71a8625da8c",
                    "sha"          => "b6437f45b7bbbb15f5eddc2eace4c71a8625da8c"
                ),

                "client"       => array(
                    "javascript" => array(
                        "browser"               => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36 OPR/20.0.1387.82",
                        "code_version"          => "b6437f45b7bbbb15f5eddc2eace4c71a8625da8c",
                        "source_map_enabled"    => false,
                        "guess_uncaught_frames" => false
                    )
                ),
                "custom"       => array(),
                "title"        => "NameError when setting last project in views/project.py",
            )
        );
        $parser = new RollbarErrorSaver();
        $parser->save(json_encode($demo));
    }

    public function actionTestGraylog() {
        $json = '{"_access_token":"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa","version":"1.0","host":"legal-video.dev","short_message":"Invalid controller specified (asdasdas) (code #oeej5pvr30)","full_message":"app: legalporn\npost: empty\nget: empty\nparams: empty\nsession: Array\n(\n    [isset] => ok\n    [ip] => 127.0.0.1\n    [country] => US\n    [location_hash] => 0c01eed56bc773624017535283e281c2\n    [user_log] => Array\n        (\n            [0] => 2015-04-16 09:45:02\tAuto login: f6b6f8768d7dca1b22d0e00ebfecdf59\n            [1] => 2015-04-16 14:48:12\tTry refresh token 94bb3e2020b43930d2c39fb282661200\n            [2] => 2015-04-16 14:48:20\tFailed refresh token:\n            [3] => 2015-04-16 14:48:20\tDelete oauth token\n            [4] => 2015-04-16 14:48:20\tDelete oauth token\n        )\n\n)\n\nurl: http:\/\/legal-video.dev\/asdasdas\/\n[core]Engine\/Zend.php:44\nArgs:Array\n(\n)\n\n[other]Z:\/home\/legal-video.dev\/public\/index.php:20\nArgs:Array\n(\n)\n","level":5,"timestamp":1429181361.8467,"facility":"master","file":"Engine\/Zend.php","line":44,"_server":"Array\n(\n    [REDIRECT_STATUS] => 200\n    [HTTP_HOST] => legal-video.dev\n    [HTTP_CONNECTION] => keep-alive\n    [HTTP_ACCEPT] => text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,*\/*;q=0.8\n    [HTTP_USER_AGENT] => Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/33.0.1750.154 Safari\/537.36 OPR\/20.0.1387.82\n    [HTTP_ACCEPT_ENCODING] => gzip,deflate,lzma,sdch\n    [HTTP_ACCEPT_LANGUAGE] => ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4\n    [HTTP_COOKIE] => track=18709; JDIALOG3=AEO4CS3DG6IQQSH6V4D013GXQCEY5P8TBJ4N9P6BAF51J1P9T2; DISABLE_CACHE=1; __utmx=266084498.-r6DC-mMTN6rdwPjeLh6pg$0:1; __utmxx=266084498.-r6DC-mMTN6rdwPjeLh6pg$0:1425973482:8035200; ACCIDSESSID=8am26hcuujsvobpreq10ecqpo7; JDIALOG3=4AQ4B732AJYW97YXH91S0D8FC0CR4B59EH4PLVLVLIDTKGPR9W; OLD_JDIALOG=AEO4CS3DG6IQQSH6V4D013GXQCEY5P8TBJ4N9P6BAF51J1P9T2; _ga=GA1.2.1291934655.1425973483; _gat=1; USER_DATA=1%3A56cab09a87c1a7f8eaeff256e066ad3f2b08c210\n    [PATH] => \\usr\\local\\ImageMagick;\\usr\\local\\php5;C:\\Program Files (x86)\\NVIDIA Corporation\\PhysX\\Common;C:\\Program Files (x86)\\PC Connectivity Solution\\;C:\\Program Files (x86)\\Intel\\iCLS Client\\;C:\\Program Files\\Intel\\iCLS Client\\;C:\\Windows\\system32;C:\\Windows;C:\\Windows\\System32\\Wbem;C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\;C:\\Program Files\\TortoiseHg\\;C:\\Program Files\\nodejs\\;C:\\Program Files (x86)\\nodejs\\;C:\\Program Files (x86)\\Groovy\\Groovy-2.1.6\\bin;C:\\Program Files (x86)\\Intel\\OpenCL SDK\\2.0\\bin\\x86;C:\\Program Files (x86)\\Intel\\OpenCL SDK\\2.0\\bin\\x64;C:\\Program Files (x86)\\Skype\\Phone\\;C:\\Users\\ZyManch\\Documents\\cmd;C:\\Program Files (x86)\\Git\\bin\\;E:\\Denwer\\usr\\local\\php5;C:\\Program Files (x86)\\OpenVPN\\bin;C:\\Users\\ZyManch\\AppData\\Roaming\\npm\\;C:\\Program Files\\mongo\\bin;C:\\Program Files\\nodejs;C:\\Users\\ZyManch\\Documents\\cmd\n    [SystemRoot] => C:\\Windows\n    [COMSPEC] => C:\\Windows\\system32\\cmd.exe\n    [PATHEXT] => .COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC;.groovy;.gy\n    [WINDIR] => C:\\Windows\n    [SERVER_SIGNATURE] => <address>Apache\/2.2.22 (Win32) mod_ssl\/2.2.22 OpenSSL\/1.0.1c PHP\/5.3.13 Server at legal-video.dev Port 80<\/address>\n\n    [SERVER_SOFTWARE] => Apache\/2.2.22 (Win32) mod_ssl\/2.2.22 OpenSSL\/1.0.1c PHP\/5.3.13\n    [SERVER_NAME] => legal-video.dev\n    [SERVER_ADDR] => 127.0.0.1\n    [SERVER_PORT] => 80\n    [REMOTE_ADDR] => 127.0.0.1\n    [DOCUMENT_ROOT] => Z:\/home\/legal-video.dev\/public\n    [SERVER_ADMIN] => admin@example.com\n    [SCRIPT_FILENAME] => Z:\/home\/legal-video.dev\/public\/index.php\n    [REMOTE_PORT] => 49247\n    [REDIRECT_URL] => \/asdasdas\n    [GATEWAY_INTERFACE] => CGI\/1.1\n    [SERVER_PROTOCOL] => HTTP\/1.1\n    [REQUEST_METHOD] => GET\n    [QUERY_STRING] => \n    [REQUEST_URI] => \/asdasdas\/\n    [SCRIPT_NAME] => \/index.php\n    [PHP_SELF] => \/index.php\n    [REQUEST_TIME] => 1429181361\n    [argv] => Array\n        (\n        )\n\n    [argc] => 0\n)\n","_environment":"master","_hostname":"pc","_user_agent":"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/33.0.1750.154 Safari\/537.36 OPR\/20.0.1387.82","_remote_addr":"127.0.0.1","_url":"http:\/\/legal-video.dev\/asdasdas\/","_timestamp":1429181361,"_application":"legal-video-app","_module":"404"}';
        $parser = new GraylogErrorSaver();
        $parser->save($json);
    }
}