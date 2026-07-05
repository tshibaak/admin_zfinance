<?php

namespace App\models;

class TestimonialModel extends Model
{
    protected string $table = 'testimonials';

    public function countAll(): int
    {
        return $this->count();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }
}
