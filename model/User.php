<?php

class User{

    private $username;
    private $password;
    private $mail;

    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }

    public function getMail(){
        return $this->mail;
    }

    public function __construct($donnees = array()){
       $this->hydrate($donnees);
    }

    public function hydrate($donnees){

        foreach($donnees as $key => $value){

            $key = preg_replace("#_#", "",$key);

            $method = "set".ucfirst($key);
            if(method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }
}

?>