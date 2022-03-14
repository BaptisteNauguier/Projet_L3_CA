<!DOCTYPE html>

<html>

    <head>

        <title> Deconnexion </title>
        <meta charset="utf-8">

        <?

            session_start();
            session_destroy();

            echo '<meta http-equiv="refresh" content=0;URL="../index.php">';

        ?>

    </head> 

    <body>
    
    </body>

</html>