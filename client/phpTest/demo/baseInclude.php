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
 *
 * @param string $param1 The first param
 * @param string $param2 The second param
 *
 * @return ConnectionDB True or false
 *
 * @throws SomeException
 *
 * @deprecated Don't use this anymore
 */
function myFunc()
{

}
