<!DOCTYPE html>

<html>

    <head>

        <link rel="stylesheet" href="css/style_inscription.css" type="text/css" media="screen" />
        <meta charset="utf-8">
        <title> Inscription </title>
    
    </head>

    <body>

                
        <form action="enregistrement.php" method="post" autocomplete="off">
            <p>
            Nom :
            <input type="text" name="n" value="<? echo $_GET['n'] ?>"/>
            </p>
                
            <p>
            Prénom :
            <input type="text" name="p" value="<? echo $_GET['p'] ?>"/>
            </p>

            <p>
            Nom d'utilisateur:
            <input type="text" name="pseudo" value="<? echo $_GET['pseudo'] ?>"/>
            </p>
                
            <p>
            Adresse email:
            <input type="text" name="mail" value="<? echo $_GET['mail'] ?>"/>
            </p>
                
            <p>
            Mot de passe :
            <input type="password" name="mdp1" value=""/>
            </p>

            <p>
            Confirmation mot de passe :
            <input type="password" name="mdp2" value=""/>
            </p>  

            <p class="submit">
            <input type="submit" value="Valider">
            </p>
        </form>

	
    </body>

</html>