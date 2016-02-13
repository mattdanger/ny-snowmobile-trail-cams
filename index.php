<?php
error_reporting(E_ALL ^E_NOTICE);

use Phalcon\Mvc\Micro;
use Nystc\Models\Camera;

try {

  /**
   * Read the configuration
   */
  $config = include 'app/config/config.php';

  /**
   * Read autoloader
   */
  include 'app/loader.php';

  /**
   * Read services
   */
  include 'app/services.php';

  /**
   * Create Phalcon micro app
   */
  $app = new Micro();
  $app->setDI($di);


  /**
   * CORS
   */
  $app->before(function() use ($app) {

    if (!$app->config->debug_mode) {
    
      // Allowed origin
      $http_origin = $app->request->getHeader('HTTP_ORIGIN');
      if  (!in_array($http_origin, (array) $app->config->allowed_origins)) {
        $app->response->setStatusCode(403, 'Access denied')->send();
      } else {
        foreach ($app->config->allowed_origins as $origin) {
          if ($http_origin == $origin) {
            $app->response->setHeader('Access-Control-Allow-Origin', $origin);
          }
        }
      }
  
      $app->response
        ->setHeader('Access-Control-Allow-Methods', 'GET')
        ->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Range, Content-Disposition, Accept, Content-Type, Authorization');
  
      $app->response->send();

    }

  });

  $app->options('/{catch:(.*)}', function() use ($app) {
    $app->response->setStatusCode(200, 'OK')->send();
  });


  /**
   * GET /ping
   */
  $app->get('/ping', function() use ($app) {

    echo $app->util->response(200, array('Pong'));

  });


  /**
   * GET /locations
   */
  $app->get('/api/locations', function() use ($app) {

    $locations = $app->modelsManager->executeQuery("SELECT * FROM Nystc\Models\Location");

    $results = array();
    foreach ($locations as $l) {
      $results[] = $l->response();
    }

    echo json_encode($results);

  });

  /**
   * GET /locations/$id
   */
  $app->get('/api/locations/{id}', function($id) use ($app) {

    $result = $app->modelsManager
      ->executeQuery("SELECT * FROM Nystc\Models\Location WHERE id = :id:", array('id' => $id))
      ->getFirst();

    if ($result) {

      echo json_encode($result->response());

    } else {
    
      $app->response->setStatusCode(404, 'Not Found')->sendHeaders();

    }    

  });


  /**
   * Route all unknown URLs to 404
   */
  $app->notFound(function() use ($app) {
    $app->response->setStatusCode(404, 'Not Found')->sendHeaders();
  });


  /**
   * Execute
   */
  $app->handle();

} catch (Exception $e) {

  error_log($e->getMessage());

  // Uncomment to help with debugging:
  print $e->getMessage() . '<br>' . nl2br(htmlentities($e->getTraceAsString()));

}
