<!DOCTYPE html>

<html>

    <head>
        <link rel="stylesheet" href="css/style_inscription.css" type="text/css" media="screen" />
        <meta charset="utf-8">
        <title> Inscription </title>

        <?php
            include('bd.php');
        ?>

        <?php
            $bdd = getBD();        
        ?>

    
    </head>

    <body>

	
	<form action="index.php" method="get" autocomplete="off">
<p>
Nom :
<input type="text" name="n" value=""/>
</p>
    
    <p>
Prénom :
<input type="text" name="p" value=""/>
</p>

 <p>
Nom d'utilisateur:
<input type="text" name="nd" value=""/>
</p>
    
     <p>
Adresse email:
<input type="text" name="mail" value=""/>
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