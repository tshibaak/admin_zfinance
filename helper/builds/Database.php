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

        try {
                $driver = strtolower($this->config['DB_SGBD']);
           
                $dsn = $driver . ':host=' . $this->config['DB_HOST'] . ';dbname=' . $this->config['DB_NAME'] . ';charset=utf8mb4';
                $this->connexion = new \PDO($dsn, $this->config['DB_USER'], $this->config['DB_MDP'], [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]);
            
        } catch (\PDOException $e) {
            $this->connexion = null;
            LogManagement::Instance()->error($e->getMessage());
           
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
        try 
        {
          if ($this->connexion === null) {
              throw new \RuntimeException('La connexion à la base de données n\'est pas disponible.');
          }
            return $this->connexion->query($request);
        } 
        catch (\PDOException $e)
        {
            LogManagement::Instance()->error($e->getMessage());
            return false;
        } 
        catch (\RuntimeException $e) 
        {
            LogManagement::Instance()->error($e->getMessage());
            return false;
        }
    }
      
    public function prepare(string $request, array $params = [])
    {
        try
        {
            if ($this->connexion === null){
               throw new \RuntimeException('La connexion à la base de données n\'est pas disponible.');
             }
            $smt = $this->connexion->prepare($request);
            $smt->execute($params);
            return $smt;
        } 
        catch (\PDOException $e) 
        {
            LogManagement::Instance()->error($e->getMessage());
            return new \PDOException($e->getMessage());
        }
        catch(\RuntimeException $e){
            LogManagement::Instance()->error($e->getMessage());
            return  new \RuntimeException($e->getMessage());
        }

       
    }
}
?>