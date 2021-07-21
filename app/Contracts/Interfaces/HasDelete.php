<?php

namespace App\Contracts\Interfaces;

/**
 * HasDelete interface.
 */
interface HasDelete
{
    public function wasDelete($model);
}
