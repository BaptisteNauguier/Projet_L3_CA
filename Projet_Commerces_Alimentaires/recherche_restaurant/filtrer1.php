<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Projet_Commerces_Alimentaires/css/style.css" type="text/css"/>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/location.js"></script>


    <title>Filtres de recherches</title>
    <script src="https://kit.fontawesome.com/8e4619d166.js" crossorigin="anonymous"></script>
    <?php
            require('../bd.php');  #importation de la base de donnee
            $bdd = getBD();     
        ?> 
</head>
<body class = "sizeNav">
   <div class = "backgroundFiltrer1"> 
    <nav>
        <div class="flexBetween"> 
            <div class = " sizeLiens flexAround">
                <div class = "sizeLien flexCentre bordureNav"><a class = "colorBleu decorationNone plusGros" href="../index.php">Page D'acceuil </a> </div>
            </div>
        </div>
    </nav>
<header> 
    <section>
        <div>
            <h1 id = "titreFiltrer" >
                Trouver votre commerce alimentaire
            </h1 >
    
            <h3 class = "h3Titre"> Rechercher par mots clefs </h3>
        </div>
        </div>
        <div class=" bordureSearch flexCentre">
            <div class="backGris flexCentre iconSize"><i class="fa-solid fa-location-pin"></i></div>
            <div>
            <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
            <input class="recherche flexCentre bordureNone paddingSearch" 
            type="search"
            name ="s"
            value=""
            placeholder="Rechercher">
            <input type ="hidden" name = "lat" class = "lat">
            <input type ="hidden" name = "lng" class = "lng">
            <input type ="hidden" name = "filtre" value= "distance">
            </div>
            <div class = "backBleu flexCentre buttonSearch" >
                <input class = "rechercherFiltrer" type= "submit" value="rechercher">
                </div>
            </form>
            </div>
            <div class = "margFiltre">
                <div class = "margFiltreTitre" >
                    <h3 class = "h3Titre">Filtres</h3>
                </div>
                <div class = "filtre flexCentre margFiltreTitre">
                <nav >
                <ul class = "listeCoteUl">
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg"></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "boucherie">
                                <input class = "boutonFiltrer" type= "submit" value="Boucherie">
                            </form>
                        </div>
                    </div>
                </li> <!-- va contenir le nom des filtres -->
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "poissonnerie">
                                <input class = "boutonFiltrer" type= "submit" value="Poissonnerie">
                            </form>
                        </div>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "boulangerie">
                                <input class = "boutonFiltrer" type= "submit" value="Boulangerie">
                            </form>
                        </div>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "patisserie">
                                <input class = "boutonFiltrer" type= "submit" value="Patisserie">
                            </form>
                        </div>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "charcuterie">
                                <input class = "boutonFiltrer" type= "submit" value="Charcuterie">
                            </form>
                        </div>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "chocolatier">
                                <input class = "boutonFiltrer" type= "submit" value="Chocolatier">
                            </form>
                        </div>
                        </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "fromagerie">
                                <input class = "boutonFiltrer" type= "submit" value="Fromagerie">
                        </form>
                        </div>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div>
                        <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "glacier">
                                <input class = "boutonFiltrer" type= "submit" value="Glacier">
                            </form>
                        </div>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div class = "centrerBouton">
                            <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "restaurant">
                                <input class = "boutonFiltrer" type= "submit" value="Restaurant">
                            </form>
                        </div>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div class = "centrerBouton">
                            <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "traiteur">
                                <input class = "boutonFiltrer" type= "submit" value="Traiteur">
                            </form>
                        </div>  
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <div class = "centrerBouton">
                            <form  method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "autre">
                                <input class = "boutonFiltrer" type= "submit" value="Autre">
                            </form>
                        </div>
                    </div>
                </li>
                </ul>
                </div>
                
                </nav>
            </div>
            <div class = "margFiltre">
                <div class = "margFiltreTitre" >
                    <h3 class = "h3Titre">Autres filtres</h3>
                </div>
                <div class = "filtre flexCentre margFiltreTitre">
                    <nav>
                    <ul class = "listeCoteUl">
                        <li class = "listeCoteNav">
                        <div class = "flexBetween filtreTexteIcons">
                            <div class = "filtreIcons">
                                <i class="fa-solid fa-shop fa-lg"></i>
                            </div>
                            <div class = "centrerBouton">
                            <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                <input type ="hidden" name = "lat" class = "lat">
                                <input type ="hidden" name = "lng" class = "lng">
                                <input type ="hidden" name = "filtre" value= "50p">
                                <input class = "boutonFiltrer" type= "submit" value="50 premier commerce">
                            </form>
                            </div>
                            
                            </div>
                        </li> <!-- va contenir le nom des filtres -->

                        <li class = "listeCoteNav">
                        <div class = "flexBetween filtreTexteIcons">
                            <div class = "filtreIcons">
                                <i class="fa-solid fa-shop fa-lg"></i>
                            </div>
                            <div class = "centrerBouton">
                                <form method= "get" action = "../trouve/search.php" autocomplete="OFF">
                                    <input type ="hidden" name = "lat" class = "lat">
                                    <input type ="hidden" name = "lng" class = "lng">
                                    <input type ="hidden" name = "filtre" value= "50km">
                                    <input class = "boutonFiltrer" type= "submit" value="commerce à un rayon de 50km">
                                </form>
                            </div>
                            </div>
                        </li> 
                        </ul>
                </div>
                
                </nav>
            </div>





        </section>

        
        
</header>
<script>
   
   $(document).ready( function() {
	    navigator.geolocation.getCurrentPosition(maPosition, erreurPosition,{maximumAge:600000,enableHighAccuracy:true});
   });
</script>
</body>
</html>