# Iterator

An assortment of [Iterators](http://www.php.net/manual/en/class.iterator.php)
for PHP based on [Guzzle Iterator](https://github.com/guzzle/iterator).

## FlatMapIterator

```haskell
FlatMapIterator :: Traversable a -> (a -> RecursiveIterator b) -> RecursiveIterator b
```

Maps over values in a
[Traversable](http://php.net/manual/en/class.traversable.php), applying a
function that returns a
[RecursiveIterator](http://uk3.php.net/manual/en/class.recursiveiterator.php)
(e.g. a
[RecursiveArrayIterator](http://uk3.php.net/manual/en/class.recursivearrayiterator.php))
and returns a new RecursiveIterator of the new values.

This can then be used with a
[RecursiveIteratorIterator](http://uk3.php.net/manual/en/class.recursiveiteratoriterator.php)
to flatten all values like so:

```php
$iterator = new FlatMapIterator(new \ArrayIterator(array(1, 2)), function ($x) {
    return new \RecursiveArrayIterator(array($x, $x * 2));
});

$recursiveIterator = new \RecursiveIteratorIterator($iterator);
$values = iterator_to_array($recursiveIterator, false));
// => array(1, 2, 2, 4);
```

## License

Copyright © 2014 Paul Mucur.

Distributed under the MIT License.
