<?php

class User{

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

    public function insertRegister(BddManager $bddmanager){
        $bddmanager->getUserRepository()->insertAll($this);
    }

    public function usernameRegisterExist(BddManager $bddmanager){
        return $bddmanager->getUserRepository()->usernameAlreadyExist($this);
    }

    public function mailRegisterExist(BddManager $bddmanager){
        return $bddmanager->getUserRepository()->mailAlreadyExist($this);
    }

    public function checkInsertRegister(BddManager $bddmanager){
        return $bddmanager->getUserRepository()->checkInsert($this);
    }

    public function checkUserLogin(BddManager $bddmanager){
        return $bddmanager->getUserRepository()->checkUser($this);
    }

}

?>