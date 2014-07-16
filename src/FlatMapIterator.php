<?php

require_once __DIR__ . '/../vendor/autoload.php';

class FlatMapIterator extends \Guzzle\Iterator\MapIterator implements \RecursiveIterator
{
    public function hasChildren()
    {
        return true;
    }

    public function getChildren()
    {
        return $this->current();
    }
}

