<?php
require_once 'functionDb.php';
function insertUser($lastname, $firstname, $pseudo, $pass, $description, $email, $date) {
   try{
      $request = getDb()->prepare("INSERT INTO ".DB_NAME.".".DB_TABLE_USER." (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `motDePasse`, `description`, `email`, `dateNaissance`) VALUES (NULL, :lastname, :firstname, :pseudo, SHA1(:pass), :description, :email, :date)");
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
      return false;
  }
}
