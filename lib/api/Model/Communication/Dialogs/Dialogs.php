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
use User\UserMethods;

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

        $queryResult = $connect->query($sqlQuery);
        if ($queryResult->num_rows > 0) {
            $information_array = $queryResult->fetch_all(MYSQLI_ASSOC);
            foreach ($information_array as $item) {
                array_push($dialogsArray, $this->getInformationByDialog($item['reciver_id']));
            }
            return $dialogsArray;
        } else {
            return false;
        }
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
            '((`sender_id` = '. $id_receiver . ' AND `receiver_id` = '. $_SESSION['USER_AUTH_ID'] .') OR (`receiver_id` = ' . $id_receiver . " AND `sender_id` = " . $_SESSION['USER_AUTH_ID'] . ")) ",
            '*',
            1,
            'DESC'
        );

        $queryResult = $connect->query($sqlQuery);
        if ($queryResult->num_rows > 0) {
            $information_array = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $information_array[0];
        } else {
            return false;
        }
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