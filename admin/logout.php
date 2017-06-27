<?php
session_name('wmd');session_start();

if(isset($_GET['logout']) && $_GET['logout'] == 'yes'){
    
    unset($_SESSION['user']); // Détruit les entrées de $_SESSION

    header('Location:../'); // Redirige vers la page d'accueil
    die(); // On stoppe tout, juste pour être sur :-)
}