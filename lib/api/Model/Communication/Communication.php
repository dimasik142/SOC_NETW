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
    /**
     * @param $from
     * @param $where
     * @param $select
     * @param $limit
     * @return string
     */
    public static function makeSelectLimitedString($from, $where, $select , $limit) {
        return 'SELECT ' . $select . ' FROM ' . $from . ' WHERE ' . $where . ' ORDER BY time DESC ' . ' LIMIT ' . $limit ;
    }


}