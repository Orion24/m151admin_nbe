<?php
include 'functionDb.php';
$nom = "";
if (isset($_REQUEST['login'])) {
    
    $tablog = $_REQUEST['login'];
    $userlogin = login($_REQUEST['nom'], $_REQUEST['pass']);

    if (count($userlogin) > 0) {
        
        session_start();
        $_SESSION['user'] = $_REQUEST['nom'];
        header('Location: ./AffichageNom.php');
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Fiche inscription utilisateur</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Login</h1>
        <form method="post" action="login.php" id="formInscription">
            <label for="pseudo">Votre pseudo :</label><input type="text" name="nom" id="nom" maxlength="50" required value="<?= $nom ?>"/> <br />
            <label for="pass">Votre mot de passe :</label><input type="password" name="pass" id="pass" required /> <br />
            <input type="submit" value="Envoyer" name="login"/>
        </form>
    </body>
</html>
