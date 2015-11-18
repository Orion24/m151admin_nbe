<?php
require_once 'functionDb.php';
function getInfoUser($idUser) {
    $query = 'SELECT nom, prenom, description, pseudo, email, dateNaissance FROM '.DB_TABLE_USER.' WHERE idUtilisateur=' . $idUser;
    $answer = getDb()->query($query); //execute the query
    return $answer->fetch(PDO::FETCH_ASSOC); //We make the answer an associotive array
}

function login($username, $pass) {
    $request = getDb()->prepare("SELECT pseudo, motDePasse, isAdmin, idUtilisateur FROM ".DB_TABLE_USER." WHERE pseudo = :pseudo AND motDePasse = SHA1(:pass)");
    $request->bindParam(':pseudo', $username);
    $request->bindParam(':pass', $pass);
    $request->execute();
    return $request->fetch(PDO::FETCH_ASSOC);
}

function getListUsers()
    {
       $query = 'SELECT * FROM '.DB_TABLE_USER;
       $answer = getDb()->query($query); //execute the query
       return $answer->fetchAll(PDO::FETCH_ASSOC); //We make the answer an associotive array
    }

function getClass()
{
  $query = 'SELECT * FROM classes';
  $answer = getDb()->query($query); //execute the query
  return $answer->fetchAll(PDO::FETCH_ASSOC); //We make the answer an associotive array
}
