<?= $header ?>


<h2>SignUp</h2>


<form action="RegisterService" method="post">
    <?php
    if(!empty($_GET['signup'])){
        echo "<span style='color: red'>".$_SESSION['error']['username']."</span><br>";
    }
    ?>
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>
    <?php
    if(!empty($_GET['signup'])){
        echo "<span style='color: red'>".$_SESSION['error']['email']."</span><br>";
    }
    ?>
    <label>Email:</label><br>
    <input type="text" name="email"><br><br>
    <?php
    if(!empty($_GET['signup'])){
        echo "<span style='color: red'>".$_SESSION['error']['password']."</span><br>";
    }
    ?>
    <label>Password:</label><br>
    <input type="text" name="password"><br><br>
    <?php
    if(!empty($_GET['signup'])){
        echo "<span style='color: red'>".$_SESSION['error']['cpassword']."</span><br>";
    }
    ?>
    <label>Confirm Password:</label><br>
    <input type="text" name="cpassword"><br><br>
    <input type="submit" value="SignUp">
</form>
<div>
    <p>Already an account? <a href="login">Connect</a> now!<p>
    <p><a href="accueil">Continue</a> without account<p>
</div>


<?= $footer ?>