<?php
require_once 'functionDb.php';
function modifyUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date, $idUser) {
  try{
    $request = getDb()->prepare("UPDATE ".DB_NAME.".".DB_TABLE_USER." SET `nom` = :lastname, `prenom` = :firstname,  `pseudo` = :pseudo, `motDePasse` = SHA1(:pass), `description` = :description, `email` = :email, `dateNaissance` = :date WHERE `utilisateurs`.`idUtilisateur` = " . $idUser . ";");
    $request->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $request->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $request->bindParam(':pass', $pass, PDO::PARAM_STR);
    $request->bindParam(':description', $description, PDO::PARAM_STR);
    $request->bindParam(':email', $email, PDO::PARAM_STR);
    $request->bindParam(':date', $date, PDO::PARAM_STR);
    return $request->execute();
  }
  catch (PDOException $e) {
      echo('Erreur : ' . $e->getMessage());
  }
}

function promoteUser($idUser)
{
    $request = getDb()->prepare("UPDATE ".DB_NAME.".".DB_TABLE_USER." SET `isAdmin` = '1' WHERE `utilisateurs`.`idUtilisateur` = :idUser;");
    $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $request->execute();
}
