<?php
namespace Nystc\Models;

use Phalcon\Mvc\Model;

class Location extends Model
{

  public $id;
  public $name;
  public $club_id;
  public $lat;
  public $long;
  public $data;

  /**
   * Initialize
   */
  public function initialize()
  {

/*     $this->hasOne('club_id', 'Nystc\Models\Club', 'id', array('alias' => 'Club')); */
    $this->hasMany('id', 'Nystc\Models\Camera', 'location_id', array('alias' => 'Cameras'));

  }


  /**
   * Build response
   *
   * @return object
   */
  public function response()
  {

    $cameras = array();
    foreach ($this->cameras as $cam) {
      $cameras[] = (object) [
        'url' => $cam->url,
      ];
    }

    return (object) [
      'name' => $this->name,
      'cameras' => $cameras,
      'geo' => (object) [
        'lat' => $this->lat,
        'long' => $this->long,
      ],
    ];

  }


}