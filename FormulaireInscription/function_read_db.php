<?php
require_once 'functionDb.php';
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
       $query = 'SELECT nom, prenom, pseudo, idUtilisateur, isAdmin FROM utilisateurs';
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
