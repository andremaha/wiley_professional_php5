<?php
/**
 *
 * Example of the simple class using PostreSQL.
 * Important are the constructor and descrucord - since there the database connection is established
 * and then closed.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     wiley_professional_php5
 * @version     0.1
 */

class Widget
{
    private $id;
    private $name;
    private $description;
    private $hDB;
    private $needsUpdating = false;

    /**
     * Connects to the database and selects one row based on the primary key,
     * populating the properties of the class with values from the database.
     *
     * @param $widgetID The primary key of the widget table
     */
    public function __construct($widgetID)
    {
        // Create DB handler and save in the private property
        $this->hDB = pg_connect('dbname=books_proffesional_php5 user=mahmood1');
        if (!is_resource($this->hDB)) {
            throw new Exception('Could not connect to the Database =(');
        }

        $sql = "SELECT \"name\", \"description\" FROM widget WHERE
                 widgetid = $widgetID";
        $rs = pg_query($this->hDB, $sql);
        if (!is_resource($rs)) {
            throw new Exception('Could not select the data from the database.');
        }

        if (!pg_num_rows($rs)) {
            throw new Exception('There is no such entry in the database.');
        }

        $data = pg_fetch_array($rs);
        $this->id = $widgetID;
        $this->name = $data['name'];
        $this->description = $data['description'];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->needsUpdating = true;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->needsUpdating = true;
    }

    /**
     * Updates the database row if the client code has changed the values via setName() or setDescription().
     * After the update is done the connection to the database gets closed.
     */
    public function __destruct()
    {
        if(!$this->needsUpdating) {
            return;
        }

        $sql = 'UPDATE "widget" SET ';
        $sql .= "\"name\" = '" . pg_escape_string($this->name) . "', ";
        $sql .= "\"description\" = '" . pg_escape_string($this->description) . "' ";
        $sql .= "WHERE widgetid = " . $this->id;

        $rs = pg_query($sql);
        if (!is_resource($rs)) {
            throw new \ElasticSearch\Exception('An error occurred while updating the database');
        }

        // close the connection
        pg_close($this->hDB);
    }
}