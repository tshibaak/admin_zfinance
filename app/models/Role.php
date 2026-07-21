<?php

namespace App\models;

class Role extends Model
{
    protected string $table = 'roles';

    public function countAll(): int
    {
        return $this->count();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }

    public function getRole(int $id)
    {
     return match($id){
          1 => 'admin',
          default => 'unknow'
        };
    }
}
