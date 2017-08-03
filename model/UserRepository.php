<?php

class UserRepository{

    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }

    public function usernameAlreadyExist(User $user){

        $username = ($user->getParams())['username'];
    
        $object = $this->connexion->prepare("SELECT * FROM user WHERE username=:username");
        $object->execute(array(
            "username" => $username
            ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);

        if(empty($users)){
            return false;
        }
        else{
            return true;
        }
    }

    public function mailAlreadyExist(User $user){

        $mail = ($user->getParams())['mail'];
    
        $object = $this->connexion->prepare("SELECT * FROM user WHERE email=:mail");
        $object->execute(array(
            "mail" => $mail
            ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);

        if(empty($users)){
            return false;
        }
        else{
            return true;
        }
    }

    public function insertAll(User $user){

        $username = ($user->getParams())['username'];
        $password = ($user->getParams())['password'];
        $mail = ($user->getParams())['mail'];
    
        $object = $this->connexion->prepare("INSERT INTO user SET username=:username, email=:mail, upassword=:password");
        $object->execute(array(
            "username" => $username,
            "password" => $password,
            "mail" => $mail
            ));

        return $object->rowCount();

    }

    public function insertUsername(User $user){

        $username = ($user->getParams())['username'];
    
        $object = $this->connexion->prepare("INSERT INTO user SET username=:username");
        $object->execute(array(
            "username" => $username
            ));

        return $object->rowCount();

    }

    public function insertPassword(User $user){

        $password = ($user->getParams())['password'];
    
        $object = $this->connexion->prepare("INSERT INTO user SET uPassword=:password");
        $object->execute(array(
            "password" => $password
            ));

        return $object->rowCount();

    }

    public function insertMail(User $user){

        $mail = ($user->getParams())['mail'];
    
        $object = $this->connexion->prepare("INSERT INTO user SET email=:mail");
        $object->execute(array(
            "mail" => $mail
            ));

        return $object->rowCount();

    }

    public function checkInsert(User $user){

        $username = ($user->getParams())['username'];
        $mail = ($user->getParams())['mail'];

        $object = $this->connexion->prepare("SELECT * FROM user WHERE username=:username");
        $object->execute(array(
            "username" => $username
            ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);

        if(empty($users)){
            return false;
        }
        else{
            if($users[0]['username'] !== ($user->getParams())['username']){
                return false;
            }

            if($users[0]['uPassword'] !== ($user->getParams())['password']){
                return false;
            }

            if($users[0]['email'] !== ($user->getParams())['mail']){
                return false;
            }

            return true;
        }

    }

    public function checkUser(User $user){

        $username = ($user->getParams())['username'];
        $password = ($user->getParams())['password'];

 

        $object = $this->connexion->prepare("SELECT id, username FROM user WHERE username=:username AND uPassword=:password");
        $object->execute(array(
            "username" => $username,
            'password' => $password
            ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($users)){
            return true;
        }
        else{
            return false;
        }
    }

}

?>