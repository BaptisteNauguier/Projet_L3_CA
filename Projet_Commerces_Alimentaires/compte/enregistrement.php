<!DOCTYPE html>

<html>

    <head>

        <title> Enregistrement </title>
        <meta charset="utf-8">

        <?php

            if (($_POST['n']=='') || ($_POST['p']=='') || ($_POST['pseudo']=='') || ($_POST['mail']=='') || ($_POST['mdp1']!=$_POST['mdp2'])) {
                echo '<meta http-equiv="refresh" content=0;URL="inscription.php?n='.$_POST['n'].'&p='.$_POST['p'].'&pseudo='.$_POST['pseudo'].'&mail='.$_POST['mail'].'&message=Les%20mot%20de%20passe%20ne%20coincident%20pas">';
            }
            else{
                enregistrer($_POST['n'], $_POST['p'], $_POST['mail'], $_POST['pseudo'], SHA1($_POST['mdp1']));
            }

        ?>

    </head>

    <body>

            <?php 
                

                function enregistrer($nom, $prenom, $mail, $pseudo, $mdp) {
                    
                    include('../bd.php');
        
                    $bdd = getBD();
					
					$verification = $bdd->query('SELECT mail FROM utilisateurs_inscrit WHERE mail = "'.$mail.'"');
					$row = $verification->rowCount();

					if($row == 1){
						 echo '<meta http-equiv="refresh" content=0;URL="inscription.php?n='.$_POST['n'].'&p='.$_POST['p'].'&pseudo='.$_POST['pseudo'].'&message=Le%20mail%20existe%20déjà">';
					}else{
						$sql = "INSERT INTO utilisateurs_inscrit(nom,prenom,mail,pseudo,mdp) VALUES (?,?,?,?,?)"; 
						$insert = $bdd->prepare($sql);
	
						$insert->execute([$nom, $prenom, $mail, $pseudo, $mdp]) or die(print_r($insert->errorInfo(), true));
						
						echo '<meta http-equiv="Refresh" content="0; URL=../session/connexion.php">';
					}

                }

            ?>
    
    </body>

</html>