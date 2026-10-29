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
        $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->db()->query($sql);
        return $stmt ? ($stmt->fetchAll(\PDO::FETCH_OBJ) ?: []) : [];
    }

    public function findOne(int $id): object|false
    {
        return $this->findBy(['id' => $id], \PDO::FETCH_OBJ);
    }

    public function create(array $data): bool
    {
        $stmt = $this->db()->prepare(
            'INSERT INTO ' . $this->table . ' (author, company, message, rating)
             VALUES (:author, :company, :message, :rating)',
            [
                'author' => $data['author'],
                'company' => $data['company'] ?? null,
                'message' => $data['message'],
                'rating' => (int) ($data['rating'] ?? 5),
            ]
        );
        return $stmt instanceof \PDOStatement;
    }

    public function update(array $data, int $id): bool
    {
        $stmt = $this->db()->prepare(
            'UPDATE ' . $this->table . ' SET
                author = :author,
                company = :company,
                message = :message,
                rating = :rating
             WHERE id = :id',
            [
                'author' => $data['author'],
                'company' => $data['company'] ?? null,
                'message' => $data['message'],
                'rating' => (int) ($data['rating'] ?? 5),
                'id' => $id,
            ]
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
