<?php

class PostService{

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

    public function checkPostForm(){

        if(
        empty($array['size']) || $array['size'] == "" || 
        empty($array['dispo']) || $array['dispo'] == "" ||
        empty($array['description']) || $array['description'] == "" ||
        empty($array['price']) || $array['price'] == "" ||
        empty($array['photo1'])
        ){
            return false;
        }
        else
        {
            return true;
        }
    }

    public function dlFiles($file){
        
        if (isset($file) && $file['error'] == 0){
            
            if ($file['size'] <= 50000000){
                
                $infosfichier = pathinfo($file['name']);

                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)){
                    
                    $newName = hash('sha1',$file['name']).'.'.$extension_upload;

                    move_uploaded_file($file['tmp_name'], '/Applications/MAMP/htdocs/www/EcoleDuNum/PHP/22_LoueMonAppart/model/uploads/' . basename($newName));
                    $url = '/Applications/MAMP/htdocs/www/EcoleDuNum/PHP/22_LoueMonAppart/model/uploads/'.basename( $newName );
                    return $url;
                }
            }
            else{
                $this->error['size'] = 'This file is too big';
            }
        }
        else{
            $this->erreur['transfert'] = $file['error'];
        }
    
    }

}

?>