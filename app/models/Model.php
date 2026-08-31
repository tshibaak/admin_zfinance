<?php

namespace App\models;

use Helper\Build\Database;

class Model
{
    protected string $table = '';

    protected function db()
    {
        return Database::Instance();
    }


    public function count(array $conditions = []): int
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this->table;
        if ($conditions) {
            $parts = [];
            foreach ($conditions as $column => $value) {
                $parts[] = $column . ' = :' . $column;
            }
            $sql .= ' WHERE ' . implode(' AND ', $parts);
            $stmt = $this->db()->prepare($sql, $conditions);
            return (int) $stmt->fetchColumn();
        }

        return (int) $this->db()->query($sql)->fetchColumn();
    }

    public function findBy(array $conditions = [],int $mode = \PDO::FETCH_ASSOC,int $fetch = 1): array | \stdClass | false
    {
        $sql = 'SELECT * FROM ' . $this->table;
        if ($conditions) {
            $parts = [];
            foreach ($conditions as $column => $value) {
                $parts[] = $column . ' = :' . $column;
            }
            $sql .= ' WHERE ' . implode(' AND ', $parts);
           
            $stmt = $this->db()->prepare($sql, $conditions);
            return  $fetch === 1 ? $stmt->fetch($mode) : $stmt->fetchAll($mode);
        }

        return $this->db()->query($sql)->fetchAll($mode);
    }
}
