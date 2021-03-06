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
    throw $e;
  }
}

function insertSport($idUser, $idSport)
{
  try{
    getDb()->beginTransaction();
    for ($i=0; $i < 4 ; $i++) {
      if(count(getIdSportByUserAndIdSport($idUser, $idSport[$i])) == 0)
      {
        $order = $i + 1;
        $request = getDb()->prepare("INSERT INTO ".DB_NAME.".choix (`idSport`, `idEleve`, `ordrePref`) VALUES (:idSport,:idEleve, :order)");
        $request->bindParam(':idSport', $idSport[$i], PDO::PARAM_INT);
        $request->bindParam(':idEleve', $idUser, PDO::PARAM_INT);
        $request->bindParam(':order', $order, PDO::PARAM_INT);
        $request->execute();
      }
      else {
        throw new Exception("Choix deja pris par l'utilisateur");
        break;
      }
    }
    getDb()->commit();
  }
  catch (PDOException $e) {
      getDb()->rollback();
      throw $e;
  }
}
