<?php

namespace App\models;

class Role extends Model
{
    protected string $table = 'roles';

    public function countAll(): int
    {
        return $this->count();
    }

    public function all(): array
    {
        return $this->findBy(mode: \PDO::FETCH_OBJ);
    }

    public function getRole(int $id)
    {
     return match($id){
          1 => 'admin',
          2,4 => 'semi-admin',
          default => 'unknow'
        };
    }
}
