<!DOCTYPE html>

<html>

    <head>
        <link rel="stylesheet" href="css/style_historique.css" type="text/css" media="screen" />
        <meta charset="utf-8">
        <title> Historique </title> <!-- Titre de la page -->
        
        <?php
            include('../bd.php');  #importation de la base de donnée
            $bdd = getBD();     
        ?>
    
    </head>

    <body>
        <h1>
            Historique des commerces visités
        </h1>

        <table border="1">    <!-- création tableau / bord du tableau à faire sur css -->
            <tr>
                <th>Id commerce</th>
                <th>Nom établissement</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Etat sanitaire</th>
                <th>Coordonnée</th>
                <th>Id lieux</th>
                <th>Id activité</th>
            </tr>

            <?php

            $hist = $bdd -> query('select commerce_alimentaire.* FROM commerce_alimentaire, historique WHERE commerce_alimentaire.id_commerce=historique.id_commerce');

            while ($r_hist = $hist -> fetch()) {

                echo  /* affichage des données sous forme de tableau*/
                '<tr>
                <td>'.$r_hist['id_commerce'].'</td>
                <td>'.$r_hist['nom_etablissement'].'</td>
                <td>'.$r_hist['Adresse'].'</td>
                <td>'.$r_hist['code_postal'].'</td>
                <td>'.$r_hist['niveau_sanitaire'].'</td>
                <td>'.$r_hist['coordonnee'].'</td>
                <td>'.$r_hist['id_lieux'].'</td>
                <td>'.$r_hist['id_activite'].'</td>
                </tr>';

            }

            $hist -> closeCursor();

            ?>

        </table>
    

    </body>

</html>