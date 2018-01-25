<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 21.01.2018
 * Time: 00:59
 */

namespace Sql\Communication;

use Sql\Sql;
use Sql\Person\Person;
use User\UserMethods;

class Communication extends Sql
{
    protected $messagesTableName = 'MESSAGES';
    protected $dialogsTableName = 'DIALOGS';

    /**
     * @param $from
     * @param $where
     * @param $select
     * @param $limit
     * @param $order
     * @return string
     */
    public static function makeSelectLimitedString($from, $where, $select , $limit, $order) {
        return 'SELECT ' . $select . ' FROM ' . $from . ' WHERE ' . $where ;
    }

    /**
     * @param $text
     * @param $sender
     * @param $receiver
     * @return bool
     */
    public function saveMessage($text, $sender, $receiver){
        $sqlObj = new Sql();
        $connect = $sqlObj->connection();

        $sqlQuery  = $sqlObj->makeInsertString(
            $this->messagesTableName,
            ['sender_id', 'receiver_id', 'text'],
            [$sender, $receiver, $text]
        );
        $s = oci_parse($connect, $sqlQuery);
        oci_execute($s, OCI_DEFAULT);
        oci_commit($connect);
        oci_close($connect);
        return true;

    }

    /**
     * @param $newText
     * @param $messageId
     * @return bool
     */
    public function updateMessage($newText, $messageId){
        $sqlObj = new Sql();
        $connect = $sqlObj->connection();

        $sqlQuery = $sqlObj->makeUpdateString(
            $this->messagesTableName,
            '`text` = ' . $newText,
            '`id` = "'. $messageId . '"'
        );
        $s = oci_parse($connect, $sqlQuery);
        oci_execute($s, OCI_DEFAULT);
        oci_commit($connect);
        oci_close($connect);
        return true;
    }

    /**
     * @return array
     */
    public static function getTime(){
        $today = date("Y-m-d H:i:s");
        ini_set('date.timezone', "Europe/Kiev");
        return date($today);
    }

}