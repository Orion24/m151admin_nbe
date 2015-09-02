<?php
DEFINE('DB_HOST', "127.0.0.1");
DEFINE('DB_NAME', "m151admin_nbe");
DEFINE('DB_USER', "m151admin");
DEFINE('DB_PASS', "m151admin");
function getDb()
{
    static $dbb = null;
    
    if($dbb === null)
    {
        try
        {
            $dbb = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASS);
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $dbb;
}
