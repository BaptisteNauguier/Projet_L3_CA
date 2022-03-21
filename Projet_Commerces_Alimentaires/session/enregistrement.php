<!DOCTYPE html>

<html>

    <head>

        <title> Enregistrement </title>
        <meta charset="utf-8">

        <?php

            if (($_POST['n']=='') || ($_POST['p']=='') || ($_POST['pseudo']=='') || ($_POST['mail']=='') || ($_POST['mdp1']=='') || ($_POST['mdp1']!=$_POST['mdp2'])) {
                echo '<meta http-equiv="refresh" content=0;URL="inscription.php?n='.$_POST['n'].'&p='.$_POST['p'].'&pseudo='.$_POST['pseudo'].'&mail='.$_POST['mail'].'">';
            }
            else{
                enregistrer($_POST['n'], $_POST['p'], $_POST['pseudo'], $_POST['mail'], $_POST['mdp1']);
                echo '<meta http-equiv="refresh" content=0;URL="../index.php">';
            }

        ?>

    </head>

    <body>

            <?php

                function enregistrer($nom, $prenom, $pseudo, $mail, $mdp) {
                
                    include('../bd.php');
                            
                    $bdd = getBD();

                    $insert = $bdd->query('Insert into utilisateurs_inscrit(nom,prenom,mail,pseudo,mdp) values ("'.$nom.'","'.$prenom.'","'.$mail.'","'.$pseudo.'","'.$mdp.'")');
            
                    $insert->closecursor();

                }

            ?>
    
    </body>

</html>