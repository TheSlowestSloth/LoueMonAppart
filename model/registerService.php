<?php

class RegisterService{

    private $params;
    private $error;

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

    public function Controls(){

        $this->setError(array(
            'username' => '',
            'email' => '',
            'password' => '',
            'cpassword' => ''
        ));

        /* J'utilise le $flag plutôt que des return pour obliger
        le programme à lire tout les if (plutôt que de l'arrêter 
        au premier) et ainsi obtenir toute les erreurs */

        $flag = true;

        if($this->usernameControls() == false){
            $flag = false;
        }
        if($this->passwordControls() == false){
            $flag = false;
        }
        if($this->emailControls() == false){
            $flag = false;
        }
        if($flag == true){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function usernameControls(){

        if(empty($this->params['username'])){
            $this->error['username'] = 'Nom utilisateur manquant';
        }

        if(strlen($this->params['username']) < 6){
            $this->error['username'] = 'Nom utilisateur trop court';
        }

        if(strlen($this->params['username']) > 16){
            $this->error['username'] = 'Nom utilisateur trop long';
        }

        if(empty($this->error['username']) == false){
            return false;
        }
        elseif(empty($this->error['username']) == true){
            return true;
        }

    }

    public function passwordControls(){

        if(empty($this->params['password'])){
            $this->error['password'] = 'Mot de passe manquant';
        }

        if(strlen($this->params['password']) < 6){
            $this->error['password'] = 'Mot de passe trop court';
        }

        if(strlen($this->params['password']) > 16){
            $this->error['password'] = 'Mot de passe trop long';
        }

        if($this->params['password'] !== $this->params['cpassword']){
            $this->error['cpassword'] = 'Confirmation de mot de passe incorrect';
        }

        if(empty($this->error['password']) == false){
            return false;
        }
        elseif(empty($this->error['password']) == true){
            return true;
        }

    }

    public function emailControls(){

        if(empty($this->params['mail'])){
            $error['email'] = 'Email manquant';
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

}

?>