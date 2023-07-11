<?php

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

$container = $app->getContainer();
$container->set('db', function ($container) {
  $dbConfig = [
      'driver' => 'pgsql',
      'host' => 'localhost',
      'port' => '5432',
      'database' => 'todo',
      'username' => 'todo',
      'password' => 'todo',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => ''
  ];

  $dsn = "{$dbConfig['driver']}:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['database']}";
  $pdo = new \PDO($dsn, $dbConfig['username'], $dbConfig['password']);
  $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
  
  return $pdo;
});
