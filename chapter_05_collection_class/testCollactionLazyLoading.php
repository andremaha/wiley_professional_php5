<?php
require_once 'class.Collection.php';
require_once 'class.CollectionException.php';

class Tag
{
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

class TagCloud
{
    public $name;
    public $tags;

    public function __construct($name) {
        $this->name = $name;
        $this->tags = new Collection();
        $this->tags->setLoadCallback('loadTags', $this);
    }

    public  function loadTags(Collection $col) {
        print "<Loading Tags into the tagcloud...>\n";

        $col->addItem(new Tag('Apple'));
        $col->addItem(new Tag('Microsoft'));
        $col->addItem(new Tag('Google'));
        $col->addItem(new Tag('Facebook'));
    }
}

$tagCloud = new TagCloud('Big Four');
print "Welcome to " . $tagCloud->name . "\n";

print $tagCloud->name . " consists of " . $tagCloud->tags->length() . " memebers \n";
