<?php 

namespace App\Iterator;


/**
 * Aggregate interface.
 */
interface Aggregate {
    public function iterator(): Iterator;
}