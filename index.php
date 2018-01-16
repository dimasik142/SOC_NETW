<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 13.01.2018
 * Time: 21:51
 */


include($_SERVER["DOCUMENT_ROOT"].'/lib/api/User/UserMethods.php');
header('HTTP/1.1 301 Moved Permanently');

if (\User\UserMethods::checkUserAuth()){
    header('Location: http://'.$_SERVER["HTTP_HOST"].'/home/');
} else {
    header('Location: http://'.$_SERVER["HTTP_HOST"].'/personal/auth/');
}