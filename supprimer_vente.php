<?php
    include 'db.php';

    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['niveau']) || $_SESSION['niveau'] > 2) {
        header('Location: index.php');
        exit;
    }

    if(isset($_GET['supprimerID'])){
        $suppressionID = $_GET['supprimerID'];
        $ventesql = "select medicamentID,quantite from `vente` where venteID=$suppressionID";
        $venteresult = mysqli_query($con, $ventesql);
        if($venteresult){
            if($venteresult -> num_rows !=0){
                $row = mysqli_fetch_assoc($venteresult);
                $medicamentID = $row['medicamentID'];
                $quantite = $row['quantite'];
                
                $stocksql = "update `stock` set quantite = quantite + $quantite where medicamentID = $medicamentID";
                $stockresult = mysqli_query($con, $stocksql);
                if($stockresult){
                    $sql="delete from `vente` where venteID=$suppressionID";
                    $result=mysqli_query($con, $sql);
                    if($result){
                        header("location:afficherventes.php");
                    }else {
                        die(mysqli_error($con));
                    }
                } else {
                    die(mysqli_error($con));
                }
            }
        } else {
            die(mysqli_error($con));
        }
    }
?>