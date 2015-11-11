<?php

    include_once 'function_modify_db.php';
    include_once 'function_add_db.php';
    include_once 'function_read_db.php';
    $nom = isset($_REQUEST['nom']) ? $_REQUEST['nom'] : "";
    $prenom = isset($_REQUEST['prenom']) ? $_REQUEST['prenom'] : "";
    $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : "";
    $pseudo = isset($_REQUEST['pseudo']) ? $_REQUEST['pseudo'] : "";
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
    $dateDeNaissance = isset($_REQUEST['dateDeNaissance']) ? $_REQUEST['dateDeNaissance'] : "";
    $idUser;

    function testArg($tab) //Check if there are empty cells
    {
        foreach($tab as $value)
        {
            if($value == $_REQUEST['description'])
            {
                if(!isset($value)) {
                    return false;
                }
            }
            if(isset($_REQUEST[$value])) {
                return false;
            }
        }
        return true;
    }

    function getUser($idUser)
    {
        if(is_numeric($idUser))
        {
            $tabUser = getInfoUser($idUser);//We make the answer an associotive array
            $html = "";
            if($tabUser != null)//if the user exist
            {
                $html .= '<table style="border-collapse: collapse;border:1px solid black;">';
                $html .= "<th>Nom</th><th>Prenom</th><th>Pseudo</th><th>Description</th><th>Email</th><th>Date de naissance</th>";
                $html .= "<tr><td>".$tabUser['nom']."</td>";
                $html .= "<td>".$tabUser['prenom']."</td>";
                $html .= "<td>".$tabUser['pseudo']."</td>";
                $html .= "<td>".$tabUser['description']."</td>";
                $html .= "<td>".$tabUser['email']."</td>";
                $html .= "<td>".$tabUser['dateNaissance']."</td></tr></table>";
            }
            return $html;
        }
    }

    if(isset($_REQUEST['idUser']) && is_numeric($_REQUEST['idUser']) && testArg(['', '', '', '', '','','']))
    {
        modifyUser($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['pseudo'], $_REQUEST['pass'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['date'], $_REQUEST['idUser']);
        header('Location: AffichageNom.php');
    }

    if(isset($_REQUEST['boutonEnvoyer']) && testArg(['', '', '', '', '','','']))
    {
        if(insertUser( $_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['pseudo'], $_REQUEST['pass'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['date']))
        {
            header('Location: AffichageNom.php');
        }
        else {
          echo "<p>Une erreur s'est produite</p>" ;
        }
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
            <label for="description">Mini description :</label><textarea name="description" id="description" maxlength="100"><?= $description ?></textarea> <br />
            <label for="email">Votre E-mail</label> : <input type="email" name="email" id="email" maxlength="200" value="<?= $email ?>" required /> <br />
            <label for="date">Votre Date de naissance</label> : <input type="date" name="date" id="date" value="<?= $dateDeNaissance ?>" required /><br />
            <input type="submit" value="Envoyer" name="boutonEnvoyer"/>
            <input type="hidden" value="<?= $idUser ?>" name="idUser"/>
            <a href="./login.php">Connexion</a>
        </form>
    </body>
</html>
