<!DOCTYPE html>

<html>

    <head>	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/style.css" rel="stylesheet">
		<title>Se connecter</title>
        <meta charset="utf-8">

        <?php 

            include('../bd.php');
            $bdd = getBD();
			
			$mail = trim($_POST['mail']);
			$mdp = SHA1(trim($_POST['mdp']));
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];
			
            if ($mail!="" && $mdp!="") {
				
				$sql = "SELECT * FROM utilisateurs_inscrit WHERE mail = ? AND mdp = ?"; 
				$stmt = $bdd->prepare($sql);
				$stmt->execute([$mail, $mdp]) or die(print_r($stmt->errorInfo(), true));
				
				$c_info = $stmt->fetch();
				$count = $stmt->rowCount();
				
				if($count == 1){
					session_start();

					$_SESSION['utilisateur'] = array();
					$_SESSION['utilisateur']['mail'] = $c_info['mail'];
					$_SESSION['utilisateur']['id'] = $c_info['id_UI'];
					$_SESSION['utilisateur']['nom'] = $c_info['nom'];
					$_SESSION['utilisateur']['prenom'] = $c_info['prenom'];
					$_SESSION['utilisateur']['pseudo'] = $c_info['pseudo'];
					$_SESSION['utilisateur']['mdp'] = $c_info['mdp'];
					$_SESSION['utilisateur']['lat'] = $lat;
					$_SESSION['utilisateur']['lng'] = $lng;
					
					echo '<meta http-equiv="Refresh" content="0; URL=../trouve/index.php">';
				}else{
					$message = "Le%20mail%20ou%20le%20mot%20de%20passe%20est%20incorrect.";
					echo "<meta http-equiv='refresh' content=0;URL='connexion.php?message={$message}'>";
				}
            }
            else {    
                echo '<meta http-equiv="refresh" content=0;URL="connexion.php">';
            }

        ?>

    </head>
	
<body>
    <!-- MENU -->
		<nav class="navbar">
			<ul class="navbar-ul">
				<li class="nav-item">
					<a class="nav-link" href="../">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../trouve/index.php">Trouve ton commerce</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Forum</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../historique/historique.php">Historique</a>
				</li>
				<?php if(isset($_SESSION['utilisateur'])) { ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropbtn" href="#">Bienvenue <?php echo $_SESSION['utilisateur']['pseudo'] ?> ▼</a>
					<div class="dropdown-content">
							<a href='../session/deconnexion.php'>Se deconnecter</a>
					</div>
				</li>
				<?php }else{ ?>
				<li class="nav-item">
					<a class="nav-link active" href="#">Connecte-toi</a>
				</li>
				<?php } ?>
			</ul>
		</nav>
		<!-- FIN MENU -->
	
	<main>
		<h2>Se connecter</h2>
	</main>
</body>
</html>