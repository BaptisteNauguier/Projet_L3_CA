<!DOCTYPE html>
<html lang="fr">
   <head>
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style_trouve.css" rel="stylesheet">	
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
	<title>Trouve ton commerce</title>
      <?php
            require('../bd.php');  #importation de la base de donnee
            $bdd = getBD();     
        ?> 
   </head>
   <body>
   <div id="loadingMask">
        <canvas id="pizza"></canvas>
    </div>
   <!-- MENU -->
    <nav class="navbar">
        <ul class="navbar-ul">
            <li class="nav-item">
                <a class="nav-link" href="../">Home</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" href="index.php">Trouve ton commerce</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="../forum/index.php">Forum</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="../historique/historique.php">Historique</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="../connecte_toi.php">Connecte-toi</a>
            </li>
        </ul>
    </nav>
	<!-- FIN MENU -->
   
   <?php
   
   // --- Calcul distance entre deux coordonnees ----
   //https://numa-bord.com/miniblog/php-calcul-de-distance-entre-2-coordonnees-gps-latitude-longitude/
	class Misc {
		/**
		 * Retourne la distance en metre ou kilometre (si $unit = 'k') entre deux latitude et longitude fournit
		 */
		public static function distance($lat1, $lng1, $lat2, $lng2, $unit = 'k') {
			$earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
			$rlo1 = deg2rad($lng1);
			$rla1 = deg2rad($lat1);
			$rlo2 = deg2rad($lng2);
			$rla2 = deg2rad($lat2);
			$dlo = ($rlo2 - $rlo1) / 2;
			$dla = ($rla2 - $rla1) / 2;
			$a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
			$d = 2 * atan2(sqrt($a), sqrt(1 - $a));
			//
			$meter = ($earth_radius * $d);
			if ($unit == 'k') {
				return $meter / 1000;
			}
			return $meter;
		}
	}
	// --- FIN Calcul distance entre deux coordonnees ---
        $search = $_GET["s"];
		
        $rep = $bdd->query("SELECT DISTINCT * FROM commerce_alimentaire ca, activite ac, lieux li
						WHERE ac.id_activite = ca.id_activite 
						AND li.id_lieux = ca.id_lieux
                        AND (Activite_etablissement LIKE '%".$search."%'
						OR nom_etablissement LIKE '%".$search."%'
						OR Code_postal LIKE '%".$search."%'
						OR commune LIKE '%".$search."%')");
		$row = $rep->rowCount();
		$lat_utilisateur = $_GET['lat'];
		$lng_utilisateur = $_GET['lng'];?>
		<main>
		<div class="search-container">
			<form action="search.php" method="GET">
				<button type="submit"><i class="fa fa-search"></i></button>
				<input type="text" id="s" placeholder="Recherchez votre commerce" name="s">							
				<input type="hidden" name="lat" id="lat" /> 
				<input type="hidden" name="lng" id="lng" />
				<div id="infoposition"></div>
			</form>		
		</div>
		<?php echo "<p class='ml-4'>".$row." résultat(s) pour \"".$search."\"</p>";?>
		<div class='cards'>
        <?php while ($mat=$rep->fetch()) { #PDO::FETCH_ASSOC dans le fetch	
			$str_arr = explode (",", $mat["coordonnee"]); 
			$lat = $str_arr[0];
			$lng = $str_arr[1];
			$adresse = mb_strtolower($mat["Adresse"],"UTF-8");
		?> 		
	
		<article class="card">
			<header>
				<h2><?php echo $mat["nom_etablissement"]?></h2>
				<b><?php echo ucwords($adresse).", ".$mat["Code_postal"].", ".$mat["commune"] ?></b><br>
			</header>    
			<div class="content">
				<?php echo $mat["Activite_etablissement"] ?>
				<?php 
				$distance_utilisateur_commerce = round(Misc::distance($lat_utilisateur,$lng_utilisateur,$lat,$lng), 2);
				$temps = 340*$distance_utilisateur_commerce/60;
				echo "<div class='di-te'>";
				if($temps<60){
					echo round($temps,0)."-".round($temps+2,0). " min | ";
				}else if($temps>1440){
					$temps = $temps/60/24;
					echo round($temps,0)."-".round($temps+2,0). " jours | ";
				}else{
					$temps = $temps/60;
					echo round($temps,0)."-".round($temps+2,0). " hs | ";
				}
				echo $distance_utilisateur_commerce." km</div>"; ?>
			</div>
			<footer>
			<b>Evaluation sanitaire:</b><br>
			<span class="text-grey"><?php echo $mat["niveau_sanitaire"] ?></span>
			<div class="star text-grey">
				<i class="fa fa-star-o disp" aria-hidden="true"></i>
				<i class="fa fa-star d-none" aria-hidden="true"></i>
			</div>
			</footer>
				
		</article>
		 <?php 
        }
		echo '</div>
		</main>';
        $rep ->closeCursor();
        ?>

   </body>
   
   <script>
   
   $(document).ready( function() {
        $('main').show();
        $('#loadingMask').fadeOut(5000);
		$(".d-none").css("display", "none");
			
		$( ".star" ).hover(
			function() {
				$(this).find(".disp").css("display", "none");
				$(this).find(".d-none").css("display", "block");
			}, function() {
				$(".d-none").css("display", "none");
				$(".disp").css("display", "block");
			}
		);
    });

let toRadians = (deg) => deg * Math.PI / 180
let map = (val, a1, a2, b1, b2) => b1 + (val - a1) * (b2 - b1) / (a2 - a1)

class Pizza {
  constructor(id) {
    this.canvas = document.getElementById(id)
    this.ctx = this.canvas.getContext('2d')

    this.sliceCount = 6
    this.sliceSize = 80

    this.width = this.height = this.canvas.height = this.canvas.width = this.sliceSize * 2 + 50
    this.center = this.height / 2 | 0

    this.sliceDegree = 360 / this.sliceCount
    this.sliceRadians = toRadians(this.sliceDegree)
    this.progress = 0
    this.cooldown = 10

  }

  update() {
    let ctx = this.ctx
    ctx.clearRect(0, 0, this.width, this.height)

    if (--this.cooldown < 0) this.progress += this.sliceRadians*0.01 + this.progress * 0.07

    ctx.save()
    ctx.translate(this.center, this.center)
    
    for (let i = this.sliceCount - 1; i > 0; i--) {

      let rad
      if (i === this.sliceCount - 1) {
        let ii = this.sliceCount - 1

        rad = this.sliceRadians * i + this.progress

        ctx.strokeStyle = '#FBC02D'
        cheese(ctx, rad, .9, ii, this.sliceSize, this.sliceDegree)
        cheese(ctx, rad, .6, ii, this.sliceSize, this.sliceDegree)
        cheese(ctx, rad, .5, ii, this.sliceSize, this.sliceDegree)
        cheese(ctx, rad, .3, ii, this.sliceSize, this.sliceDegree)

      } else rad = this.sliceRadians * i
      
      // border
      ctx.beginPath()
      ctx.lineCap = 'butt'
      ctx.lineWidth = 11
      ctx.arc(0, 0, this.sliceSize, rad, rad + this.sliceRadians)
      ctx.strokeStyle = '#F57F17'
      ctx.stroke()

      // slice
      let startX = this.sliceSize * Math.cos(rad)
      let startY = this.sliceSize * Math.sin(rad)
      let endX = this.sliceSize * Math.cos(rad + this.sliceRadians)
      let endY = this.sliceSize * Math.sin(rad + this.sliceRadians)
      let varriation = [0.9,0.7,1.1,1.2]
      ctx.fillStyle = '#FBC02D'
      ctx.beginPath()
      ctx.moveTo(0, 0)
      ctx.lineTo(startX, startY)
      ctx.arc(0, 0, this.sliceSize, rad, rad + this.sliceRadians)
      ctx.lineTo(0, 0)
      ctx.closePath()
      ctx.fill()
      ctx.lineWidth = .3
      ctx.stroke()

      // meat
      let x = this.sliceSize * .65 * Math.cos(rad + this.sliceRadians / 2)
      let y = this.sliceSize * .65 * Math.sin(rad + this.sliceRadians / 2)
      ctx.beginPath()
      ctx.arc(x, y, this.sliceDegree / 6, 0, 2 * Math.PI)
      ctx.fillStyle = '#D84315'
      ctx.fill()

    }

    ctx.restore()

    if (this.progress > this.sliceRadians) {
      ctx.translate(this.center, this.center)
      ctx.rotate(-this.sliceDegree * Math.PI / 180)
      ctx.translate(-this.center, -this.center)

      this.progress = 0
      this.cooldown = 20
    }

  }

}

function cheese(ctx, rad, multi, ii, sliceSize, sliceDegree) {
  let x1 = sliceSize * multi * Math.cos(toRadians(ii * sliceDegree) - .2)
  let y1 = sliceSize * multi * Math.sin(toRadians(ii * sliceDegree) - .2)
  let x2 = sliceSize * multi * Math.cos(rad + .2)
  let y2 = sliceSize * multi * Math.sin(rad + .2)

  let csx = sliceSize * Math.cos(rad)
  let csy = sliceSize * Math.sin(rad)

  var d = Math.sqrt((x1 - csx) * (x1 - csx) + (y1 - csy) * (y1 - csy))
  ctx.beginPath()
  ctx.lineCap = 'round'

  let percentage = map(d, 15, 70, 1.2, 0.2)

  let tx = x1 + (x2 - x1) * percentage
  let ty = y1 + (y2 - y1) * percentage
  ctx.moveTo(x1, y1)
  ctx.lineTo(tx, ty)

  tx = x2 + (x1 - x2) * percentage
  ty = y2 + (y1 - y2) * percentage
  ctx.moveTo(x2, y2)
  ctx.lineTo(tx, ty)

  ctx.lineWidth = map(d, 0, 100, 20, 2)
  ctx.stroke()
}

let pizza = new Pizza('pizza')

;(function update() {
  requestAnimationFrame(update)
  pizza.update()

}())
</script>
	
</html>