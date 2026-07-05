<?php

namespace App\models;

class ContactModel extends Model
{
    protected string $table = 'contacts';

    public function countAll(): int
    {
        return $this->count();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }

    public function countUnread(): int
    {
        return $this->count(['statut' => 'non_lu']);
    }
}
