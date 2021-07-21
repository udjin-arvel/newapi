<?php

namespace App\Contracts\Interfaces;

/**
 * HasView interface.
 */
interface HasView
{
    public function wasView($model, $viewerId);
}
