<?php

DEFINE('DB_HOST', "127.0.0.1");
DEFINE('DB_NAME', "m151admin_nbe");
DEFINE('DB_USER', "m151admin");
DEFINE('DB_PASS', "m151admin");

function getDb() {
    static $dbb = null;

    if ($dbb === null) {
        try {
            $dbb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '', DB_USER, DB_PASS);
            $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $dbb;
}

function insertUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date) {
    $request = getDb()->prepare("INSERT INTO ".DB_NAME.".`utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `motDePasse`, `description`, `email`, `dateNaissance`) VALUES (NULL, :lastname, :firstname, :pseudo, SHA1(:pass), :description, :email, :date)");
    $request->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $request->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $request->bindParam(':pass', $pass, PDO::PARAM_STR);
    $request->bindParam(':description', $description, PDO::PARAM_STR);
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':date', $date, PDO::PARAM_STR);
    $request->execute();
}

function modifyUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date, $idUser) {
    $request = getDb()->prepare("UPDATE ".DB_NAME.".`utilisateurs` SET `nom` = :lastname, `prenom` = :firstname,  `pseudo` = :pseudo, `motDePasse` = SHA1(:pass), `description` = :description, `email` = :email, `dateNaissance` = :date WHERE `utilisateurs`.`idUtilisateur` = " . $idUser . ";");
    $request->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $request->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $request->bindParam(':pass', $pass, PDO::PARAM_STR);
    $request->bindParam(':description', $description, PDO::PARAM_STR);
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':date', $date, PDO::PARAM_STR);
    $request->execute();
}

function getInfoUser($idUser) {
    $query = 'SELECT nom, prenom, description, pseudo, email, dateNaissance FROM utilisateurs WHERE idUtilisateur=' . $idUser;
    $answer = getDb()->query($query); //execute the query
    return $answer->fetch(PDO::FETCH_ASSOC); //We make the answer an associotive array
}

function login($username, $pass) {
    $request = getDb()->prepare("SELECT pseudo, motDePasse, isAdmin FROM utilisateurs WHERE pseudo = :pseudo AND motDePasse = SHA1(:pass)");
    $request->bindParam(':pseudo', $username);
    $request->bindParam(':pass', $pass);
    $request->execute();
    return $request->fetch(PDO::FETCH_ASSOC);
}

function getListUsers()
    {
       $query = 'SELECT nom, prenom, pseudo, idUtilisateur FROM utilisateurs';
       $answer = getDb()->query($query); //execute the query
       return $answer->fetchAll(PDO::FETCH_ASSOC); //We make the answer an associotive array
    }
    
    function getUser()
    {
        if(isset($_REQUEST['value']) && is_numeric($_REQUEST['value'])) 
        {
            $query = 'SELECT nom, prenom, pseudo, description, email, dateNaissance FROM utilisateurs WHERE idUtilisateur='.$_REQUEST['value'];
            $answer = getDb()->query($query);//execute the query
            $tabUser = $answer->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
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
    
    function deleteUser($idUser)
    {
        $request = getDb()->prepare("DELETE FROM `m151admin_nbe`.`utilisateurs` WHERE `utilisateurs`.`idUtilisateur` = :idUser");
        $request->bindParam(':idUser', $idUser);
        $request->execute();
    }
