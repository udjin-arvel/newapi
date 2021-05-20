<?php

namespace App\Repositories\Interfaces;

interface IWriteableRepository {
    /**
     * @param int $id
     * @return mixed
     */
    public function one(int $id);
    
    /**
     * @return mixed
     */
    public function all();
    
    /**
     * @param array $data
     * @return int
     */
    public function save(array $data): int;
    
    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}