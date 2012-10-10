<?php

/**
 * Represents the musician of the BandSpy project. Each musician can play some
 * - type, have first and last names - firstName, lastName, and be part of the
 *
 * @author Andrey Esaulov
 * @since 2012-10-10
 * @version 0.1
 */

/**
 * Represents the musician of the BandSpy project. Each musician can play some
 * - type, have first and last names - firstName, lastName, and be part of the
 *
 * @access public
 * @author Andrey Esaulov
 * @since 2012-10-10
 * @version 0.1
 */
class Musician
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * What does musician do in the band?
     *
     * @access private
     * @var String
     */
    private $type = null;

    /**
     * First name of the musician.
     *
     * @access private
     * @var String
     */
    private $firstName = null;

    /**
     * Last name of the musician.
     *
     * @access private
     * @var String
     */
    private $lastName = null;

    /**
     * Name of the band musican plays in.
     *
     * @access private
     * @var String
     */
    private $bandName = null;

    // --- OPERATIONS ---

    /**
     * The name of the band the musician plays in
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return String
     */
    public function getBand()
    {
        return $this->bandName;
    }

    /**
     * Gets the full name of the musician, consisting of the first and the last
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return String
     */
    public function getName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Gets the role the musician is playing in the band.
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the name of the band the musician is playing in.
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  String bandName
     */
    public function setBand( $bandName)
    {
       $this->bandName = $bandName;
    }

    /**
     * Set the type of the musician, his role in the band.
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  String type
     */
    public function setType( String $type)
    {
        $this->type = $type;
    }

    /**
     * Sets the first and the last name of the musician
     *
     * @access public
     * @author firstname and lastname of author, <author@exsample.org>
     * @param  String firstName
     * @param  String lastName
     */
    public function setName( string $firstName,  string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

} /* end of class Musician */

?>