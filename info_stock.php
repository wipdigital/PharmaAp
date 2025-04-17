<?php
    include 'db.php';

    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['niveau'])) {
        header('Location: index.php');
        exit;
    }

    if(isset($_GET['infoID'])){
        $infoID = $_GET['infoID'];
        $infosbox = array();
        $infosql = "select medicament.nom, stock.quantite from medicament inner join stock on medicament.medicamentID = stock.medicamentID and stock.medicamentID=$infoID";
        $inforesult = mysqli_query($con, $infosql);
        if($inforesult){
            $infos = [];
            if($inforesult -> num_rows != 0){
                while($inforow = $inforesult -> fetch_all()){
                    $infos = $inforow;
                }
    
                $infosbox[] = $infos;
    
                echo json_encode($infosbox);
            }
        } else {
            die(mysqli_error($con));
        }
    }

?>