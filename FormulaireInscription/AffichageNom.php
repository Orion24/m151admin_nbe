<?php
    session_start();
    include 'function_read_db.php';
    include 'function_modify_db.php';
    include 'function_delete_db.php';
    if(empty($_SESSION['nom']))
    {
        session_write_close(); // to be sure
        header('Location: ./login.php');
    }

    if(isset($_REQUEST['deconnect']) && $_REQUEST['deconnect'] == "yes")
    {
        session_destroy();
        session_write_close(); // to be sure
        header('Location: ./index.php');
    }

    if(isset($_REQUEST['boutonAdmin']) && is_numeric($_REQUEST['idUserPromote']))
    {
        promoteUser($_REQUEST['idUserPromote']);
    }

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
        if($isAdmin == 1)
        {
            $html .= "<th>Promotion Administrateur</th>";
        }
        foreach  (getListUsers() as $row)
        {
            $html .= "<tr>";
            $html .= "<td>".$row['nom']."</td>";
            $html .= "<td>".$row['prenom']."</td>";
            $html .= "<td><a href=\"http://127.0.0.1/siteInscription/AffichageNom.php?value=".$row['idUtilisateur']."\">détail</a></td>";
            if($isAdmin==1 || $_SESSION['nom'] == $row['pseudo'])
            {
                $html .= "<td><a href=\"http://127.0.0.1/siteInscription?value=".$row['idUtilisateur']."&nom=".$row['nom']."&prenom=".$row['prenom']."&pseudo=".$row['pseudo']."&email=".$row['email']."&description=".$row['description']."&date=".$row['dateNaissance']."\">modification</a></td>";
                $html .= "<td><a href=\"http://127.0.0.1/siteInscription/AffichageNom.php?delete=".$row['idUtilisateur']."\">suppression</a></td>";
            }
            else {
              $html .= "<td></td><td></td>";
            }
            if($isAdmin == 1 && !$row['isAdmin'])
            {
                $html .= '<td><form method="post" action="AffichageNom.php"><input type="submit" value="Promouvoir" name="boutonAdmin"/>';
                $html .= '<input type="hidden" value="'.$row['idUtilisateur'].'" name="idUserPromote"/></form></td>';
            }
            else
            {
                $html .= "<td></td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }
    function getUser($id)
    {
      $tabUser = getInfoUser($id);//We make the answer an associotive array
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
    if(isset($_REQUEST['delete']) && is_numeric($_REQUEST['delete']))
    {
        deleteUser($_REQUEST['delete']);
        session_destroy();
        session_write_close(); // to be sure
        header('Location: ./index.php');
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
        <title>Affichage des incrits</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            echo getArrayUser();
            if(isset($_REQUEST['value'])){
            echo getUser($_REQUEST['value']);}
        ?>
        <a href="index.php">Formulaire d'inscription</a>
        <a href="AffichageNom.php?deconnect=yes">Se déconnecter</a>
    </body>
</html>
