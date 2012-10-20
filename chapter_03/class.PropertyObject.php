<?php
/**
 * An abstract class that provides a simple interface to get and set properties.
 * It also stores the state - this way we can easily see which properties have changed, so we can then
 * make an update in the database accordingly.
 * The class assumes the use of the database fields that will be named differently then the properties of the object, thus
 * the mapper $propertyTable is created.
 * The class implements the Validator interface and collects all the errors in the $errors protected attribute.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     wiley_professional_php5
 * @version     0.1
 */
require_once 'interface.Validator.php';

abstract class PropertyObject implements Validator
{
    /**
     * @var array The key-value array that maps the human readable property names to the database field names.
     */
    protected $propertyTable = array();

    /**
     * @var array The array with the properties names that have changed - and to be updated in the database.
     */
    protected $changedProperties = array();

    /**
     * @var array The data from the database.
     */
    protected $data = array();

    /**
     * @var array The errors that occure during the lifespan of the object. The errors will be cached by the validate() method.
     */
    protected $errors = array();

    /**
     * Builds and object using an associative array that is coming directly from the pgsql_fetch_assoc() function.
     *
     * @param array $arData The data from the database.
     */
    public function __construct($arData)
    {
        $this->data = $arData;
    }

    /**
     * Generic getter that calls the getPropertyName() method or
     * converts the human readable property names to the field name of the database and gets the value from the
     * $data[propertyName].
     *
     * @param $propertyName
     * @return mixed
     * @throws Exception
     */
    public function __get($propertyName)
    {
        if (!array_key_exists($propertyName, $this->propertyTable)) {
            throw new Exception("The property name '$propertyName' does not exists!'");
        }

        if (method_exists($this, 'get' . ucfirst($propertyName))) {
            return call_user_func(array($this, 'get' . ucfirst($propertyName)));
        } else {
            return $this->data[$this->propertyTable[$propertyName]];
        }
    }

    /**
     * Generic setter that calls the setPropertyName() method or converts the human readable propery names to the field
     * names of the database and sets the value $data[properyName] = value.
     * Also stores the name of the changed property in the protected attribute changedProperties.
     *
     * @param $propertyName
     * @param $value
     * @return mixed
     * @throws Exception
     */
    public function __set($propertyName, $value)
    {
        if (!array_key_exists($propertyName, $this->propertyTable)) {
            throw new Exception("The property name '$propertyName' does not exists!");
        }

        if (method_exists($this, 'set' . ucfirst($propertyName))) {
            return call_user_func(array($this, 'set' . ucfirst($propertyName), $value));
        } else {
            // If the property value has changed we need to track this changes
            if ($this->propertyTable[$propertyName] != $value && !in_array($propertyName, $this->changedProperties)) {
                $this->changedProperties[] = $propertyName;
            }
            return $this->data[$this->propertyTable[$propertyName]] = $value;
        }
    }

    public function validate()
    {

    }

}