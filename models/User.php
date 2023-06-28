<?php
/*
 {
    "id": 1,
    "name": "Leanne Graham",
    "username": "Bret",
    "email": "Sincere@april.biz",
    "address": {
      "street": "Kulas Light",
      "suite": "Apt. 556",
      "city": "Gwenborough",
      "zipcode": "92998-3874",
      "geo": {
        "lat": "-37.3159",
        "lng": "81.1496"
      }
    },
    "phone": "1-770-736-8031 x56442",
    "website": "hildegard.org",
    "company": {
      "name": "Romaguera-Crona",
      "catchPhrase": "Multi-layered client-server neural-net",
      "bs": "harness real-time e-markets"
    }
  },
 */

class User extends ModelBase
{
  public $id;
  public $name;
  public $username;
  public $email;
  public $address;
  public $phone;
  public $website;
  public $company;

  /**
   * constructor
   */
  public function __construct($user = null)
  {
    if (!$user) {
      return;
    }
    $this->id = $this->getFromArray($user, 'id');
    $this->name = $this->getFromArray($user, 'name');
    $this->username = $this->getFromArray($user, 'username');
    $this->email = $this->getFromArray($user, 'email');
    //$this->address = $user->address ?? null;
    //$this->address = ($this->address != null) ? new Address($user->address) : new Address();
    $this->address = $this->getFromArray($user, 'address', null, Address::class);
    $this->phone = $this->getFromArray($user, 'phone');
    $this->website = $this->getFromArray($user, 'website');
    $this->company = $this->getFromArray($user, 'company', null, Company::class);
  }

  /**
   * toArray
   */
  public function toArray()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'username' => $this->username,
      'email' => $this->email,
      'address' => $this->address->toArray(),
      'phone' => $this->phone,
      'website' => $this->website,
      'company' => $this->company
    ];
  }

  /**
   * validate
   * @return boolean
   */
  public function validate()
  {
    parent::validate();
    
    $requiredFields = ['name', 'username', 'email', 'address'];
    $this->multiCheck($requiredFields, 'required');

    $this->isEmail('email');

    if ($this->company->validate()) {
      $this->errors = array_merge($this->errors, $this->company->getErrors());
    }
    return empty($this->errors);
  }


}
