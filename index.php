<?php
require 'flight/Flight.php';
include 'model/BddManager.php';
include 'model/Connexion.php';
include 'model/User.php';
include 'model/UserRepository.php';

Flight::render('header', array('heading' => 'Hello'), 'header');
Flight::render('footer', array('test' => 'World'), 'footer');

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/login',  function(){
    // Ceci est la fonction pour faire un display de 'login'. Par défaut, il va chercher dans 'views'.
    Flight::render('login', array(
    ));
});

Flight::route('POST /newProductService', function(){
    // var_dump($_POST);
    $request = Flight::request()->data['nom'];
    $description = Flight::request()->data['description'];
    $couleur = Flight::request()->data['couleur'];

    var_dump($request);
    var_dump($description);
    var_dump($couleur);
});

// Flight::route('/produit/@produit/@promotion', function($id, $name){
    // Ceci au lieu de faire des GET
//     echo $id;
//     echo $name;
// });

// On peut combiner l'url avec les regex
// Flight::route('/detail/@id:[0-9]{3}', function($id){
//    echo "il y a un détail du produit avec l'id " . $id;
// });

Flight::start();
?>
