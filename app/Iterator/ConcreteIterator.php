<?php

namespace App\Iterator;

/**
 * Concrete implementation of Iterator for model items.
 *
 * @template T
 */
class ConcreteIterator implements Iterator {
    /**
     * @var T[] Array of model items
     */
    private $items;

    /**
     * @var int Current position in the array
     */
    private $position = 0;

    /**
     * Constructor to initialize the iterator with an array of items.
     * 
     * @param T[] $items Array of model items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->items[$this->position] ?? null;
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->items[$this->position]);
    }
}
