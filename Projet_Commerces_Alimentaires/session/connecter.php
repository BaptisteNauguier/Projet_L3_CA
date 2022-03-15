<!DOCTYPE html>

<html>

    <head>

        <title> Connecter </title>
        <meta charset="utf-8">

        <?php 

            include('../bd.php');
            $bdd = getBD();

            $info = $bdd->query('Select * from utilisateurs_inscrit where mail ="'.$_POST['mail'].'"');
            $c_info = $info->fetch(); 
            
            if ($c_info['nom']=="") {

                echo '<meta http-equiv="refresh" content=0;URL="connexion.php">';

            }
            else {
                session_start();

                $_SESSION['utilisateur'] = array();
                $_SESSION['utilisateur']['mail'] = $c_info['mail'];
                $_SESSION['utilisateur']['id'] = $c_info['id_UI'];
                $_SESSION['utilisateur']['nom'] = $c_info['nom'];
                $_SESSION['utilisateur']['prenom'] = $c_info['prenom'];
                $_SESSION['utilisateur']['mdp'] = $c_info['mdp'];

                

                echo '<meta http-equiv="refresh" content=0;URL="../index.php">';

            }

            $info->closecursor();
        ?>

    </head>

    <body>
        

    </body>

</html>