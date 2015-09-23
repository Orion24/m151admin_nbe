<?php
    include 'functionDb.php';
    $nom = "";
    $prenom = "";
    $description = "";
    $pseudo = "";
    $email = "";
    $dateDeNaissance = "";
    $modification = false;
    
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
    
    function insertUser()
    {
        $request = getDb()->prepare("INSERT INTO `m151admin_nbe`.`utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `motDePasse`, `description`, `email`, `dateNaissance`) VALUES (NULL, :lastname, :firstname, :pseudo, SHA1(:pass), :description, :email, :date)");
        $request->bindParam(':lastname', $_REQUEST['nom']);
        $request->bindParam(':firstname', $_REQUEST['prenom']);
        $request->bindParam(':pseudo', $_REQUEST['pseudo']);
        $request->bindParam(':pass', $_REQUEST['pass']);
        $request->bindParam(':description', $_REQUEST['description']);
        $request->bindParam(':email', $_REQUEST['email']);
        $request->bindParam(':date', $_REQUEST['date']);
        $request->execute(); 
    }
    

    if(isset($_REQUEST['boutonEnvoyer']) && testArg(['', '', '', '', '','','']))
    {
        insertUser();
        header('Location: AffichageNom.php');
    }
    
    function getInfoUser($idUser)
    {
        $query = 'SELECT nom, prenom, description, pseudo, email, dateNaissance FROM utilisateurs WHERE idUtilisateur='.$idUser;
        $answer = getDb()->query($query);//execute the query
        return $answer->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }
    
    if(isset($_REQUEST['value']) && is_numeric($_REQUEST['value']))
    {
        $modification = true;
        $tabInfoUser = getInfoUser($_REQUEST['value']);
        $nom = $tabInfoUser['nom'];
        $prenom = $tabInfoUser['prenom'];
        $pseudo = $tabInfoUser['pseudo'];
        $description = $tabInfoUser['description'];
        $email = $tabInfoUser['email'];
        $dateDeNaissance = $tabInfoUser['dateNaissance'];
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
        </form>
        
    </body>
</html>
