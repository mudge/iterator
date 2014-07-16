<?php

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

