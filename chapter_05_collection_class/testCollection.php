<?php
require_once 'class.Collection.php';
require_once 'class.CollectionException.php';

/**
 * Simple class to test the Collection class with
 */
class President
{
    private $name;
    private $party;

    public function __construct($name, $party)
    {
        $this->name = $name;
        $this->party = $party;
    }

    public function __toString()
    {
        return $this->name . ' is a ' . $this->party;
    }
}

$colPresidents = new Collection();
$colPresidents->addItem(new President('Bill Clinton', 'democrat'), 'clinton');
$colPresidents->addItem(new President('George Bush', 'republican'), 'bush');
$colPresidents->addItem(new President('Barack Obama', 'deomcrat'));

$bill = $colPresidents->getItem('clinton');
print $bill . "\n";
$colPresidents->removeItem('clinton');

try {
    print $colPresidents->getItem('clinton');
} catch (CollectionException $e) {
    print "There is an error in our collection: \t" . $e->getMessage() . "\n";
}
