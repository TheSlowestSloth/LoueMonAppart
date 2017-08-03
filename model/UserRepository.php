<?php

class UserRepository{

    private $connexion;

    public function __construct($connexion){

        $this->connexion = $connexion;

    }
}

?>