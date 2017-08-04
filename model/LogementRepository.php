<?php

class LogementRepository{

    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }

    public function insertLogement(Logement $logement){

        $array = ($logement->getParams());
    
        $object = $this->connexion->prepare("INSERT INTO logement SET
            username=:username,
            type=:type, 
            size=:size, 
            groundsize=:groundsize,
            dispo=:dispo,
            description=:description,
            price=:price,
            photo1=:photo1,
            photo2=:photo2,
            photo3=:photo3
            ");
        $object->execute(array(
            "username" => $array['username'],
            "type" => $array['type'],
            "size" => $array['size'],
            "groundsize" => $array['groundsize'],
            "dispo" => $array['dispo'],
            "description" => $array['description'],
            "price" => $array['price'],
            "photo1" => $array['photo1'],
            "photo2" => $array['photo2'],
            "photo3" => $array['photo3']
            ));

        return $object->rowCount();

    }

}