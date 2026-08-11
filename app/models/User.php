<?php

namespace App\models;

class User extends Model
{
    protected string $table = 'users';

    public function countAll(): int
    {
        return $this->count();
    }

    public function all(): array
    {
        return $this->findBy(mode:\PDO::FETCH_OBJ);
    }
}
