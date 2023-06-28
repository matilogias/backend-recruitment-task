<?php

class AgregatorModelBase implements IteratorAggregate
{
    public $data = [];

    public $orderBy = null;
    public $order = null;

    protected $nestedAliases = [];

    /**
     * get nested property by alias
     * @param string $alias
     * @return mixed
     */
    public function getNestedPropertyByAlias($alias)
    {
        if (
            !isset($this->nestedAliases[$alias])
            || empty($alias)
            || !is_string($alias)
            || empty($this->nestedAliases[$alias])
        ) {
            return false;
        }

        return $this->nestedAliases[$alias];
    }


    /**
     * order data by value of any object property or nested property
     * nested property is defined by dot notation eg. address.street = $data->address->street
     * for safety 
     * @param string $orderBy
     * @param string $order
     */
    public function order($orderBy, $order = 'asc')
    {
        $this->orderBy = 'id';
        $this->order = 'asc';
        $orderByAafterAlias = $this->getNestedPropertyByAlias($orderBy);
        if (empty($orderBy) || !in_array($order, ['asc', 'desc'])) {
            return false;
        }


        if (!$orderByAafterAlias) {
            return false;
        }

        usort($this->data, function ($a, $b) use ($orderByAafterAlias, $order) {
            $aValue = $this->objectWalker($a, $orderByAafterAlias);
            $bValue = $this->objectWalker($b, $orderByAafterAlias);

            // <==> operator does not work with different types
            // so we cast everything to string to make it more robust
            if (gettype($aValue) !== gettype($bValue)) {
                $aValue = (string) $aValue;
                $bValue = (string) $bValue;
            }
            
            if (is_string($aValue)) $aValue = strtolower($aValue);
            if (is_string($bValue)) $bValue = strtolower($bValue);

            if ($order === 'desc') {
                return $bValue <=> $aValue;
            } else {
                return $aValue <=> $bValue;
            }
        });

        $this->orderBy = $orderBy;
        $this->order = $order;
    }



    /**
     * Walks an object to get the value of a property by dot notation eg. address.street = $data->address->street
     * @param object $object
     * @param string $property
     * @return mixed
     */
    protected static function objectWalker($object, $property)
    {
        $value = $object;
        $propertyParts = explode('.', $property);
        foreach ($propertyParts as $part) {
            if (!is_object($value) || !property_exists($value, $part)) {
                throw new \Exception('Invalid property: ' . $property);
            }
            $value = $value->$part;
        }
        return $value;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator([]);
    }

    /**
     * getOrderLinkValues - returns string with current orderby and order values
     */
    public function getOrderLinkValues($before = null, $orderby = null, $order = null)
    {
        if (empty($orderby)) {
            $orderby = $this->orderBy;
        }

        if (empty($order)){
            $order = $this->order;
        }
        
        
        $before = (is_string($before) ? $before : '');

        return $before . 'orderby=' . $orderby . '&order=' . $order;
    }

    /**
     * getLinkValuesForOrder - returns string with values for orderby and order
     * id $orderby = $this->orderBy and $order = $this->order then return string with opposite order
     * @param String $orderby
     * @param String $order
     * @return string
     */
    public function getLinkValuesForOrder($before = null, $orderby, $order = 'asc')
    {
        if (empty($orderby) || empty($order) && $order !== 'asc' && $order !== 'desc') {
            return '';
        }

        return $this->getOrderLinkValues($before, $orderby, ($this->orderBy == $orderby && $this->order == $order ? ($order == 'asc' ? 'desc' : 'asc') : $order));
    }

    

}
