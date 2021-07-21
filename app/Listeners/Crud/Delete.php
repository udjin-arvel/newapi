<?php

namespace App\Listeners\Crud;

use App\Contracts\Interfaces\HasDelete;
use App\Models\AModel;

class Delete
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
            if ($contract instanceof HasDelete) {
                $contract->wasDelete($model);
            }
        });
    }
}
