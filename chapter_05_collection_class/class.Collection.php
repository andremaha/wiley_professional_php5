<?php
/**
 *
 * Simple collection class that creates a wrapper around array of objects, specifies clear interface to add, delete and
 * get the objects, allows to quickly get the current number of objects in the collection and supports lazy  instantiation
 * in order to save resources.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     wiley_professional_php5
 * @version     0.1
 */
class Collection
{
    private $members = array();
    private $onload;                // Callback
    private $isLoaded = false;      // Flag for the check if the callback has been made

    /**
     * Adds and object to the collection. If the key is specified it will be used, or PHP will set the key itself.
     *
     * @param $obj                  Object to be added to the collection
     * @param string $key           The object identifier inside of the collection
     *
     * @throws CollectionException  When there is already an object with this identifier in the collection.
     */
    public function addItem($obj, $key = null)
    {
        $this->checkCallback();

        if ($key) {
            if (isset($this->members[$key])) {
                throw new CollectionException("The key '" . $key . "' in already in use!");
            } else {
                $this->members[$key] = $obj;
            }
        } else {
            $this->members[] = $obj;
        }
    }

    /**
     * Retrieves an object from the collection using the identifier of this object as an argument.
     *
     * @param $key                  Object identifier
     * @return object               An object matching the identifier provided
     * @throws CollectionException  When there is no object with such identifier in the collection
     */
    public function getItem($key)
    {
        $this->checkCallback();

        if (isset($this->members[$key])) {
            return $this->members[$key];
        } else {
            throw new CollectionException("There is no object with the key '" . $key . "' in the collection!");
        }
    }

    /**
     * Deletes an object from the collection using the identifier as a key
     *
     * @param $key                  Object identifier
     * @throws CollectionException  When there is not object with such identifier in the collection
     */
    public function removeItem($key)
    {
        $this->checkCallback();

        if (isset($this->members[$key])) {
            unset($this->members[$key]);
        } else {
            throw new CollectionException("There is no object with the key '" . $key . "' in the collection!");
        }
    }

    /**
     * Gets the identifier names used in the collection
     *
     * @return array                Object identifiers used in the collection
     */
    public function getKeys()
    {
        $this->checkCallback();

        return array_keys($this->members);
    }

    /**
     * How many objects are there in the collection?
     *
     * @return int                  Amount of objects inside of the collection
     */
    public function length()
    {
        $this->checkCallback();

        return sizeof($this->members);
    }

    /**
     * Does the object with provided identifier exists in the collection?
     *
     * @param $key                  Object identifier
     * @return bool                 Yes or No =)
     */
    public function exists($key)
    {
        $this->checkCallback();

        return isset($this->members[$key]);
    }

    /**
     * Sets the function to be used as a callback and stored in the onload attribute.
     *
     * @param $functionName         Function/Method to call
     * @param null $objClass        If provided we'll use this as an object and the first param will be method of this object
     */
    public function setLoadCallback($functionName, $objOrClass = null)
    {
        if ($objOrClass) {
            $callback = array($objOrClass, $functionName);
        } else {
            $callback = $functionName;
        }

        // Make sure that the function/method is indeed callable
        if (!is_callable($callback, false, $callableName)) {
            throw new Exception("$callableName is not the correct parameter for a callback");
            return false;
        }

        $this->onload = $callback;
    }

    /**
     * Allows to determine if the callback was set and if so if it was already used.
     * If no the callback function is being called
     */
    private function checkCallback()
    {
        if (isset($this->onload) && !$this->isLoaded) {
            $this->isLoaded = true;
            call_user_func($this->onload, $this);
        }
    }


}