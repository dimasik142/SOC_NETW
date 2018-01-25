<?php
/**
 * User: dimasik142
 * User: ivanov.dmytro.ua@gmail.com
 * Date: 21.01.2018
 * Time: 01:03
 */

namespace Sql\Communication\Dialogs;

use Sql\Communication\Communication;
use Sql\Sql;
use Sql\Person\Person;

class Dialogs extends Communication
{
    /**
     * @param $id
     * @return array|bool
     */
    public function getDialogsById ($id){
        $dialogsArray = [];

        $sqlObj = new Sql();
        $connect = $sqlObj->connection();
        $sqlQuery = $sqlObj->makeSelectString(
            $this->dialogsTableName,
            [
                'NAME' => 'user_id',
                'VALUE' => $id
            ],
            '*'
        );
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            array_push($dialogsArray, $this->getInformationByDialog($row['RECEIVER_ID']));
        }
        OCICommit($connect);
        return $dialogsArray;
    }

    /**
     * @param $id_receiver
     * @return array
     */
    private function getInformationByDialog ($id_receiver){
        $person = new Person();
        $userInformation = $person->getUserInformation($id_receiver);
        $lastMessage = $this->getLastMessageWithUser($id_receiver);

        return [
            'USER_DATA' => $userInformation,
            'LAST_MESSAGE' => $lastMessage
        ];
    }

    /**
     * @param $id_receiver
     * @return array|bool
     */
    private function getLastMessageWithUser ($id_receiver){
        $sqlObj = new Sql();
        $connect = $sqlObj->connection();
        $sqlQuery = self::makeSelectLimitedString(
            $this->messagesTableName,
            '((SENDER_ID = '. $id_receiver . ' AND RECEIVER_ID = '. $_SESSION['USER_AUTH_ID'] .') OR (RECEIVER_ID = ' . $id_receiver . " AND SENDER_ID = " . $_SESSION['USER_AUTH_ID'] . ")) AND ROWNUM <= 1 ",
            '*',
            1,
            'DESC'
        );
        $stid = oci_parse($connect, $sqlQuery);
        $r = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            return $row;
        }
        OCICommit($connect);
    }

    /**
     * @param $id_receiver
     * @return bool
     */
    public function deleteDialogWithUser ($id_receiver){

        return true;
    }

    /**
     * @param $id_receiver
     * @return bool
     */
    public function addDialogWithUser ($id_receiver){

        return true;
    }

}