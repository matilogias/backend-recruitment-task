<?php

class AgregatorModelBase implements IteratorAggregate
{
    public $data = [];
    public function order($orderBy, $order = 'asc')
    {
    }
    /**
     * order users by property
     * @param string $orderBy
     * @param string $order
     */
    protected static function orderStatic(&$toOrder, $orderBy, $order = 'asc')
    {
        if (empty($orderBy) || !in_array($order, ['asc', 'desc'])) {
            throw new \Exception('Invalid order parameters');
        }
        usort($toOrder, function ($a, $b) use ($orderBy, $order) {
            $aValue = $this->objectWalker($a, $orderBy);
            $bValue = $this->objectWalker($b, $orderBy);

            // <==> operator does not work with different types
            // so we cast everything to string to make it more robust
            if (gettype($aValue) !== gettype($bValue)) {
                $aValue = (string) $aValue;
                $bValue = (string) $bValue;
            }

            if ($order === 'desc') {
                return $bValue <=> $aValue;
            } else {
                return $aValue <=> $bValue;
            }
        });
    }

    /**
     * Walks an object to get the value of a property
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
}