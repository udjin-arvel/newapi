<?php

namespace App\Listeners\Crud;

use App\Contracts\Interfaces\HasUpdate;
use App\Models\AbstractModel;

class Update
{
    /**
     * Handle the event.
     *
     * @param AbstractModel $model
     * @return void
     */
    public function handle(AbstractModel $model)
    {
        $model->contracts()->each(function ($contract) use ($model) {
            if ($contract instanceof HasUpdate) {
                $contract->wasUpdate($model);
            }
        });
    }
}
