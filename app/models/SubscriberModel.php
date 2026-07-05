<?php

namespace App\models;

class SubscriberModel extends Model
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
