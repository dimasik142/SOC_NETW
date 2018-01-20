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
    private $user = 'root';
    private $password = 'root';
    private $db = 'social_network';
    private $host = 'localhost';

    /**
     * @return object
     */
    public function connection(){

        $connection = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->db
        );

        return $connection;
    }

    /**
     * @param $from
     * @param $where
     * @param $select
     * @return string
     */
    public function makeSelectString($from, $where, $select) {
        $sql = 'SELECT ' . $select . ' FROM ' . $from;
        if ($where) {
            $sql .= ' WHERE ' . $where['NAME'] . '="' . $where['VALUE'] .'"';
        }
        return $sql;
    }

    /**
     * @param $tableName
     * @param $keys
     * @param $values
     * @return string
     */
    public function makeInsertString($tableName, $keys, $values) {
        $sql = "INSERT INTO " . $tableName . " (";
        foreach ($keys as $key=>$item){
            $sql .= '`' . $item . '`';
            if ($key != count($keys)){
                $sql .= ', ';
            }
        }
        $sql .= ') VALUES ( ';
        foreach ($values as $key=>$item){
            $sql .= '"' .$item . '"';
            if ($key != count($values)){
                $sql .= ', ';
            }
        }
        $sql .= ')';

        return $sql;
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
