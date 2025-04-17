<?php
    include 'db.php';

    session_start();

    // Vérifier si l'utilisateur est connecté
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['niveau']) || $_SESSION['niveau'] > 2) {
        header('Location: index.php');
        exit;
    }

    if(isset($_GET['supprimerID'])){
        $suppressionID = $_GET['supprimerID'];


        $sql="delete from `medicament` where medicamentID=$suppressionID";
        $result=mysqli_query($con, $sql);
        if($result){
            // echo "Deleted successfull";
            header("location:affichermedicaments.php");
        }else {
            die(mysqli_error($con));
        }
    }
?>