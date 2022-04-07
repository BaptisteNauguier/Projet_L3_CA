<!DOCTYPE html>

<html>

    <head>

        <title> Changement Mdp</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">

        <?php
			session_start();
			$mdp_1 =trim($_POST['mdp1']);  /* trim supprime espace ou autre caractères */
			$mdp_2 =trim($_POST['mdp2']);

            if ($mdp_1 != "" && $mdp_2 != "") {
				if($mdp_1 != $mdp_2 ){
					echo '<meta http-equiv="refresh" content=0;URL="changement_mdp.php?message=Les%20mots%20de%20passe%20doivent%20être%20identique&id='.$_POST['hidden-id'].'">';
				}else{	
					enregistrer($_POST['hidden-id'], SHA1($mdp_1));
				}				
            }else {
                echo '<meta http-equiv="refresh" content=0;URL="changement_mdp.php?message=Le%20mot%20de%20passe%20doit%20avoir%20au%20moins%20un%20caractère&id='.$_POST['hidden-id'].'">';
            }

        ?>

    </head>

    <body>

            <?php 
                

                function enregistrer($id, $mdp) {  /* mise à jour du mdp */
                    
                    include('../bd.php');
        
                    $bdd = getBD();
				
					$insert = $bdd->query("Update utilisateurs_inscrit SET  mdp = '".$mdp."' WHERE id_UI = ".$id."")  or die(print_r($insert->errorInfo(), true)); 
						
					$message = "Le mot de passe a été modifié";
						
					echo '<meta http-equiv="Refresh" content="0; URL=changement_mdp.php?verification='.$message.'">';
						
				}

            ?>
    
    </body>

</html>