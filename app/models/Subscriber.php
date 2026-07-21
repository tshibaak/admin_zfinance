<?php

namespace App\models;

class Subscriber extends Model
{
    protected string $table = 'subscribers';

    public function countAll(): int
    {
        return $this->count();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }
}
