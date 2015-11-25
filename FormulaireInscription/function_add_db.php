<?php
require_once 'functionDb.php';
require_once 'function_read_db.php';

function insertUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date, $idClasse) {
   try{
      $request = getDb()->prepare("INSERT INTO ".DB_NAME.".".DB_TABLE_USER." (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `motDePasse`, `description`, `email`, `dateNaissance`, `idClasse`) VALUES (NULL, :lastname, :firstname, :pseudo, SHA1(:pass), :description, :email, :date, :classe)");
      $request->bindParam(':lastname', $lastname, PDO::PARAM_STR);
      $request->bindParam(':firstname', $firstname, PDO::PARAM_STR);
      $request->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
      $request->bindParam(':pass', $pass, PDO::PARAM_STR);
      $request->bindParam(':description', $description, PDO::PARAM_STR);
      $request->bindParam(':email', $email, PDO::PARAM_STR);
      $request->bindParam(':date', $date, PDO::PARAM_STR);
      $request->bindParam(':classe', $idClasse, PDO::PARAM_INT);
      return $request->execute();
  }
  catch (PDOException $e) {
      return false;
      //die($e->getMessage());
  }
}

function insertSport($idUser, $idSport, $orderchoice)
{
  try{
    $request = getDb()->prepare("INSERT INTO ".DB_NAME.".choix (`idSport`, `idEleve`, `ordrePref`) VALUES (:idSport,:idEleve, :order)");
    $request->bindParam(':idSport', $idSport, PDO::PARAM_INT);
    $request->bindParam(':idEleve', $idUser, PDO::PARAM_INT);
    $request->bindParam(':order', $orderchoice, PDO::PARAM_INT);
    return $request->execute();
  }
  catch (PDOException $e) {
      //return false;
      die($e->getMessage());
  }
}
