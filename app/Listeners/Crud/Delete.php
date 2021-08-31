<?php

namespace App\Listeners\Crud;

use App\Contracts\Interfaces\HasDelete;
use App\Models\AbstractModel;

class Delete
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
            if ($contract instanceof HasDelete) {
                $contract->wasDelete($model);
            }
        });
    }
}
