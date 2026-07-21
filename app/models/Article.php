<?php

namespace App\models;

class Article extends Model
{
    protected string $table = 'articles';

    public function countAll(): int
    {
        return $this->count();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }
}
