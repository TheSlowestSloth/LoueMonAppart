<?php

class Logement{

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

    public function insertLocation(BddManager $bddmanager){
        $bddmanager->getLogementRepository()->insertLogement($this);
    }

}

?>