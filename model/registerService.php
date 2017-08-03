<?php

class RegisterService{

    private $params;
    private $error;
    private $user;

    public function getParams(){
        return $this->params;
    }

    public function setParams($params){
        $this->params = $params;
    }

    public function getError(){
        return $this->error;
    }

    public function setError($error){
        $this->error = $error;
    }
    
    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }

    function loadMyClass($class){
    
        if(class_exists($class)===false){
    
            $string = 'model/'.$class.'.php';

            if(file_exists($string)===true){
                require $string;
            }
        }
    }

    public function Controls(){

        $this->usernameControls();
        $this->passwordControls();
        $this->emailControls();
        

    }

    public function usernameControls(){

        if(empty($this->params['username'])){
            $this->error['username'] = 'Nom utilisateur manquant';
        }

        if(strlen($this->params['username']) < 8){
            $this->error['username'] = 'Nom utilisateur trop court';
        }

        if(strlen($this->params['username']) > 16){
            $this->error['username'] = 'Nom utilisateur trop long';
        }

        if(empty($this->error) == false){
            return false;
        }
        elseif(empty($this->error) == true){
            return true;
        }

    }

    public function passwordControls(){

        if(empty($this->params['password'])){
            $this->error['password'] = 'Mot de passe manquant';
        }

        if(strlen($this->params['password']) < 8){
            $this->error['password'] = 'Mot de passe trop court';
        }

        if(strlen($this->params['password']) > 16){
            $this->error['password'] = 'Mot de passe trop long';
        }

        if($this->params['password'] !== $this->params['cpassword']){
            $this->error['cpassword'] = 'Confirmation de mot de passe incorrect';
        }

        if(empty($this->error) == false){
            return false;
        }
        elseif(empty($this->error) == true){
            return true;
        }

    }

    public function emailControls(){

        if(empty($this->params['mail'])){
            $this->error['email'] = 'Email manquant';
        }

        if(empty($this->params['mail'])){
            $this->error['email'] = 'Email manquant';
        }

        if(!preg_match("/@.*\./", $this->params['mail'])){
            $this->error['email'] = 'Email incorrect';
        }

        if(empty($this->error) == false){
            return false;
        }
        elseif(empty($this->error) == true){
            return true;
        }

    }

    public function usernameAlreadyExist(){

        $username = $this->params['username'];

        $connexion = new PDO('mysql:host=localhost;dbname=forum;charset=UTF8','root','root');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
        $object = $connexion->prepare("SELECT user_id FROM user WHERE username=:username");
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

    public function mailAlreadyExist(){

        $mail = $this->params['mail'];

        $connexion = new PDO('mysql:host=localhost;dbname=forum;charset=UTF8','root','root');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
        $object = $connexion->prepare("SELECT user_id FROM user WHERE mail=:mail");
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

    public function insertAll(){

        $connexion = new PDO('mysql:host=localhost;dbname=forum;charset=UTF8','root','root');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
        $object = $connexion->prepare("INSERT INTO user SET username=:username, mail=:mail, upassword=:password");
        $object->execute(array(
            "username" => $this->params['username'],
            "password" => $this->params['password'],
            "mail" => $this->params['mail']
            ));

        return $object->rowCount();

    }

    public function insertUsername(){

        $connexion = new PDO('mysql:host=localhost;dbname=forum;charset=UTF8','root','root');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
        $object = $connexion->prepare("INSERT INTO user SET username=:username");
        $object->execute(array(
            "username" => $this->params['username']
            ));

        return $object->rowCount();

    }

    public function insertPassword(){

        $connexion = new PDO('mysql:host=localhost;dbname=forum;charset=UTF8','root','root');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
        $object = $connexion->prepare("INSERT INTO user SET uPassword=:password");
        $object->execute(array(
            "password" => $this->params['password']
            ));

        return $object->rowCount();

    }

    public function insertMail(){

        $connexion = new PDO('mysql:host=localhost;dbname=forum;charset=UTF8','root','root');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
        $object = $connexion->prepare("INSERT INTO user SET mail=:mail");
        $object->execute(array(
            "mail" => $this->params['mail']
            ));

        return $object->rowCount();

    }

    public function checkInsert(){

        $username = $this->params['username'];
        $mail = $this->params['mail'];

        $connexion = new PDO('mysql:host=localhost;dbname=forum;charset=UTF8','root','root');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
        $object = $connexion->prepare("SELECT * FROM user WHERE username=:username");
        $object->execute(array(
            "username" => $username
            ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);

        if(empty($users)){
            return false;
        }
        else{
            if($users[0]['username'] !== $this->params['username']){
                return false;
            }

            if($users[0]['upassword'] !== $this->params['password']){
                return false;
            }

            if($users[0]['mail'] !== $this->params['mail']){
                return false;
            }

            return true;
        }

    }


}

?>