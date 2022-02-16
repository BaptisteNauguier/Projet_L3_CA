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
            <a href="trouve_ton_commerce.php">Trouve ton commerce</a>
            </td>        
            <td>
            <a href="forum.php">Forum</a>
            </td>
            <td>
            <a href="historique/historique.php">Historique</a>
            </td> 
            <td>
            <a href="connecte_toi.php">Connecte-toi</a>
            </td>

        </tr>
    </table>

        <h2>
            Les plus populaires: </br>
        </h2>

    <table>
        <tr>

        <?php          /* ligne pour site internet <a href="commerce.php?id_commerce='.$r_nom_popu['id_commerce'].'">'.$r_nom_popu['id_commerce'].'</a> </br> */

            $info = $bdd -> query('Select id_commerce, nom_etablissement, coordonnee, niveau_sanitaire from commerce_alimentaire limit 3'); /* requete à finir - importation des données */
            $avis = $bdd ->query('select avis from forum_ca, commerce_alimentaire where forum_ca.id_commerce=commerce_alimentaire.id_commerce limit 3');
            $r_avis = $avis -> fetch();

            while ($r_info = $info -> fetch()) {

                echo 
                '<td>'.$r_info['nom_etablissement'].'</br>
                <p> Site internet : </p> 
                <a href="commerce.php?id_commerce=1"> lien site internet </a> </br>
                <p> Localisation : </p> </br>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d184787.64737327248!2d3.841828357045498!3d43.64178090269305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b6af217be1ff51%3A0x26d70bd15039af4c!2sUniversit%C3%A9%20Paul-Val%C3%A9ry%20Montpellier%203!5e0!3m2!1sfr!2sfr!4v1644909270554!5m2!1sfr!2sfr" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe> </br>
                <p> Avis clients : </p> </br>'
                .$r_avis['avis'].'
                <p> Etat sanitaire : </p>'
                .$r_info['niveau_sanitaire'].'</br></br></td>
                '
                ;

            }

            $info -> closeCursor();
        
        ?>

        </tr>
    </table>

    </body>

</html>