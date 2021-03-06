<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 19.01.2018
 * Time: 03:11
 */

namespace Sql;

class Sql
{
    private $user = 'system';
    private $password = 'ivanov';
    private $db = 'social_network';
    private $host = 'localhost/xe';

    /**
     * @return resource
     */
    public function connection(){

        $connect = OCILogon(
            $this->user,
            $this->password,
            $this->host,
            'CL8MSWIN1251'
        );

        return $connect;
    }

    /**
     * @param $from
     * @param $where
     * @param $select
     * @return string
     */
    public static function makeSelectString($from, $where, $select) {
        $sql = 'SELECT ' . $select . ' FROM ' . $from;
        if ($where) {
            $sql .= ' WHERE ' . $where['NAME'] . "='" . $where['VALUE'] ."'";
        }
        return $sql;
    }

    /**
     * @param $tableName
     * @param $keys
     * @param $values
     * @return string
     */
    public static function makeInsertString($tableName, $keys, $values) {
        $sql = "insert into " . $tableName . " (";
        foreach ($keys as $key=>$item){
            $sql .= $item ;
            if ($key != count($keys) -1 ){
                $sql .= ', ';
            }
        }
        $sql .= ') VALUES ( ';
        foreach ($values as $key=>$item){
            $sql .= "'" .$item . "'";
            if ($key != count($values) - 1){
                $sql .= ', ';
            }
        }
        $sql .= ')';

        return $sql;
    }

    /**
     * @param $from
     * @param $set
     * @param $where
     * @return string
     */
    public static function makeUpdateString($from, $set, $where) {
        return 'UPDATE ' . $from . ' SET ' . $set . ' WHERE ' . $where;
    }

    /**
     * @param $from
     * @param $where
     * @return string
     */
    public static function makeDeleteString($from, $where) {
        return 'DELETE FROM ' . $from . ' WHERE ' . $where;
    }

    /**
     * @param $data
     * @return array
     */
    public static function convertInArrayUsers($data){
        $result = [];
        foreach($data as $item) {
            array_push($result, $item['password']);
        }
        return $result;
    }

}
