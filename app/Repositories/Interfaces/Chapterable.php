<?php

namespace App\Repositories\Interfaces;

interface Chapterable {
    /**
     * @param int $id
     * @param string $keeperType
     * @return mixed
     */
    public function getChapters(int $id, string $keeperType);
}