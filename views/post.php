<?= $header ?>


<?php
    if(!empty($_SESSION['user'])){
        echo "<form action='disconnect' method='post'><input type='submit' value='Disconnect'></form>";
    }
    else{
        echo "<form action='login' method='post'><input type='submit' value='Login'></form>";
    }
?>

<h1>Post<h1>

<?php
    if(empty($_SESSION['user'])){
        echo "<p> Vous devez vous connecter pour pouvoir poster une annonce. </p>";
    }
?>


<?= $footer ?>