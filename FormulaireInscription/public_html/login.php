<?php
    include 'functionDb.php';
    if(isset($_REQUEST['login']))
    {
        $tablog = $_REQUEST['login'];
        if(login($tablog['pseudo'], $tablog['pass']))
        {
            session_start();
            if (!isset($_SESSION['user']))
            {
                $_SESSION['user'] = $tablog['pseudo'];
                header('Location: ./AfichageNom.php');
            } 
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
