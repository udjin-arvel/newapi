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
     * @return mixed
     */
    public function save(array $data);
    
    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}