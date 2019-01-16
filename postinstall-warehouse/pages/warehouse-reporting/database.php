<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class db extends Capsule
{
	//
}

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $MySettings['db_host'],
    'database'  => $MySettings['db_name'],
    'username'  => $MySettings['db_user'],
    'password'  => $MySettings['db_pwd'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);


$capsule->setAsGlobal();


$capsule->bootEloquent();


