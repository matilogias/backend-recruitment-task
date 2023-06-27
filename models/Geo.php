<?php
/*"geo": {
        "lat": "-37.3159",
        "lng": "81.1496"
      }*/
class Geo extends ModelBase
{
    public $lat;
    public $lng;

    /**
     * constructor
     */
    public function __construct($geo = null)
    {
        if (!$geo) {
            return;
        }
        $this->lat = $this->getFromArray($geo, 'lat');
        $this->lng = $this->getFromArray($geo, 'lng');
    }

    /**
     * toArray
     */
    public function toArray()
    {
        return [
            'lat' => $this->lat,
            'lng' => $this->lng
        ];
    }

    /**
     * validate
     */
    public function validate()
    {
        parent::validate();

        return empty($this->errors);
    }
}
