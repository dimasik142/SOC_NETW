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
        $sqlQuery = $this->makeSelectString('USERS', $whereQuery, '*');
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            if ($row['PASSWORD'] == $pass AND $row['STATUS'] != 'NO'){
                UserMethods::setUserAuth($row['USER_ID']);
                return true;
            } else {
                return false;
            }
        }
        OCICommit($connect);
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkUserStatus($id) {
        $connect = $this->connection();
        $whereQuery = [
            'NAME' => 'USER_ID',
            'VALUE' => $id
        ];
        $sqlQuery = $this->makeSelectString('USERS', $whereQuery, '*');
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            if ($row['STATUS'] != 'NO'){
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
            [0 => 'EMAIL', 1 => 'PASSWORD'],
            [0 => $data['email'], 1 => $data['pass']]
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
            [0 => 'NAME', 1 => 'SURENAME', 2 => 'USER_ID'],
            [0 => $data['name'], 1 => $data['surename'], 2 => $id]
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

    /**
     * @param $id
     * @return array
     */
    public function getAllUsers($id){
        $connect = $this->connection();
        $resultArray = [];
        $sqlQuery = $this->makeSelectString('users', [], '*');
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            if ($row AND $row['USER_ID'] != $id) {
                $result['DATA'] = $this->getUserInformation($row['USER_ID']);
                $result['LOGIN'] = $row;
                array_push($resultArray,$result);
            }
        }
        OCICommit($connect);
        return $resultArray;
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     */
    public function changeStatusUser($id, $status){
        $connect = $this->connection();
        $newStatus = '';
        if ($status == 'NO'){
            $newStatus = 'YES';
        } else {
            $newStatus = 'NO';
        }
        $sql = $this->makeUpdateString(
            'USERS',
            "STATUS = '". $newStatus . "'",
            "USER_ID = '" . $id . "'"
        );
        $s = oci_parse($connect, $sql);
        oci_execute($s, OCI_DEFAULT);
        oci_commit($connect);
        oci_close($connect);
        return true;
    }
}