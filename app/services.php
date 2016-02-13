<?php
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as MysqlAdapter;
use Nystc\Util\Util;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Register the global configuration as config
 */
$di->set('config', $config);


/**
 * Database service
 */
$di->set('db', function () use ($config) {

  return new MysqlAdapter(array(
    'host'      => $config->database->host,
    'username'  => $config->database->username,
    'password'  => $config->database->password,
    'dbname'    => $config->database->dbname
  ));

});

/**
 * Util service
 */
$di->set('util', function () {
  return new Util();
});
