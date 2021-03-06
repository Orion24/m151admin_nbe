<?php

    DEFINE('DB_HOST', "127.0.0.1");
    DEFINE('DB_NAME', "m151admin_nbe");
    DEFINE('DB_USER', "m151admin");
    DEFINE('DB_PASS', "m151admin");
    DEFINE('DB_TABLE_USER', "utilisateurs");

    function getDb() {
        static $dbb = null;

        if ($dbb === null) {
            try {
                $dbb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '', DB_USER, DB_PASS);
                $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $dbb;
    }
