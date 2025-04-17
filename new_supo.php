<?php
    include 'db.php';

    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['niveau']) || $_SESSION['niveau'] > 2) {
        header('Location: index.php');
        exit;
    }


?>