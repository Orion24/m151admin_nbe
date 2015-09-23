<?php
    include 'functionDb.php';
    $nom = "";
    $prenom = "";
    $description = "";
    $pseudo = "";
    $email = "";
    $dateDeNaissance = "";
    $idUser = "Envoyer";
    
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
    
    function insertUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date)
    {
        $request = getDb()->prepare("INSERT INTO `m151admin_nbe`.`utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `motDePasse`, `description`, `email`, `dateNaissance`) VALUES (NULL, :lastname, :firstname, :pseudo, SHA1(:pass), :description, :email, :date)");
        $request->bindParam(':lastname', $lastname);
        $request->bindParam(':firstname', $firstname);
        $request->bindParam(':pseudo', $pseudo);
        $request->bindParam(':pass', $pass);
        $request->bindParam(':description', $description);
        $request->bindParam(':email', $email);
        $request->bindParam(':date', $date);
        $request->execute(); 
    }
    
    function getInfoUser($idUser)
    {
        $query = 'SELECT nom, prenom, description, pseudo, email, dateNaissance FROM utilisateurs WHERE idUtilisateur='.$idUser;
        $answer = getDb()->query($query);//execute the query
        return $answer->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }
    
    function modifyUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date, $idUser)
    {
        $request = getDb()->prepare("UPDATE `m151admin_nbe`.`utilisateurs` SET `nom` = :lastname, `prenom` = :firstname,  `pseudo` = :pseudo, `motDePasse` = SHA1(:pass), `description` = :description, `email` = :email, `dateNaissance` = :date WHERE `utilisateurs`.`idUtilisateur` = ".$idUser.";");
        $request->bindParam(':lastname', $lastname);
        $request->bindParam(':firstname', $firstname);
        $request->bindParam(':pseudo', $pseudo);
        $request->bindParam(':pass', $pass);
        $request->bindParam(':description', $description);
        $request->bindParam(':email', $email);
        $request->bindParam(':date', $date);
        $request->execute();
    }

    if(isset($_REQUEST['boutonEnvoyer']) && testArg(['', '', '', '', '','','']) && !is_numeric($_REQUEST['idUser']))
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
    
    if(isset($_REQUEST['idUser']) && is_numeric($_REQUEST['idUser']) && testArg(['', '', '', '', '','','']))
    {
        modifyUser($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['pseudo'], $_REQUEST['pass'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['date'], $_REQUEST['idUser']);
        header('Location: AffichageNom.php');
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
        </form>
        
    </body>
</html>
