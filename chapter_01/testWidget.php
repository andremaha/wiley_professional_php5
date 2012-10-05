<?php
/**
 *
 * Tests the widget class
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     wiley_professional_php5
 * @version     0.1
 */

require_once 'class.Widget.php';

try {
    $objWidget = new Widget(1);

    print "Element name: " . $objWidget->getName() . "<br />";
    print "Element description: " . $objWidget->getDescription() . "<br />";

    $objWidget->setName($objWidget->getName() . '-' . time());
    $objWidget->setDescription($objWidget->getDescription() . ' Updated: ' . strftime('%c',time()));

} catch (Exception $e) {
    die ("There was a critical error: " . $e->getMessage());
}