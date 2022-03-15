<!DOCTYPE html>

<html>

    <head>
        
        <title> Connexion </title>
        <meta charset="utf-8">

    </head> 

    <body>

        <section>           
            <form action="connecter.php" method="post" autocomplete="off">
                <div>
                    <p>
                        Adresse e-mail :
                        <input type="text" name="mail" value=""/>
                    </p>
                </div>
                <div>
                    <p>
                        Mot de passe :
                        <input type="password" name="mdp" value=""/>
                    </p>
                </div>
                <div>
                    <p>
                        <input type="submit" value="Connexion"/>
                    </p>
                </div>

            </form>

            <a href="../compte/inscription.php">Créer un compte</a>
        </section>
    
    </body>

</html>