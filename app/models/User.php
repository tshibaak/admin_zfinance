<?php

namespace App\models;

class User extends Model
{
    protected string $table = 'users';

    public function countAll(): int
    {
        return $this->count();
    }

    public function all(): array
    {
        return $this->findBy(mode:\PDO::FETCH_OBJ);
    }

    public function update(array $datas): void{

      $this->db()->prepare('UPDATE ' .$this->table.' SET  role_id = ?,name = ?, email = ?, pass = ? WHERE id = ?', $datas);
    }

    public function delete(int $id): void
    {
        $this->db()->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id', ['id' => $id]);
    }
}
