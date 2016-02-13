<?php
namespace Nystc\Util;

use Phalcon\Mvc\User\Component;

/**
 * Nystc\Util\Util
 */
class Util extends Component
{

  /**
   * Format response
   *
   * @param string $status
   * @param array $messages
   * @return json
   */
  function response($status, $messages) {
  
    $response = (object) [
      'status' => $status,
      'messages' => $messages,
    ];
  
    return json_encode($response);
  
  }

}
