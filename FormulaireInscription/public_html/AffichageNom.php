<?php
    session_start();
    if(empty($_SESSION['nom']))
    {
        session_write_close(); // to be sure
        header('Location: ./login.php');
    }
    
    if(isset($_REQUEST['deconnect']) && $_REQUEST['deconnect'] == "yes")
    {
        session_destroy();
        header('Location: ./index.php');
    }
    
    include 'functionDb.php';
    function getArrayUser()
    {       
        $isAdmin = $_SESSION['isAdmin'];
        $html = "";
        $html .= '<table style="border-collapse: collapse;border:1px solid black;">';
        $html .= "<th>Nom</th>";
        $html .= "<th>Prenom</th>";
        $html .= "<th>Détail</th>";
        $html .= "<th>Modification</th>";
        $html .= "<th>Suppresion</th>";
        foreach  (getListUsers() as $row) 
        {
            $html .= "<tr>";               
            $html .= "<td>".$row['nom']."</td>";
            $html .= "<td>".$row['prenom']."</td>";
            $html .= "<td><a href=\"http://127.0.0.1/siteInscription/AffichageNom.php?value=".$row['idUtilisateur']."\">détail</a>";
            if($isAdmin==1 || $_SESSION['nom'] == $row['pseudo'])
            {
                $html .= "<td><a href=\"http://127.0.0.1/siteInscription?value=".$row['idUtilisateur']."\">modification</a>";
                $html .= "<td><a href=\"http://127.0.0.1/siteInscription/AffichageNom.php?delete=".$row['idUtilisateur']."\">suppression</a>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }

    if(isset($_REQUEST['delete']) && is_numeric($_REQUEST['delete']))
    {
        deleteUser($_REQUEST['delete']);
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Affichage des incrit</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php 
            echo getArrayUser();
            echo getUser();
        ?>
        <a href="index.php">Formulaire d'inscription</a>
        <a href="AffichageNom.php?deconnect=yes">Se déconnecter</a>
    </body>
</html>
