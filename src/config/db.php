<?php

    //$host = 'localhost';
    $host = "127.0.0.1";
    $dbname = 'zfinance';
    $user = 'root';
    $pass = '1234';

    try{
        $db = new PDO ("mysql:host=$host;port=3307;dbname=$dbname;charset=utf8" , $user , $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo("Erreur de connexion : " .$e->getMessage());
    }
