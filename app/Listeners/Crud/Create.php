<?php

namespace App\Listeners\Crud;

use App\Contracts\Interfaces\HasCreate;
use App\Models\AModel;

class Create
{
    /**
     * Handle the event.
     *
     * @param $model
     * @return void
     */
    public function handle(AModel $model)
    {
        $model->contracts()->each(function ($contract) use ($model) {
            if ($contract instanceof HasCreate) {
                $contract->wasCreate($model);
            }
        });
    }
}
