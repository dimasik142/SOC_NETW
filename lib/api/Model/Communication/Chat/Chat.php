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
            '((SENDER_ID = '. $idReceiver . ' AND RECEIVER_ID = '. $userId .') OR (RECEIVER_ID = ' . $idReceiver . " AND SENDER_ID = " . $userId . ")) AND ROWNUM <= " . $quantity,
            '*',
            $quantity,
            'ASC'
        );
        $messagesArray = [];

        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            array_push($messagesArray, $row);
        }
        OCICommit($connect);
        return $messagesArray;
    }

    /**
     * @param $messageId
     * @return bool
     */
    public function deleteMessage($messageId) {
        $sqlObj = new Sql();
        $connect = $sqlObj->connection();
        $sqlQuery = self::makeDeleteString(
            $this->messagesTableName,
            'ID = ' . $messageId
        );
        $s = oci_parse($connect, $sqlQuery);
        oci_execute($s, OCI_DEFAULT);
        oci_commit($connect);
        oci_close($connect);
        return true;
    }

    /**
     * @param $messageId
     * @param $text
     * @return bool
     */
    public function changeMessage($messageId, $text) {
        $sqlObj = new Sql();
        $connect = $sqlObj->connection();
        $sqlQuery = self::makeUpdateString(
            $this->messagesTableName,
            "TEXT = '". $text . "'",
            "ID = '" . $messageId . "'"
        );
        $s = oci_parse($connect, $sqlQuery);
        oci_execute($s, OCI_DEFAULT);
        oci_commit($connect);
        oci_close($connect);
        return true;
    }
}