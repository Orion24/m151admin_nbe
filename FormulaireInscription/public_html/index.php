<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include 'functionDb.php';
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
    
    function getArrayUser()
    {
        $query = 'SELECT nom, prenom FROM utilisateurs';
        $html = "";
        $html .= "<table>";
        foreach  (getDb()->query($query) as $row) 
        {
            $html .= "<tr>";
            $html .= "<td>".$row['nom']."</td>";
            $html .= "<td>".$row['prenom']."</td>";
            $html .= "</tr>";
        }
        $html .= "</table";
        return $html;
    }

    if(isset($_REQUEST['boutonEnvoyer']) && testArg(['', '', '', '', '','','']))
    {
        insertUser();
    }
?>
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
            <label for="nom">Votre Nom</label> : <input type="text" name="nom" id="nom" maxlength="50" required /> <br />
            <label for="prenom">Votre Prenom</label> : <input type="text" name="prenom" id="nom" maxlength="30" required /> <br />
            <label for="pseudo">Votre Pseudo</label> : <input type="text" name="pseudo" id="pseudo" maxlength="20" required /> <br />
            <label for="pass">Votre mot de passe :</label><input type="password" name="pass" id="pass" required /> <br />
            <label for="passconf">Confirmer mot de passe :</label><input type="password" name="passconf" id="passconf" required /> <br />
            <label for="description">Mini description :</label><textarea name="description" id="description" maxlength="100" ></textarea> <br />
            <label for="email">Votre E-mail</label> : <input type="email" name="email" id="email" maxlength="200" required /> <br />
            <label for="date">Votre Date de naissance</label> : <input type="date" name="date" id="date" required /><br />
            <input type="submit" value="Envoyer" name="boutonEnvoyer"/>
        </form>
        <?php echo getArrayUser() ?>
    </body>
</html>
