<?php
require_once 'class.Musician.php';

$drummer = new Musician();
$drummer->setName('Bob', 'Manson');
$drummer->setType('drummer');
$drummer->setBand('Mashing Bunkers');

echo $drummer->getName() . ' plays in ' . $drummer->getBand() . ' as a ' . $drummer->getType();