<?php
/*
"company": {
    "name": "Romaguera-Crona",
    "catchPhrase": "Multi-layered client-server neural-net",
    "bs": "harness real-time e-markets"
  }
  */
class Company extends ModelBase
{
  public $name;
  public $catchPhrase;
  public $bs;

  /**
   * constructor
   */
  public function __construct($company = null)
  {
    if (!$company) {
      return;
    }
    $this->name = $this->getFromArray($company, 'name');
    $this->catchPhrase = $this->getFromArray($company, 'catchPhrase');
    $this->bs = $this->getFromArray($company, 'bs');
  }

  /**
   * toArray
   */
  public function toArray()
  {
    return [
      'name' => $this->name,
      'catchPhrase' => $this->catchPhrase,
      'bs' => $this->bs
    ];
  }

  /**
   * validate
   */
  public function validate()
  {
    parent::validate();

    $this->required('name');

    return empty($this->errors);
  }
}
