<?php
      if(!isset($_SESSION['nom']) || $_SESSION['isAdmin'] != 1)
        header('Location: ./login.php');
        exit();
      }
      function addSport()
      {
         $html = '<form method="post" action="adminSportzphp" id="formInscription">';
         $html .= '<label for="nom">Nom du sport/label> : <input type="text" name="nom" id="nom" maxlength="50" required/>';
         $html .= '<input type="submit" value="Envoyer" name="boutonEnvoyerAjout"/>';
         $html .= '</form>';
         return $html;
      }

      function modifySport($sport)
      {
        $actif = getIfSportIsEnabled($sport);
        $html = '<form method="post" action="adminSport.php" id="formInscription">';
        $html .= '<label for="nom">Nom du sport/label> : <input type="text" name="nom" id="nom" maxlength="50" placeholder="'.$sport.'" required/>';
        $html .= '<select name="Actif">';
        if($actif == "1")
        {
          $html .= '<option value="1" selected>Actif</option>';
          $html .= '<option value="0">Inactif</option>';
        }
        else {
          $html .= '<option value="1">Actif</option>';
          $html .= '<option value="0" selected>Inactif</option>';
        }
        $html .= '</select>';
        $html .= '<input type="submit" value="Envoyer" name="boutonEnvoyerModifier"/>';
        $html .= '</form>';
      }
?>
<html>
    <head>
        <title>Affichage des incrits</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <script>
        </script>
    </head>
    <body>
        <?php
            switch($_REQUEST['action'])
            {
              case "a" :
                addSport();
                break;
              case "m" :
                modifySport($_REQUEST['v']);
                break;
              default :
              addSport();
              break;
            }
        ?>
        <a href="index.php">Formulaire d'inscription</a>
        <a href="AffichageNom.php?deconnect=yes">Se déconnecter</a>
    </body>
</html>
