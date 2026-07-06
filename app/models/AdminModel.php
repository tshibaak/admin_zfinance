<?php

namespace App\models;

class AdminModel extends Model
{
    protected string $table = 'admins';

    public function countAll(): int
    {
        return $this->count();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }
}
