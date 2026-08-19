<?php

namespace App\models;

class Category extends Model
{
    protected string $table = 'categories';

    public function all(): array
    {
        return $this->findBy(mode: \PDO::FETCH_OBJ);
    }

    public function create(array $data)
    {
      $this->db()->prepare("INSERT INTO {$this->table} (name) VALUES(:name)",[
        'name' => $data['name'],
     ]);
    }

    public function update(array $data, int $id)
    {
        $this->db()->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id", [
            'name' => $data['name'],
            'id' => $id,
        ]);
    }


    public function delete(int $id)
    {
        $this->db()->prepare("DELETE FROM {$this->table} WHERE id = :id", [
            'id' => $id,
        ]);
    }
}
