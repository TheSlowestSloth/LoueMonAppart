<?php

class BddManager{

    private $connexion;
    private $userRepository;
    private $logementRepository;

    public function setUserRepository($userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUserRepository(){
        return $this->userRepository;
    }

    public function setLogementRepository($logementRepository){
        $this->logementRepository = $logementRepository;
    }

    public function getLogementRepository(){
        return $this->logementRepository;
    }

    public function __construct(){

        $this->connexion = Connexion::getConnexion();

        $this->setUserRepository(new UserRepository($this->connexion));
        $this->setLogementRepository(new LogementRepository($this->connexion));

    }

}

?>