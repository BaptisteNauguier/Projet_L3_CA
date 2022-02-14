<?php
    function getBD(){
    $bdd = new PDO('mysql:host=localhost;dbname=SportPlus;charset=utf8', 'root', 'root');
    return $bdd;
    }
?>