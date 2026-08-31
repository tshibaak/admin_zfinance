<?php 
namespace Core;

class Session{
    public static function ensureRole(string $role,string $sessionRole):bool{
        return $role === $sessionRole ? true : false;
    }

    public static function sessionExist(){
        
        return isset($_SESSION['user']) ? $_SESSION['auth'] : false;
    }

    public static function role(){
        return htmlentities($_SESSION['user']['role'] ?? null, ENT_QUOTES, 'UTF-8') ;
    }

    public static function userId(){
        return htmlentities($_SESSION['user']['id'] ?? null, ENT_QUOTES, 'UTF-8');
    }

    public static function userName(){
        return htmlentities($_SESSION['user']['name'] ?? 'Unknow', ENT_QUOTES, 'UTF-8');
    }
}

?>