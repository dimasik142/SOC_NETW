<?php
/**
 * Created by PhpStorm.
 * User: dimasik142
 * Date: 14.01.2018
 * Time: 4:38
 */

namespace User;

use Sql\Person\Person;


class UserMethods
{
    /**
     * @return bool
     */
    public static function checkUserAuth () {

        if ($_SESSION['AUTH'] == true){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public static function authUser ($email, $password) {
        if ($email and $password){
            $person = new Person();
            return $person->checkUserAuth($email, $password);
        } else {
            return false;
        }
    }

    /**
     * @param $id
     */
    public static function setUserAuth($id){
        $_SESSION['AUTH'] = true;
        $_SESSION['USER_AUTH_ID'] = $id;
    }

    /**
     * Event: clear sessions
     */
    public static function logOutUser(){
        $_SESSION['AUTH'] = false;
        $_SESSION['USER_AUTH_ID'] = false;
    }

    /**
     * @param $userData
     * @return bool|array
     */
    public static function registerUser($userData){
        $person = new Person();
        if (!$person->checkUserExist($userData['email'])) {
            $person->saveUser($userData);
            $userId = $person->getUserIdByEmail($userData['email']);
            self::setUserAuth($userId);
            $person->saveUserData($userData, $userId);
            return true;
        } else {
            return ['ERROR' => 'Користувач з таким email вже зареєстрований'];
        }
    }
}