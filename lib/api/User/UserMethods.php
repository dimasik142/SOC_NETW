<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 14.01.2018
 * Time: 4:38
 */

namespace User;

class UserMethods
{
    /**
     * @return bool
     */
    public static function checkUserAuth (){
        if ($_SESSION['AUTH'] == true){
            return true;
        } else {
            return false;
        }
    }

}