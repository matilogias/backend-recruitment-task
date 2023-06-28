<?php

/*"address": {
      "street": "Kulas Light",
      "suite": "Apt. 556",
      "city": "Gwenborough",
      "zipcode": "92998-3874",
      "geo": {
        "lat": "-37.3159",
        "lng": "81.1496"
      }
    },*/
  
class Address extends ModelBase
{
  public $street;
  public $suite;
  public $city;
  public $zipcode;
  public $geo;

  /**
   * constructor
   */
  public function __construct($address = null)
  {
    if (!$address) {
      return;
    }
    $this->street = $this->getFromArray($address, 'street');
    $this->suite = $this->getFromArray($address, 'suite');
    $this->city = $this->getFromArray($address, 'city');
    $this->zipcode = $this->getFromArray($address, 'zipcode');
    $this->geo = $this->getFromArray($address, 'geo', null, Geo::class);
  }

  /**
   * toArray
   */
  public function toArray()
  {
    return [
      'street' => $this->street,
      'suite' => $this->suite,
      'city' => $this->city,
      'zipcode' => $this->zipcode,
      'geo' => $this->geo->toArray()
    ];
  }

  /**
   * validate
   */
  public function validate()
  {
    parent::validate();

    $this->required('city');

    if (!$this->geo->validate()) {
      $this->errors = array_merge($this->errors, $this->geo->getErrors());
    }
    return empty($this->errors);
  }
}
