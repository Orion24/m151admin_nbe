<?php
    include 'functionDb.php';
    function getArrayUser()
        {
            $query = 'SELECT nom, prenom FROM utilisateurs';
            $html = "";
            $html .= '<table border="1px solid black">';
            $html .= "<th>Nom</th>";
            $html .= "<th>Prenom</th>";
            foreach  (getDb()->query($query) as $row) 
            {
                $html .= "<tr>";               
                $html .= "<td>".$row['nom']."</td>";
                $html .= "<td>".$row['prenom']."</td>";
                $html .= "</tr>";
            }
            $html .= "</table";
            return $html;
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
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php echo getArrayUser() ?>
    </body>
</html>
