<?php 
namespace Core;

class Session{
    public static function ensureRole(string $role,string $sessionRole):bool{
        return $role === $sessionRole ? true : false;
    }

    public static function sessionExist(){
        
        return isset($_SESSION['user']) ? $_SESSION['auth'] : false;
    }
}

?>