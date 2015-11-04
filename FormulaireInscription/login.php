<?php
    include 'function_read_db.php';
    $nom = "";
    session_start();

    if(isset($_SESSION['nom']))
    {
        header('Location: ./AffichageNom.php');
    }

    if (isset($_REQUEST['login'])) {

        $tablog = $_REQUEST['login'];
        $userlogin = login($_REQUEST['nom'], $_REQUEST['pass']);
        $nom = $_REQUEST['nom'];
        if (count($userlogin) > 0) {
            $_SESSION['nom'] = $userlogin['pseudo'];
            $_SESSION['isAdmin'] = $userlogin['isAdmin'];
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
