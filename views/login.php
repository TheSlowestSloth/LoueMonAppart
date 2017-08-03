<?php
    if(!empty($_SESSION['user'])){
        header("location: index.php");
    }
?>


<?= $header ?>


<h2>Login</h2>

<form action="loginService" method="post">
    <div>
        <label>Username</label><br>
        <input type="text" name="username"/><br><br>
    </div>
    <div>
        <label>Password</label><br>
        <input type="text" name="password"/><br><br>
    </div>
    <input type="submit" value="Log in">
    <br><br>
    <div>
        <p>No account? <a href="register">Create</a> one now!<p>
        <br><br>
        <p><a href="accueil">Continue</a> without account<p>
    </div>

</form>

<?= $footer ?>
