<?php

namespace App\Listeners\Crud;

use App\Contracts\Interfaces\HasCreate;
use App\Models\AbstractModel;

class Create
{
    /**
     * Handle the event.
     *
     * @param $model
     * @return void
     */
    public function handle(AbstractModel $model)
    {
        $model->contracts()->each(function ($contract) use ($model) {
            if ($contract instanceof HasCreate) {
                $contract->wasCreate($model);
            }
        });
    }
}
