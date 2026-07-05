<?php

namespace App\models;

class AdminModel extends Model
{
    protected string $table = 'admin';

    public function countAll(): int
    {
        return $this->count();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }

    public function authenticate(string $username, string $password): bool
    {
        $admin = $this->findBy([
            'nameAdmin' => $username,
            'passAdmin' => $password,
        ]);

        return !empty($admin);
    }
}
