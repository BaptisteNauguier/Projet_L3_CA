<!DOCTYPE html>

<html>

    <head>

        <link rel="stylesheet" href="../styles/style.css" type="text/css" media="screen" />
        <meta charset="utf-8">
        <title> Nouveau </title>

    </head> 

    <body>
        <section >
            <form action="enregistrement.php" method="post" autocomplete="off">
                <p>
                    Nom :
                    <input type="text" name="n" value=<? echo '"'.$_GET['n'].'"'; ?>/>
                </p>
                <p>
                    Prénom :
                    <input type="text" name="p" value=<? echo '"'.$_GET['p'].'"'; ?>/>
                </p>
                <p>
                    Pseudo :
                    <input type="text" name="pseudo" value=<? echo '"'.$_GET['pseudo'].'"'; ?>/>
                </p>
                <p>
                    Adresse e-mail :
                    <input type="text" name="mail" value=<? echo '"'.$_GET['mail'].'"'; ?>/>
                </p>
                <p>
                    Mot de passe :
                    <input type="password" name="mdp1" value=""/>
                </p>
                <p>
                    Confirmer votre mot de passe :
                    <input type="password" name="mdp2" value=""/>
                </p>
                <p>
                    <input class="button" type="submit" value="Envoyer"/>
                </p>
            </form>
        </section>
        
    </body>

</html>