<?php

require_once __DIR__ . '/../src/FlatMapIterator.php';

class FlatMapIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testIteratingOverNothing()
    {
        $iterator = new FlatMapIterator(new \ArrayIterator(array()), function ($x) {
            return new \RecursiveArrayIterator(array());
        });

        $recursiveIterator = new \RecursiveIteratorIterator($iterator);
        $this->assertEmpty(iterator_to_array($recursiveIterator, false));
    }

    public function testIteratingOverArray()
    {
        $iterator = new FlatMapIterator(new \ArrayIterator(array(1, 2)), function ($x) {
            return new \RecursiveArrayIterator(array($x, $x * 2));
        });

        $recursiveIterator = new \RecursiveIteratorIterator($iterator);
        $this->assertEquals(array(1, 2, 2, 4), iterator_to_array($recursiveIterator, false));
    }

    public function testIteratingOverNestedIterator()
    {
        $iterator = new FlatMapIterator(new \ArrayIterator(array(1, 2)), function ($x) {
            return new \FlatMapIterator(new \ArrayIterator(array('a', 'b')), function ($y) use ($x) {
                return new \RecursiveArrayIterator(array($x, $y));
            });
        });

        $recursiveIterator = new \RecursiveIteratorIterator($iterator);
        $this->assertEquals(array(1, 'a', 1, 'b', 2, 'a', 2, 'b'), iterator_to_array($recursiveIterator, false));
    }
}
