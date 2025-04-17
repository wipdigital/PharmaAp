<?php
    include 'db.php';

    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['niveau'])) {
        header('Location: index.php');
        exit;
    }

    $resultsbox = array();
    $achatsql = "select medicament.nom, sum(quantite) as 'quantite' from `medicament` inner join `achat` on medicament.medicamentID = achat.medicamentID group by medicament.nom";
    $achatresult = mysqli_query($con, $achatsql);
    if($achatresult){
        $ventesql = "select medicament.nom, sum(quantite) as 'quantite' from `medicament` inner join `vente` on medicament.medicamentID = vente.medicamentID 
        group by medicament.nom";
        $venteresult = mysqli_query($con, $ventesql);
        if($venteresult){
            $achats = [];
            $ventes = [];
            if($achatresult -> num_rows != 0){
                while($achatrow = $achatresult -> fetch_all()){
                    $achats = $achatrow;
                }
            }
            if($venteresult -> num_rows != 0){
                while($venterow = $venteresult -> fetch_all()){
                    $ventes = $venterow;
                }
    
                $resultsbox[] = $achats;
                $resultsbox[] = $ventes;
    
                echo json_encode($resultsbox);
            }
        }
    }
?>