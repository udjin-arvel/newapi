<?php

namespace App\Models\Traits;

use App\Exceptions\TBError;

trait DataHelperTrait {
    /**
     * @param array $data
     */
    public function setAttributesFromArray(array $data): void
    {
        if (empty($this->fillable)) {
            return;
        }
        
        foreach ($data as $key => $input) {
            if (in_array($key, $this->fillable)) {
                $this->{$key} = $input;
            }
        }
    }
}