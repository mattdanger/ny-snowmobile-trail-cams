<?php
namespace Nystc\Models;

use Phalcon\Mvc\Model;

class Camera extends Model
{

  public $id;
  public $url;
  public $location_id;
  public $data;

  /**
   * Initialize
   */
  public function initialize()
  {

    $this->hasOne('location_id', 'Nystc\Models\Location', 'id', array('alias' => 'Location'));

  }

}