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
        $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->db()->query($sql);
        return $stmt ? ($stmt->fetchAll(\PDO::FETCH_OBJ) ?: []) : [];
    }

    public function findOne(int $id): object|false
    {
        return $this->findBy(['id' => $id], \PDO::FETCH_OBJ);
    }

    public function countUnread(): int
    {
        return $this->count(['statut' => 'non_lu']);
    }

    public function markAsRead(int $id): bool
    {
        $stmt = $this->db()->prepare(
            'UPDATE ' . $this->table . " SET statut = 'lu' WHERE id = :id",
            ['id' => $id]
        );
        return $stmt instanceof \PDOStatement;
    }

    public function markAsUnread(int $id): bool
    {
        $stmt = $this->db()->prepare(
            'UPDATE ' . $this->table . " SET statut = 'non_lu' WHERE id = :id",
            ['id' => $id]
        );
        return $stmt instanceof \PDOStatement;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db()->prepare(
            'DELETE FROM ' . $this->table . ' WHERE id = :id',
            ['id' => $id]
        );
        return $stmt instanceof \PDOStatement;
    }
}
