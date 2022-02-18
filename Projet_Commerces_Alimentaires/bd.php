<?php
    function getBD(){
    $bdd = new PDO('mysql:host=localhost;dbname=projet_ca;charset=utf8', 'root', '');
    return $bdd;
    }
?>