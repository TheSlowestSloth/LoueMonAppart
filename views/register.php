<?= $header ?>


<h2>SignUp</h2>

<form action="RegisterService" method="post">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>
    <label>Email:</label><br>
    <input type="text" name="email"><br><br>
    <label>Password:</label><br>
    <input type="text" name="password"><br><br>
    <label>Confirm Password:</label><br>
    <input type="text" name="cpassword"><br><br>
    <input type="submit" value="SignUp">
</form>
<div>
    <p>Already an account? <a href="login">Connect</a> now!<p>
    <p><a href="accueil">Continue</a> without account<p>
</div>


<?= $footer ?>