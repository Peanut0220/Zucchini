<?php
//Author: Chong Jian
namespace App\Iterator;

/**
 * Iterator interface.
 */
interface Iterator {
    public function current();
    public function next();
    public function key();
    public function valid();
    public function rewind();
}
