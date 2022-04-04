<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->	

        <title> Commerces Alimentaires </title> <!-- Titre de la page -->

        <?php
        	session_start();

            include('bd.php');  #importation de la base de donnée
            $bdd = getBD();     
        ?>
    
    </head>

    <body>
        <header class="head-index">
        <h1 id="t-index">    
            Bienvenue ! 
        </h1>
        
        <!-- MENU -->
        <nav class="navbar row">
                <div class="col-1">
                    <ul class="navbar-ul">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="fa fa-home"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-2 text-center">
                    <ul class="navbar-ul">
                        <li class="nav-item">
                            <a class="nav-link active" href="trouve/index.php">Trouve ton commerce</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="forum/index.php">Forum</a>
                        </li>
                        <?php if(isset($_SESSION['utilisateur'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="historique/historique.php">Historique</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="historique/historique.php">Favori</a>
                        </li>
                        <?php  } ?>
                    </ul>
                </div>
                <div class="col-3">
                    <ul class="navbar-ul menu-right">
                    <?php if(isset($_SESSION['utilisateur'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropbtn" href="#">Bienvenue <?php echo $_SESSION['utilisateur']['pseudo'] ?> ▼</a>
                            <div class="dropdown-content">
                                    <a href='session/deconnexion.php'>Se deconnecter</a>
                            </div>
                        </li>
                        <?php }else{ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="session/connexion.php">Se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="compte/inscription.php">S'inscrire</a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
        </nav>
        <!-- FIN MENU -->
        </header>                    
        <h2 id="t2-index">
            Les plus populaires:
        </h2>

        <section class="main-index">
                <?php

                    $id = $bdd -> query('Select id_commerce FROM historique GROUP BY id_commerce ORDER BY COUNT(id_commerce) DESC LIMIT 3'); /* importation de l'id des commerces populaires */

                    while ($r_id = $id -> fetch()) {

                        $donnee = $bdd -> query('Select DISTINCT commerce_alimentaire.nom_etablissement, commerce_alimentaire.coordonnee, commerce_alimentaire.niveau_sanitaire, forum_ca.avis, lien_map.lien, utilisateurs_inscrit.pseudo
                                                FROM forum_ca, commerce_alimentaire, lien_map, utilisateurs_inscrit
                                                WHERE forum_ca.id_commerce=commerce_alimentaire.id_commerce
                                                AND lien_map.id_commerce=commerce_alimentaire.id_commerce
                                                AND utilisateurs_inscrit.id_UI=forum_ca.id_UI
                                                AND commerce_alimentaire.id_commerce='.$r_id['id_commerce'].'
                                                Limit 1'); /* importation des données */


                        while ($r_donnee = $donnee -> fetch()) {

                            echo 
                            '
                            <div class="plus-pop"><h3>'.$r_donnee['nom_etablissement'].'</h3>
                            <p> Page du commerce :
                            <a href="page_commerce/page_commerce.php?id_commerce='.$r_id['id_commerce'].'"> lien du site internet </a> </p>
                            <p> Localisation : </p>
                            '.$r_donnee['lien'].'
                            <div class="block">
                            <div class="avis">
                            <p> Avis clients : </br></br>'
                            .$r_donnee['pseudo'].' - </br>'
                            .$r_donnee['avis'].'</p>
                            </div>
                            <div class="etat">
                            <p> Etat sanitaire : </br></br>'
                            .$r_donnee['niveau_sanitaire'].'</p>
                            </div>
                            </div>
                            </div>
                            '
                            ;

                        }
                        $donnee -> closeCursor();

                    }
                    $id -> closeCursor();
                
                ?>

    </section>
    </body>

</html>