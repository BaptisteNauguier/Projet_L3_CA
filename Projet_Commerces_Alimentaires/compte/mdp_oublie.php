<!DOCTYPE html>

<html>

    <head>
        <link rel="stylesheet" href="css/style_mdp_oublie.css" type="text/css" media="screen" />
        <meta charset="utf-8">
        <title> Mot de passe oublié </title>

        <?php
            include('../bd.php');
    
            $bdd = getBD();        
        ?>

    
    </head>

    <body>
            
        <h1> Vous avez oublié votre mot de passe ? </h1>
        
        <form action="index.php" method="get" autocomplete="off">
            <p class="mail">
            Adresse mail :
            <input type="text" name="mail" value=""/>
            </p>
            
            <p class="phrase"> Nous allons envoyer un mail avec un lien pour réinitialiser votre mot de passe </p>
                
            <p>
            <input type="submit" value="Envoyer">
            </p>
        </form>
            
    </body>

</html>