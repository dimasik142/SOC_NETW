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
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            if ($row['PASSWORD'] == $pass){
                UserMethods::setUserAuth($row['USER_ID']);
                return true;
            } else {
                return false;
            }
        }
        OCICommit($connect);
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
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            if ($row) {
                return true;
            }
        }
        OCICommit($connect);
        return false;
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
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            return $row['USER_ID'];
        }
        OCICommit($connect);
        return false;
    }

    /**
     * @param $data
     * @return bool
     */
    public function saveUser($data){
        $connect = $this->connection();
        $sql = $this->makeInsertString(
            'USERS',
            [1 => 'EMAIL', 2 => 'PASSWORD'],
            [1 => $data['email'], 2 => $data['pass']]
        );
        $s = oci_parse($connect, $sql);
        oci_execute($s, OCI_DEFAULT);
        oci_commit($connect);
        oci_close($connect);
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
            'USERS_DATA',
            [1 => 'NAME', 2 => 'SURENAME', 3 => 'USER_ID'],
            [1 => $data['name'], 2 => $data['surename'], 3 => $id]
        );
        $s = oci_parse($connect, $sql);
        oci_execute($s, OCI_DEFAULT);
        oci_commit($connect);
        oci_close($connect);
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
                'NAME' => 'USER_ID',
                'VALUE' => $id
            ],
            '*'
        );
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            return $row;
        }
        OCICommit($connect);
    }

    /**
     * @param $id
     * @return array
     */
    public function getUserSettings($id){
        $connect = $this->connection();
        $sqlQuery = $this->makeSelectString(
            'USERS',
            [
                'NAME' => 'USER_ID',
                'VALUE' => $id
            ],
            '*'
        );
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            return $row;
        }
        OCICommit($connect);
    }

    /**
     * @param $id
     * @param $oldPass
     * @param $newPass
     * @return array
     */
    public function changeUserPassword($id, $oldPass, $newPass){
        $userData = $this->getUserSettings($id);
        if ($userData['PASSWORD'] == $oldPass){
            $connect = $this->connection();
            $sql = $this->makeUpdateString(
                'USERS',
                "PASSWORD = '". $newPass . "'",
                "USER_ID = '" . $id . "'"
            );
            $s = oci_parse($connect, $sql);
            oci_execute($s, OCI_DEFAULT);
            oci_commit($connect);
            oci_close($connect);
            return ['SUCCESS' => true];
        } else {
            return ['ERROR' => 'Старий пароль не правильний'];
        }
    }
}