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
        return $this->findBy(fetch: 2) ?: [];
    }

    /**
     * Liste enrichie avec catégorie / auteur + filtres optionnels.
     *
     * @param array{status?:string,category_id?:int|string,q?:string} $filters
     */
    public function findFiltered(array $filters = []): array
    {
        $sql = 'SELECT a.*,
                       c.name AS category_name,
                       u.name AS author_name
                FROM ' . $this->table . ' a
                LEFT JOIN categories c ON c.id = a.category_id
                LEFT JOIN users u ON u.id = a.user_id
                WHERE 1=1';
        $params = [];

        if (!empty($filters['status']) && in_array($filters['status'], ['pending', 'published'], true)) {
            $sql .= ' AND a.status = :status';
            $params['status'] = $filters['status'];
        }

        if (!empty($filters['category_id'])) {
            $sql .= ' AND a.category_id = :category_id';
            $params['category_id'] = (int) $filters['category_id'];
        }

        if (!empty($filters['q'])) {
            $sql .= ' AND (a.title LIKE :q OR a.excerpt LIKE :q OR a.content LIKE :q)';
            $params['q'] = '%' . $filters['q'] . '%';
        }

        $sql .= ' ORDER BY a.sort_order ASC, a.created_at DESC';

        $stmt = $this->db()->prepare($sql, $params);
        if ($stmt instanceof \PDOStatement) {
            return $stmt->fetchAll(\PDO::FETCH_OBJ) ?: [];
        }

        return [];
    }

    public function findOne(int $id): object|false
    {
        $sql = 'SELECT a.*,
                       c.name AS category_name,
                       u.name AS author_name
                FROM ' . $this->table . ' a
                LEFT JOIN categories c ON c.id = a.category_id
                LEFT JOIN users u ON u.id = a.user_id
                WHERE a.id = :id
                LIMIT 1';

        $stmt = $this->db()->prepare($sql, ['id' => $id]);
        if ($stmt instanceof \PDOStatement) {
            return $stmt->fetch(\PDO::FETCH_OBJ);
        }

        return false;
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO ' . $this->table . '
                (category_id, status, title, excerpt, user_id, content, image, link, sort_order)
                VALUES
                (:category_id, :status, :title, :excerpt, :user_id, :content, :image, :link, :sort_order)';

        $stmt = $this->db()->prepare($sql, [
            'category_id' => $data['category_id'] ?: null,
            'status' => $data['status'],
            'title' => $data['title'],
            'excerpt' => $data['excerpt'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'content' => $data['content'],
            'image' => $data['image'] ?? null,
            'link' => $data['link'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return $stmt instanceof \PDOStatement;
    }

    public function update(array $data, int $id): bool
    {
        $sql = 'UPDATE ' . $this->table . ' SET
                    category_id = :category_id,
                    status = :status,
                    title = :title,
                    excerpt = :excerpt,
                    content = :content,
                    image = :image,
                    link = :link,
                    sort_order = :sort_order
                WHERE id = :id';

        $stmt = $this->db()->prepare($sql, [
            'category_id' => $data['category_id'] ?: null,
            'status' => $data['status'],
            'title' => $data['title'],
            'excerpt' => $data['excerpt'] ?? null,
            'content' => $data['content'],
            'image' => $data['image'] ?? null,
            'link' => $data['link'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'id' => $id,
        ]);

        return $stmt instanceof \PDOStatement;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db()->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id', [
            'id' => $id,
        ]);

        return $stmt instanceof \PDOStatement;
    }

    public function nextSortOrder(): int
    {
        $stmt = $this->db()->query('SELECT COALESCE(MAX(sort_order), 0) + 1 FROM ' . $this->table);
        if ($stmt === false) {
            return 1;
        }

        return (int) $stmt->fetchColumn();
    }

    /**
     * Échange sort_order avec le voisin immédiat (haut / bas).
     */
    public function move(int $id, string $direction): bool
    {
        $current = $this->findOne($id);
        if (!$current) {
            return false;
        }

        $operator = $direction === 'up' ? '<' : '>';
        $orderDir = $direction === 'up' ? 'DESC' : 'ASC';

        $sql = "SELECT id, sort_order FROM {$this->table}
                WHERE sort_order {$operator} :sort_order
                ORDER BY sort_order {$orderDir}
                LIMIT 1";

        $stmt = $this->db()->prepare($sql, ['sort_order' => (int) $current->sort_order]);
        if (!($stmt instanceof \PDOStatement)) {
            return false;
        }

        $neighbor = $stmt->fetch(\PDO::FETCH_OBJ);
        if (!$neighbor) {
            return false;
        }

        $this->db()->prepare(
            "UPDATE {$this->table} SET sort_order = :sort_order WHERE id = :id",
            ['sort_order' => (int) $neighbor->sort_order, 'id' => $id]
        );
        $this->db()->prepare(
            "UPDATE {$this->table} SET sort_order = :sort_order WHERE id = :id",
            ['sort_order' => (int) $current->sort_order, 'id' => (int) $neighbor->id]
        );

        return true;
    }
}
