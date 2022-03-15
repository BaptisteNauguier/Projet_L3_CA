<!DOCTYPE html>
<html lang="fr">
	<head>

        <title> Deconnexion </title>
        <meta charset="utf-8">

        <?php
		include('../bd.php');
		$bdd = getBD();

            session_start();
            session_destroy();
		 ?>

        <meta http-equiv="refresh" content=0;URL="../index.php">

       

    </head> 

    <body>
    
    </body>

</html>