<?php
require_once 'functionDb.php';
function deleteUser($idUser)
{
    $request = getDb()->prepare("DELETE FROM ".DB_NAME.".".DB_TABLE_USER." WHERE `utilisateurs`.`idUtilisateur` = :idUser");
    $request->bindParam(':idUser', $idUser);
    $request->execute();
}
