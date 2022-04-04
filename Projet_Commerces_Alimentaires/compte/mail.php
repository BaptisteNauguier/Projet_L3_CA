<!DOCTYPE html>

<html>

    <head>

        <title> Envoie mail </title>
        <meta charset="utf-8">

        <?php

            email();
            echo '<meta http-equiv="refresh" content=10;URL="../index.php">';
            

        ?>

    </head>

    <body>

            <?php 
                function email(){
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $from = "commerces.alimentaires@hotmail.com";
                    $to = "commerces.alimentaires@hotmail.com";
                    $subject = "mdp oublie";
                    $message = "Veuillez cliquer sur le lien pour changer votre mdp :";
                    $header = "From :" . $from;
                    mail($to,$subject,$message,$header);
                }
               
            ?>
    
    </body>

</html>