<!DOCTYPE html>
<html >
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link rel="stylesheet" href="../../Projet_Commerces_Alimentaires/css/cssListee.css" type="text/css"/> 
      <title>Activite</title>
      <?php
            require('../bd.php');  #importation de la base de donnee
            $bdd = getBD();     
        ?> 
   </head>
   <body >
   <footer><p> <a href="filtrer1.php">filtre</a> </p></footer>
  
       
       <?php echo "<h2> Liste des activités ".$_GET['activite']."</h2></br>";
       $activite = $_GET["activite"]; 
       if($_GET["activite"] == "autre"){
           $rep = $bdd->query("SELECT DISTINCT count(commerce_alimentaire.nom_etablissement)
       from commerce_alimentaire, activite
       where commerce_alimentaire.id_activite not in (SELECT activite.id_activite from activite where activite.Activite_etablissement LIKE '%boucherie%' 
       or activite.Activite_etablissement LIKE '%poissonnerie%' or activite.Activite_etablissement LIKE '%boulangerie%' or activite.Activite_etablissement LIKE '%patisserie%'
       or activite.Activite_etablissement LIKE '%charcuterie%' or activite.Activite_etablissement LIKE '%chocolatier%' or activite.Activite_etablissement LIKE '%fromagerie%'
       or activite.Activite_etablissement LIKE '%glacier%' or activite.Activite_etablissement LIKE '%restaurant%' or activite.Activite_etablissement LIKE '%traiteur%')
       ORDER BY commerce_alimentaire.id_commerce");
        }
        else {
           $rep = $bdd->query("SELECT DISTINCT count(commerce_alimentaire.nom_etablissement)
           from commerce_alimentaire, activite
           where commerce_alimentaire.id_activite in (SELECT activite.id_activite from activite where activite.Activite_etablissement LIKE '%".$activite."%')
           ORDER BY commerce_alimentaire.id_commerce");

        }
       
       ?>
        
        
       <ul>
   <?php
        $activite = $_GET["activite"]; 
        if($_GET["activite"] == "autre"){
            $rep = $bdd->query("SELECT DISTINCT commerce_alimentaire.nom_etablissement, commerce_alimentaire.niveau_sanitaire , commerce_alimentaire.Adresse,commerce_alimentaire.id_commerce
        from commerce_alimentaire, activite
        where commerce_alimentaire.id_activite not in (SELECT activite.id_activite from activite where activite.Activite_etablissement LIKE '%boucherie%' 
        or activite.Activite_etablissement LIKE '%poissonnerie%' or activite.Activite_etablissement LIKE '%boulangerie%' or activite.Activite_etablissement LIKE '%patisserie%'
        or activite.Activite_etablissement LIKE '%charcuterie%' or activite.Activite_etablissement LIKE '%chocolatier%' or activite.Activite_etablissement LIKE '%fromagerie%'
        or activite.Activite_etablissement LIKE '%glacier%' or activite.Activite_etablissement LIKE '%restaurant%' or activite.Activite_etablissement LIKE '%traiteur%')
        ORDER BY commerce_alimentaire.id_commerce");
         }
         else {
            $rep = $bdd->query("SELECT DISTINCT commerce_alimentaire.nom_etablissement, commerce_alimentaire.niveau_sanitaire , commerce_alimentaire.Adresse,commerce_alimentaire.id_commerce
            from commerce_alimentaire, activite
            where commerce_alimentaire.id_activite in (SELECT activite.id_activite from activite where activite.Activite_etablissement LIKE '%".$activite."%')
            ORDER BY commerce_alimentaire.id_commerce");

         }

        while ($mat=$rep->fetch()) { #PDO::FETCH_ASSOC dans le fetch

            echo "<li id = listeActivite >".$mat["nom_etablissement"]."</li></br>"; # on peut rajouter ."</br>"
        }

        $rep ->closeCursor();
        ?>
</ul>





   </body>
</html>