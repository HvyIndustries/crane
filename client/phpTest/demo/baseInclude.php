<?php

use Hvy\CraneDemo\ConnectionDB;

/**
 * This is a variable
 *
 * @var ConnectionDB
 */
$dbh = new ConnectionDB();
$dbh->openDbConnection();


/**
 * My function
 * Another line
 *
 * Yet another line
 * @param string       $param1 The first param
 * @param ConnectionDB $param2 The second param
 *
 * @return ConnectionDB True or false
 *
 * @throws SomeException When this case happens
 * @throws SomeOtherException When this case happens
 *
 * @deprecated Dont use this anymore
 */
function myFunc($param1, $param2)
{

}

class ThisIsMyClass
{
    public function __construct()
    {
    }

    /**
     * Call some function
     *
     * @return void
     */
    public function callFunc()
    {
    }
}