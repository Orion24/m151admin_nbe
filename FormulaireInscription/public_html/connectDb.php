<?php

function getDb()
{
    static $dbb = null;
    
    if($dbb === null)
    {
        try
        {
            $dbb = new PDO('mysql:host=127.0.0.1;dbname=m151admin_nbe', 'm151admin', 'm151admin');
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $dbb;
}
