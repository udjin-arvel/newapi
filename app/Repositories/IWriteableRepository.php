<?php

namespace App\Repositories;

interface IWriteableRepository {
    /**
     * @param string $method
     * @return mixed
     */
    public static function call(string $method);
    
    /**
     * @param int $id
     * @return mixed
     */
    public function one(int $id);
    
    /**
     * @return array
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
    
    /**
     * @param int $id
     * @return mixed
     */
    public function getModel(int $id);
}