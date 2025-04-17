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
        $infosql = "select achatID,medicament.nom, distributeur,prixUnitaire, quantite, dateAchat from achat inner join medicament on achat.medicamentID= medicament.medicamentID and achatID=$infoID";
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