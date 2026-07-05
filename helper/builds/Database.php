<?php

namespace Helper\Build;

use Helper\Log\LogManagement;

class Database
{
    private $config;
    private $connexion;
    private static $instance;

    public function __construct()
    {
        $this->config = require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';

        if (empty($this->config['DB_HOST'])) {
            $this->config['DB_HOST'] = '127.0.0.1';
        }
        if (empty($this->config['DB_NAME'])) {
            $this->config['DB_NAME'] = 'zfinance';
        }
        if (empty($this->config['DB_USER'])) {
            $this->config['DB_USER'] = 'root';
        }
        if (empty($this->config['DB_MDP'])) {
            $this->config['DB_MDP'] = '';
        }
        if (empty($this->config['DB_SGBD'])) {
            $this->config['DB_SGBD'] = 'mysql';
        }

        try {
            $driver = strtolower($this->config['DB_SGBD']);
           
            if ($driver === 'sqlite' || !extension_loaded('pdo_mysql')) {
                $dbPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'zfinance.sqlite';
                if (!is_dir(dirname($dbPath))) {
                    mkdir(dirname($dbPath), 0777, true);
                }

                $this->connexion = new \PDO('sqlite:' . $dbPath, null, null, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]);
                $this->initializeSqliteSchema();
            } else {
                $dsn = $driver . ':host=' . $this->config['DB_HOST'] . ';dbname=' . $this->config['DB_NAME'] . ';charset=utf8mb4';
                $this->connexion = new \PDO($dsn, $this->config['DB_USER'], $this->config['DB_MDP'], [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]);
            }
        } catch (\PDOException $e) {
            $this->connexion = null;
            LogManagement::Instance()->error($e->getMessage());
            throw $e;
        }
    }

    private function initializeSqliteSchema(): void
    {
        $queries = [
            "CREATE TABLE IF NOT EXISTS contacts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT NOT NULL,
                email TEXT NOT NULL,
                telephone TEXT,
                sujet TEXT NOT NULL,
                message TEXT NOT NULL,
                statut TEXT DEFAULT 'non_lu',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS subscribers (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL UNIQUE,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS testimonials (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                author TEXT NOT NULL,
                company TEXT,
                message TEXT NOT NULL,
                rating INTEGER NOT NULL DEFAULT 5,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS admin (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nameAdmin TEXT NOT NULL UNIQUE,
                passAdmin TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS articles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                content TEXT,
                image TEXT,
                link TEXT
            )",
        ];

        foreach ($queries as $query) {
            $this->connexion->exec($query);
        }
    }

    public static function Instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query(string $request)
    {
        if ($this->connexion === null) {
            throw new \RuntimeException('La connexion à la base de données n\'est pas disponible.');
        }

        return $this->connexion->query($request);
    }

    public function prepare(string $request, array $params = [])
    {
        if ($this->connexion === null) {
            throw new \RuntimeException('La connexion à la base de données n\'est pas disponible.');
        }

        $smt = $this->connexion->prepare($request);
        $smt->execute($params);

        return $smt;
    }
}
?>