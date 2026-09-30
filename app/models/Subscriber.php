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
        $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->db()->query($sql);
        return $stmt ? ($stmt->fetchAll(\PDO::FETCH_OBJ) ?: []) : [];
    }

    public function findOne(int $id): object|false
    {
        return $this->findBy(['id' => $id], \PDO::FETCH_OBJ);
    }

    public function findByEmail(string $email): object|false
    {
        return $this->findBy(['email' => $email], \PDO::FETCH_OBJ);
    }

    public function create(string $email): bool
    {
        $stmt = $this->db()->prepare(
            'INSERT INTO ' . $this->table . ' (email) VALUES (:email)',
            ['email' => $email]
        );
        return $stmt instanceof \PDOStatement;
    }

    public function updateEmail(int $id, string $email): bool
    {
        $stmt = $this->db()->prepare(
            'UPDATE ' . $this->table . ' SET email = :email WHERE id = :id',
            ['email' => $email, 'id' => $id]
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
