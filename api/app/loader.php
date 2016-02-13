<?php

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(array(
  'Nystc' => $config->library,
  'Nystc\Models' => 'app/models/',
))->register();

// Use composer autoloader to load vendor classes
require_once __DIR__ . '/../vendor/autoload.php';