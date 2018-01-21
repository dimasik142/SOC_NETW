<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 19.01.2018
 * Time: 03:12
 */

namespace Sql\Person;

use Sql\Sql;
use User\UserMethods;

class Person extends Sql
{
    /**
     * @param $email
     * @param $pass
     * @return bool
     */
    public function checkUserAuth($email, $pass) {
        $connect = $this->connection();
        $whereQuery = [
            'NAME' => 'email',
            'VALUE' => $email
        ];
        $sqlQuery = $this->makeSelectString('users', $whereQuery, '*');
        $queryResult = $connect->query($sqlQuery);
        if ($queryResult->num_rows > 0) {
            $information_array = $queryResult->fetch_all(MYSQLI_ASSOC);
            if ($information_array[0]['password'] == $pass) {
                UserMethods::setUserAuth($information_array[0]['user_id']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkUserExist($email) {
        $connect = $this->connection();
        $whereQuery = [
            'NAME' => 'email',
            'VALUE' => $email
        ];
        $sqlQuery = $this->makeSelectString('users', $whereQuery, '*');
        $queryResult = $connect->query($sqlQuery);
        if ($queryResult->num_rows > 0) {
            $information_array = $queryResult->fetch_all(MYSQLI_ASSOC);
            if ($information_array){
                return true;
            } else {
                return false;
            }
        } else {
          return false;
        }
    }

    /**
     * @param $email
     * @return integer
     */
    public function getUserIdByEmail($email){
        $connect = $this->connection();
        $whereQuery = [
            'NAME' => 'email',
            'VALUE' => $email
        ];
        $sqlQuery = $this->makeSelectString('users', $whereQuery, 'user_id');
        $queryResult = $connect->query($sqlQuery);
        if ($queryResult->num_rows > 0) {
            $information_array = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $information_array[0]['user_id'];
        } else {
            return false;
        }
    }

    /**
     * @param $data
     * @return bool
     */
    public function saveUser($data){
        $connect = $this->connection();
        $sql = $this->makeInsertString(
            'users',
            [1 => 'email', 2 => 'password'],
            [1 => $data['email'], 2 => $data['pass']]
        );
        $connect->query($sql);
        return $sql;
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     */
    public function saveUserData($data, $id){
        $connect = $this->connection();
        $sql = $this->makeInsertString(
            'users_data',
            [1 => 'name', 2 => 'surename', 3 => 'user_id'],
            [1 => $data['name'], 2 => $data['surename'], 3 => $id]
        );
        $connect->query($sql);
        return true;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function getUserInformation($id){
        $connect = $this->connection();
        $sqlQuery = $this->makeSelectString(
            'users_data',
            [
                'NAME' => 'user_id',
                'VALUE' => $id
            ],
            '*'
        );
        $queryResult = $connect->query($sqlQuery);
        if ($queryResult->num_rows > 0) {
            $information_array = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $information_array[0];
        } else {
            return false;
        }
    }
}