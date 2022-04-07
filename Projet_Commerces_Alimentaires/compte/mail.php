<!DOCTYPE html>

<html>

    <head>

        <title> Envoie mail </title>
        <meta charset="utf-8">

        <?php

            include('../bd.php');

            if (verif($_GET['mail'])=="") {
                echo '<meta http-equiv="refresh" content=0;URL="mdp_oublie.php?q=mauvais+mail">';
            }
            else {
                email($_GET['mail']);
                echo '<meta http-equiv="refresh" content=0;URL="../index.php">';
            }

        ?>

    </head>

    <body>

            <?php 

                function verif($mail) { /* vérification de l'existance du mail */

                    $bdd = getBD();


                    $check = $bdd->query('Select id_UI FROM utilisateurs_inscrit WHERE utilisateurs_inscrit.mail="'.$mail.'"');
                    $verif=$check->fetch();
                    return($verif['id_UI']);
                
                    $check->closeCursor();
                }

                function email($mail){  /* permet l'envoie du mail */

                    $bdd = getBD(); 

                    $id = $bdd -> query('select id_UI from utilisateurs_inscrit where utilisateurs_inscrit.mail="'.$mail.'"');
                    $r = $id -> fetch();
                
                    $from = "commerces.alimentaires@hotmail.com";
                    $to = $mail;
                    $subject = "Changement mot de passe";
                    $message = "Veuillez cliquer sur le lien pour changer votre mdp : http://localhost:666/projet_commerces_alimentaires/compte/changement_mdp.php?id=".$r['id_UI']."";  /* le port est à changer suivant celui utilisé */
                    $header = "From :" . $from;
                    mail($to,$subject,$message,$header);

                    $id -> closeCursor();
                }
               
            ?>
    
    </body>

</html>