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

            $_SESSION['error'] = $registerService->getError();
            Flight::redirect('register?signup=failed');

        }

    }
    else{

        $_SESSION['error'] = $registerService->getError();
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

    if(empty($_SESSION['user'])){
        Flight::redirect('login');
    }

});

Flight::route('POST /postService',  function(){
    
    $bdd = new BddManager();
    $img1 = $_FILES['uploadedfile1'];
    $img2 = $_FILES['uploadedfile2'];
    $img3 = $_FILES['uploadedfile3'];
    $postService = new PostService();
    $check = $postService->checkPostForm();

    if($check == false){
        Flight::redirect('post?form=failed');
    }

    $url1 = $postService->dlFiles($img1);
    $url2 = $postService->dlFiles($img2);
    $url3 = $postService->dlFiles($img3);
    
    $array = array(
        'username' => $_SESSION['user']->getParams()['username'],
        'type' => $_POST['type'],
        'size' => $_POST['taille'],
        'groundsize' => $_POST['taille2'],
        'dispo' => $_POST['date'],
        'description' => $_POST['description'],
        'price' => $_POST['prix'],
        'photo1' => $url1,
        'photo2' => $url2,
        'photo3' => $url3
    );

    $logement = new Logement();
    $logement->setParams($array);
    $logement->insertLocation($bdd);
    Flight::redirect('post');

});

Flight::route('/disconnect',  function(){
    
    $user = new Disconnect();
    $user->disconnexion();

    Flight::render('login', array(
    ));

});

Flight::start();
?>
