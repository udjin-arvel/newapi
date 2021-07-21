<?php

namespace App\Listeners\Crud;

use App\Contracts\Interfaces\HasUpdate;
use App\Models\AModel;

class Update
{
    /**
     * Handle the event.
     *
     * @param AModel $model
     * @return void
     */
    public function handle(AModel $model)
    {
        $model->contracts()->each(function ($contract) use ($model) {
            if ($contract instanceof HasUpdate) {
                $contract->wasUpdate($model);
            }
        });
    }
}
