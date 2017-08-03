<?php

require 'flight/Flight.php';
require 'Autoloader.php';

session_start();

/**
 * Alfonso: Bon t'es bien parti toi aussi. Continue
 */

Flight::render('header', array('heading' => 'Hello'), 'header');
Flight::render('footer', array('test' => 'World'), 'footer');

Flight::route('/', function(){

    if(empty($_SESSION['user'])){
        Flight::redirect('login');

    }
    else{

        Flight::redirect('accueil');
    }

});

Flight::route('/login',  function(){
    
    Flight::render('login', array(
    ));

});

Flight::route('POST /loginService', function(){

    $array = array(
        'username' => $_POST['username'],
        'password' => $_POST['password']
    );

    $bdd = new BddManager();
    $repo = $bdd->getUserRepository();
    $loginService = new User();
    $loginService->setParams($array);
    $checkUser = $loginService->checkUserLogin($bdd);

    if($checkUser == true){

        $_SESSION['user'] = $loginService;
        Flight::redirect('accueil');

    }
    else{
        Flight::redirect('login?log=failed');
    }

});

Flight::route('/register',  function(){
    
    Flight::render('register', array(
    ));

});

Flight::route('POST /RegisterService', function(){

    $array = array(
        'username' => $_POST['username'],
        'mail' => $_POST['email'],
        'password' => $_POST['password'],
        'cpassword' => $_POST['cpassword']
    );

    $bdd = new BddManager();
    $repo = $bdd->getUserRepository();
    $userRegis = new User();
    $userRegis->setParams($array);
    $registerService = new RegisterService();
    $registerService->setParams($array);
    $controls = $registerService->Controls();

    /**
     * Alfonso: utilise le getter pour avoir accès aux erreurs!
     */
    if(empty($userRegis->error) && $userRegis->usernameRegisterExist($bdd) == false && $controls == true){

        $userRegis->insertRegister($bdd);

        if(($userRegis->checkInsertRegister($bdd)) == true){

            $_SESSION['user'] = $userRegis;
            Flight::redirect('accueil');

        }
        else{

            Flight::redirect('?error=InInsert');

        }

    }
    else{

        Flight::redirect('register?signup=failed');

    }

});

Flight::route('/accueil',  function(){
    
    Flight::render('accueil', array(
    ));

});

Flight::route('/post',  function(){
    
    Flight::render('post', array(
    ));

});

Flight::route('/disconnect',  function(){
    
    $user = new Disconnect();
    $user->disconnexion();

    Flight::render('login', array(
    ));

});

Flight::start();
?>
