<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link rel="stylesheet" href="../../Projet_Commerces_Alimentaires/css/CssCA.css" type="text/css"/> 
      <title>Filtre</title>
      <?php
            require('../bd.php');  #importation de la base de donnee
            $bdd = getBD();     
        ?> 
   </head>
   <body> 
  
   <nav>
           <ul>
               <li class = "menu-filtre"><a href = "html.html">Activitite</a>
                    <ul class = "submenu">
                        <li><a href="Activite.php?activite=boucherie">Boucherie</a></li>
                        <li><a href="Activite.php?activite=poissonnerie">Poissonnerie</a></li>
                        <li><a href="Activite.php?activite=boulangerie">Boulangerie</a></li>
                        <li><a href="Activite.php?activite=patisserie">Patisserie</a></li>
                        <li><a href="Activite.php?activite=charcuterie">Charcuterie</a></li>
                        <li><a href="Activite.php?activite=chocolatier">Chocolatier</a></li>
                        <li><a href="Activite.php?activite=fromagerie">Fromagerie</a></li>
                        <li><a href="Activite.php?activite=glacier">Glacier</a></li>
                        <li><a href="Activite.php?activite=restaurant">Restaurant</a></li>
                        <li><a href="Activite.php?activite=traiteur">Traiteur</a></li>
                        <li><a href="Activite.php?activite=autre">Autre</a></li>
                    </ul>
               </li>
               <li class = "menu-filtreAutre"><a href = " ">Autre Filtre</a>
                    <ul class = "submenu">
                    <li><a href="#">50 premier commerce</a></li>
                    <li><a href="#">commerce rayon de 50km</a></li>
                    </ul>
               </li>
           </ul>
       </nav>

       


















   </body>
</html>