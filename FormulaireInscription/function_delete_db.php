<?php
require_once 'functionDb.php';
function deleteUser($idUser)
{
    $request = getDb()->prepare("DELETE FROM `m151admin_nbe`.`utilisateurs` WHERE `utilisateurs`.`idUtilisateur` = :idUser");
    $request->bindParam(':idUser', $idUser);
    $request->execute();
}
