<?php
DEFINE('DB_HOST', "127.0.0.1");
DEFINE('DB_NAME', "m151admin_nbe");
DEFINE('DB_USER', "m151admin");
DEFINE('DB_PASS', "m151admin");
function getDb()
{
    static $dbb = null;
    
    if($dbb === null)
    {
        try
        {
            $dbb = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASS);
            $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $dbb;
}
function insertUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date)
    {
        $request = getDb()->prepare("INSERT INTO `m151admin_nbe`.`utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `motDePasse`, `description`, `email`, `dateNaissance`) VALUES (NULL, :lastname, :firstname, :pseudo, SHA1(:pass), :description, :email, :date)");
        $request->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $request->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $request->bindParam(':pass', $pass, PDO::PARAM_STR);
        $request->bindParam(':description', $description, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':date', $date, PDO::PARAM_STR);
        $request->execute(); 
    }
    
function modifyUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date, $idUser)
    {
        $request = getDb()->prepare("UPDATE `m151admin_nbe`.`utilisateurs` SET `nom` = :lastname, `prenom` = :firstname,  `pseudo` = :pseudo, `motDePasse` = SHA1(:pass), `description` = :description, `email` = :email, `dateNaissance` = :date WHERE `utilisateurs`.`idUtilisateur` = ".$idUser.";");
        $request->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $request->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $request->bindParam(':pass', $pass, PDO::PARAM_STR);
        $request->bindParam(':description', $description, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':date', $date, PDO::PARAM_STR);
        $request->execute();
    }
function getInfoUser($idUser)
    {
        $query = 'SELECT nom, prenom, description, pseudo, email, dateNaissance FROM utilisateurs WHERE idUtilisateur='.$idUser;
        $answer = getDb()->query($query);//execute the query
        return $answer->fetch(PDO::FETCH_ASSOC);//We make the answer an associotive array
    }
function login($username, $pass)
    {
        $request = getDb()->prepare("SELECT pseudo, motDePasse FROM utilisateurs WHERE pseudo = :pseudo AND motDePasse = SHA1(:pass)");
        $request->bindParam(':pseudo', $username);
        $request->bindParam(':pass', $pass);
        return $request->execute();
    }