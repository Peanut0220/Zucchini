<?php
//Author: Chong Jian
namespace App\Iterator;


/**
 * Aggregate interface.
 */
interface Aggregate {
    public function iterator(): Iterator;
}
