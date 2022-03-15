<!DOCTYPE html>

<html>

    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <meta charset="utf-8">
        <title> Commerces Alimentaires </title> <!-- Titre de la page -->

        <?php
            include('bd.php');  #importation de la base de donnée
            $bdd = getBD();     
        ?>
    
    </head>

    <body>
        <h1>    
            Bienvenue ! 
        </h1>
        
    <table>    
        <tr>  <!-- Choix direction -->

            <td>
            <a href="trouve/index.php">Trouve ton commerce</a>
            </td>        
            <td>
            <a href="forum/index.php">Forum</a>
            </td>
            <td>
            <a href="historique/historique.php">Historique</a>
            </td> 
            <td>
            <a href="page_commerce.php">Connecte-toi</a>
            </td>

        </tr>
    </table>

        <h2>
            Les plus populaires: </br>
        </h2>

    <table>
        <tr>

        <?php          /* ligne pour site internet <a href="commerce.php?id_commerce='.$r_nom_popu['id_commerce'].'">'.$r_nom_popu['id_commerce'].'</a> </br> */

            $id = $bdd -> query('Select id_commerce FROM historique GROUP BY id_commerce ORDER BY COUNT(id_commerce) DESC LIMIT 3'); /* importation de l'id des commerces populaires */

            while ($r_id = $id -> fetch()) {

                $donnee = $bdd -> query('Select DISTINCT commerce_alimentaire.nom_etablissement, commerce_alimentaire.coordonnee, commerce_alimentaire.niveau_sanitaire, forum_ca.avis, lien_map.lien, utilisateurs_inscrit.pseudo
                                        FROM forum_ca, commerce_alimentaire, lien_map, utilisateurs_inscrit
                                        WHERE forum_ca.id_commerce=commerce_alimentaire.id_commerce
                                        AND lien_map.id_commerce=commerce_alimentaire.id_commerce
                                        AND utilisateurs_inscrit.id_UI=forum_ca.id_UI
                                        AND commerce_alimentaire.id_commerce='.$r_id['id_commerce'].''); /* importation des données */


                while ($r_donnee = $donnee -> fetch()) {

                    echo 
                    '<td>'.$r_donnee['nom_etablissement'].'</br>
                    <p> Site internet : 
                    <a href="page_commerce.php?id_commerce='.$r_id['id_commerce'].'"> lien site internet </a> </br>
                    Localisation : </br>
                    '.$r_donnee['lien'].'
                    </br>
                    Avis clients :'
                    .$r_donnee['pseudo'].' :'
                    .$r_donnee['avis'].'</br>
                    Etat sanitaire :'
                    .$r_donnee['niveau_sanitaire'].'</br> </p></td>
                    '
                    ;

                }
                $donnee -> closeCursor();

            }
            $id -> closeCursor();
        
        ?>

        </tr>
    </table>

    </body>

</html>