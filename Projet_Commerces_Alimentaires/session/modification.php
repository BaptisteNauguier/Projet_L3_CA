<!DOCTYPE html>

<html>

    <head>

        <title> Enregistrement </title>
        <meta charset="utf-8">

        <?php
			session_start();
			$mdp_ancien =trim($_POST['mdp1']);
			$mdp_nouveau =trim($_POST['mdp2']);
			$pseudo = trim($_POST['pseudo']);

            if ($mdp_ancien != "" && $mdp_nouveau != "") {
				if($mdp_ancien == $mdp_nouveau ){
					echo '<meta http-equiv="refresh" content=0;URL="profil.php?message=Le%20nouveau%20mdp%20doit%20être%20different">';
				}else{	
					if($pseudo != ""){
						enregistrer($_SESSION['utilisateur']['id'], $pseudo, SHA1($mdp_ancien), SHA1($mdp_nouveau));
					}else echo '<meta http-equiv="refresh" content=0;URL="profil.php?message=Le%20psedo%20ne%20peut%20pas%20être%20vide">';
				}
				
            }else if($mdp_ancien == "" && $mdp_nouveau == "" && $pseudo != ""){
					enregistrer_pseudo($_SESSION['utilisateur']['id'], $pseudo);
				}
            else{
                echo '<meta http-equiv="refresh" content=0;URL="profil.php?message=Le%20mot%20de%20passe%20doit%20avoir%20au%20moins%20un%20caractère">';
            }

        ?>

    </head>

    <body>

            <?php 
                

                function enregistrer($id, $pseudo, $mdp_ancien, $mdp) {
                    
                    include('../bd.php');
        
                    $bdd = getBD();
					
					$verif = $bdd->query("SELECT * FROM utilisateurs_inscrit WHERE id_UI = {$id}");
					$row_verif = $verif->fetch();
					if($row_verif['mdp'] == $mdp_ancien){
						$sql = "UPDATE utilisateurs_inscrit SET pseudo = ?, mdp = ? WHERE id_UI = {$id}"; 
						$insert = $bdd->prepare($sql);
		
						$insert->execute([$pseudo, $mdp]) or die(print_r($insert->errorInfo(), true));
							
						$message = "Le profil a été modifié";
							
						echo '<meta http-equiv="Refresh" content="0; URL=profil.php?verification='.$message.'">';
					}else{
						$message = "Le mot de passe n'est pas correcte";
							
						echo '<meta http-equiv="Refresh" content="0; URL=profil.php?message='.$message.'">';
					}
					
		
					
				}
				
				
				
				function enregistrer_pseudo($id, $pseudo) {
                    
                    include('../bd.php');
        
                    $bdd = getBD();					
		
					$sql = "UPDATE utilisateurs_inscrit SET pseudo = ? WHERE id_UI = {$id}"; 
					$insert = $bdd->prepare($sql);
	
					$insert->execute([$pseudo]) or die(print_r($insert->errorInfo(), true));
						
					$message = "Le profil a été modifié";
						
					echo '<meta http-equiv="Refresh" content="0; URL=profil.php?verification='.$message.'">';
				}


            ?>
    
    </body>

</html>