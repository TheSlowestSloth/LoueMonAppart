<?php

class BddManager{

    private $connexion;
    private $userRepository;

    public function setUserRepository($userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUserRepository(){
        return $this->userRepository;
    }

    public function __construct(){

        $this->connexion = Connexion::getConnexion();

        $this->setUserRepository(new UserRepository($this->connexion));

    }

}

?>