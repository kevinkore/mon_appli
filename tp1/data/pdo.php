<?php

class pdoConnect
{

    public function __construct($host,$base,$user,$pass) {
        $this->host = $host;
        $this->base = $base;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function connex()
    {
        try {
            $this->connex= new PDO("mysql:host={$this->host};dbname={$this->base}" ,$this->user,$this->pass);
            $this->connex->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $this->connex;
    }

    
}