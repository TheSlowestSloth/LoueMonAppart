<?= $header ?>


<?php
    if(!empty($_SESSION['user'])){
        echo "<form action='disconnect' method='post'><input type='submit' value='Disconnect'></form>";
    }
?>

<h1>Post<h1><br>
<a href="accueil">Accueil</a><br>

<br><hr>

<h2>Your post<h2>

<br><hr>

<h2>New post<h2><br>

<form enctype="multipart/form-data" action="postService" method="post">

    <label>Type de logement:</label><br>
    <select name="type">
        <option value="Maison">Maison</option>
        <option value="Appartement">Appartement</option>
        <option value="Villa">Villa</option>
        <option value="Terrain">Terrain</option>
        <option value="Autre">Autre</option>
    </select><br><br>

    <label>Taille du logement (m²):</label><br>
    <input type="text" name="taille"/><br><br>

    <label>Taille du terrain (m²):</label><br>
    <input type="text" name="taille2"/><br><br>

    <label>Date de disponibilité:</label><br>
    <input type="date" name="date"/><br><br>

    <label>Prix:</label><br>
    <input type="text" name="prix"/><br><br>

    <label>Description:</label><br>
    <input type="text" name="description"/><br><br>

    <label>Photos:</label><br>
    <input name="uploadedfile1" type="file"/><br>
    <input name="uploadedfile2" type="file"/><br>
    <input name="uploadedfile3" type="file"/><br><br>

    <input type="submit" value="Envoyer"/>

</form>


<?= $footer ?>