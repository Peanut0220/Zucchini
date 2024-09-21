<?php
//Author: Chong Jian
namespace App\Iterator;
use App\Iterator\Aggregate;



/**
 * Concrete implementation of Aggregate.
 *
 * @template T
 */
class ConcreteAggregate implements Aggregate {
    /**
     * @var T[] Array of model items
     */
    private $items;

    /**
     * Constructor to initialize the aggregate with an array of items.
     *
     * @param T[] $items Array of model items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    public function iterator(): Iterator {
        return new ConcreteIterator($this->items);
    }
}
