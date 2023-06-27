<?php

class ModelBase
{
    public $errors = [];

    public function toArray()
    {
        return [];
    }

    public function validate()
    {
        $errors = [];
        return true;
    }

    /**
     * required
     */
    public function required($varName)
    {
        if (!property_exists($this, $varName)) {
            $this->errors[] = $varName . ' is not set (probably error in code)';
            return false;
        }

        if (empty($this->{$varName})) {
            $this->errors[] = $varName . ' is required';
            return false;
        }

        return true;
    }

    /**
     * isEmail
     */
    public function isEmail($varName)
    {
        if (!isset($this->$varName)) {
            $this->errors[] = $varName . ' is not set (probably error in code)';
            return false;
        }
        if (!filter_var($this->$varName, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = $varName . ' is not valid email';
            return false;
        }
        return true;
    }

    /**
     * multiCheck
     * @param array $varNames
     * @param string $type
     */
    public function multiCheck($varNames, $type)
    {
        $allowedTypes = ['required', 'email'];
        if (!in_array($type, $allowedTypes)) {
            throw new Exception('Type ' . $type . ' is not allowed');
        }
        $results = [];
        foreach ($varNames as $varName) {
            $results[] = $this->$type($varName);
        }

        return !in_array(false, $results);
    }

    /**
     * getErrors
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * getFromArray
     */
    public function getFromArray($array, $varName, $default = null, $className = null)
    {
        if (!property_exists($this, $varName)) {
            return $default;
        }
        if ($className) {
            return new $className($this->valueFromObjectOrArray($array, $varName));
        }
        return $this->valueFromObjectOrArray($array, $varName);
    }

    /**
     * valueFromObjectOrArray
     */
    public function valueFromObjectOrArray($object, $varName)
    {
        if (is_object($object)) {
            return $object->$varName ?? null;
        }
        if (is_array($object)) {
            return $object[$varName] ?? null;
        }
        return null;
    }
}
