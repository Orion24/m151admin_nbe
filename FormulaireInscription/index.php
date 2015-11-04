<?php
    include 'functionDb.php';
    $nom = "";
    $prenom = "";
    $description = "";
    $pseudo = "";
    $email = "";
    $dateDeNaissance = "";
    $idUser;
    
    function testArg($tab) //Check if there are empty cells
    {
        foreach($tab as $value)
        {
            if($value == $_REQUEST['description'])
            {
                if(isset($value)) {
                    continue;
                }
                else {
                    return false;
                }
            }
            if(isset($_REQUEST[$value])) {
                return false;
            }
        }
        return true;
    }
    if(isset($_REQUEST['idUser']) && is_numeric($_REQUEST['idUser']) && testArg(['', '', '', '', '','','']))
    {
        modifyUser($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['pseudo'], $_REQUEST['pass'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['date'], $_REQUEST['idUser']);
        header('Location: AffichageNom.php');
    }
    
    if(isset($_REQUEST['boutonEnvoyer']) && testArg(['', '', '', '', '','','']))
    {
        insertUser( $_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['pseudo'], $_REQUEST['pass'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['date']);
        header('Location: AffichageNom.php');
    }
    
    if(isset($_REQUEST['value']) && is_numeric($_REQUEST['value']))
    {
        $tabInfoUser = getInfoUser($_REQUEST['value']);
        $nom = $tabInfoUser['nom'];
        $prenom = $tabInfoUser['prenom'];
        $pseudo = $tabInfoUser['pseudo'];
        $description = $tabInfoUser['description'];
        $email = $tabInfoUser['email'];
        $dateDeNaissance = $tabInfoUser['dateNaissance'];
        $idUser = $_REQUEST['value'];
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
        <h1>Formulaire d'inscription</h1>
        <form method="post" action="index.php" id="formInscription">
            <label for="nom">Votre Nom</label> : <input type="text" name="nom" id="nom" maxlength="50" required value="<?= $nom ?>"/> <br />
            <label for="prenom">Votre Prenom</label> : <input type="text" name="prenom" id="nom" maxlength="30" value="<?= $prenom ?>" required /> <br />
            <label for="pseudo">Votre Pseudo</label> : <input type="text" name="pseudo" id="pseudo" maxlength="20" value="<?= $pseudo ?>" required /> <br />
            <label for="pass">Votre mot de passe :</label><input type="password" name="pass" id="pass" required /> <br />
            <label for="passconf">Confirmer mot de passe :</label><input type="password" name="passconf" id="passconf" required /> <br />
            <label for="description">Mini description :</label><textarea name="description" id="description" maxlength="100" value="<?= $description ?>" ></textarea> <br />
            <label for="email">Votre E-mail</label> : <input type="email" name="email" id="email" maxlength="200" value="<?= $email ?>" required /> <br />
            <label for="date">Votre Date de naissance</label> : <input type="date" name="date" id="date" value="<?= $dateDeNaissance ?>" required /><br />
            <input type="submit" value="Envoyer" name="boutonEnvoyer"/>
            <input type="hidden" value="<?= $idUser ?>" name="idUser"/>
            <a href="./login.php">Connexion</a>
        </form>      
    </body>
</html>