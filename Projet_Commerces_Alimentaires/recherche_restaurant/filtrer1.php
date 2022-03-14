<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Projet_Commerces_Alimentaires/css/filtrer11.css" type="text/css"/>
    <title>Filtres de recherches</title>
    <script src="https://kit.fontawesome.com/8e4619d166.js" crossorigin="anonymous"></script>
    <?php
            require('../bd.php');  #importation de la base de donnee
            $bdd = getBD();     
        ?> 
</head>
<body class = "sizeNav">
    <nav>
        <div class="flexBetween"> 
            <div class = " sizeLiens flexAround">
                <div class = "sizeLien flexCentre bordureNav"><a class = "colorBleu decorationNone" href="#">a remplir </a> </div>
                <div class = "sizeLien flexCentre bordureNav23"><a class = "colorBleu decorationNone" href="#">a remplir </a> </div>
                <div class = "sizeLien flexCentre bordureNav23"><a class = "colorBleu decorationNone" href="#">a remplir </a> </div>
            </div>
        </div>
    </nav>
<header> 
    <section>
        <div>
            <h1>
                Trouver votre commerce alimentaire
            </h1>
            <h3 class = "h3Titre"> Rechercher par mots clefs </h3>
        </div>
        <div class=" bordureSearch flexCentre">
            <div class="backGris flexCentre iconSize"><i class="fa-solid fa-location-pin"></i></div>
            <div ><input class="recherche flexCentre bordureNone paddingSearch" 
            type="search" 
            value="Marseille, France">
            </div>
            <div class = "backBleu flexCentre buttonSearch" >rechercher</div>
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
                            <a href="Activite.php?activite=boucherie">Boucherie</a>
                    </div>
                </li> <!-- va contenir le nom des filtres -->
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=poissonnerie">Poissonnerie</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=boulangerie">Boulangerie</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=patisserie">Patisserie</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=charcuterie">Charcuterie</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=chocolatier">Chocolatier</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=fromagerie">Fromagerie</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=glacier">Glacier</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=restaurant">Restaurant</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=traiteur">Traiteur</a>
                    </div>
                </li>
                <li class = "listeCoteNav">
                    <div class = "flexBetween filtreTexteIcons">
                        <div class = "filtreIcons">
                            <i class="fa-solid fa-shop fa-lg "></i>
                        </div>
                        <a href="Activite.php?activite=autre">Autre</a>
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
                                <a href="#">50 premier commerce</a>
                            </div>
                        </li> <!-- va contenir le nom des filtres -->

                        <li class = "listeCoteNav">
                        <div class = "flexBetween filtreTexteIcons">
                            <div class = "filtreIcons">
                                <i class="fa-solid fa-shop fa-lg"></i>
                            </div>
                                <a href="#">commerce rayon de 50km</a>
                            </div>
                        </li> 
                        </ul>
                </div>
                
                </nav>
            </div>





        </section>

        
        
</header>
</body>
</html>