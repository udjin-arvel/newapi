<?php

namespace App\Repositories;

interface Chaptered {
    
    /**
     * Получить главы
     *
     * @param int id
     * @return array
     */
    public function getChapters(int $id);
}