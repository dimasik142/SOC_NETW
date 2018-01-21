<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 21.01.2018
 * Time: 04:21
 */

namespace Sql\Communication\Chat;

use Sql\Communication\Communication;
use Sql\Sql;
use Sql\Person\Person;
use User\UserMethods;

class Chat extends Communication
{

    /**
     * @param $userId
     * @param $idReceiver
     * @param $quantity
     * @return array|bool
     */
    public function getMessagesList($userId , $idReceiver, $quantity) {
        $sqlObj = new Sql();
        $connect = $sqlObj->connection();
        $sqlQuery = self::makeSelectLimitedString(
            $this->messagesTableName,
            '((`sender_id` = '. $idReceiver . ' AND `receiver_id` = '. $userId .') OR (`receiver_id` = ' . $idReceiver . " AND `sender_id` = " . $userId . ")) ",
            '*',
            $quantity,
            'ASC'
        );

        $queryResult = $connect->query($sqlQuery);
        if ($queryResult->num_rows > 0) {
            $information_array = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $information_array;
        } else {
            return false;
        }
    }




}