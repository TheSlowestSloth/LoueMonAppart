<?= $header ?>


<?php
    if(!empty($_SESSION['user'])){
        echo "<form action='disconnect' method='post'><input type='submit' value='Disconnect'></form>";
    }
    else{
        echo "<form action='login' method='post'><input type='submit' value='Login'></form>";
    }
?>

<h1>Accueil<h1><br>
<?php
    if(!empty($_SESSION['user'])){
        echo "<a href='post'>Post</a>";
    }
?>



<?= $footer ?>