<?php

namespace App\Listeners\Crud;

use App\Contracts\Interfaces\HasView;

class One
{
    /**
     * Handle the event.
     *
     * @param object $payload - object has model and viewer_id attributes
     * @return void
     */
    public function handle($payload)
    {
        $payload->model->contracts()->each(function ($contract) use ($payload) {
            if ($contract instanceof HasView) {
                $contract->wasView($payload->model, $payload->viewer_id);
            }
        });
    }
}
