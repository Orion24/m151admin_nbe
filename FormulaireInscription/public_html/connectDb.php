<?php
try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=m151admin_nbe', 'm151admin', 'm151admin');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}