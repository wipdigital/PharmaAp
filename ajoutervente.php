<?php

    ob_start();
    include 'db.php';

    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['niveau']) || $_SESSION['niveau'] > 2) {
        header('Location: index.php');
        exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter une vente</title>
    <style>
        .backtomenu {
            display: flex;
        }
        .backtomenu a{
            text-decoration:none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <a class="profile profile-profile" id="profile" href="profile.php" title="Mon profile">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                </svg>
            </div>
        </a>
        <button class="fb menubtn mini-size" id="menubtn" type="submit" name="search">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
            </svg>
        </button>   
        <a class="selected submenu mini-size" href="afficherventes.php">Ventes</a>
        <a class="page-title" href="#">Gestion Pharmacie</a>
        <div class="menu-container" id="navbarSupportedContent">
            <ul class="menu menu-profile" id="menu" >
                <?php
                    if ($_SESSION['niveau'] ==1) {
                        echo '
                            <li class="nav-item">
                            <a href="afficheradmins.php">Admins</a>
                            </li>
                        ';
                    }
                ?>
                <li>
                <a href="affichermedicaments.php">Medicaments</a>
                </li>
                <li>
                <a href="new_aff.php">Achats</a>
                </li>
                <li>
                <a class="selected" href="afficherventes.php">Ventes</a>
                </li>
                <li>
                <a href="afficherstock.php">Stock</a>
                </li>
                <li >
                <a aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="profile-container">
        <div class="retour">
            <a href="afficherventes.php" class="btn btn-primary"> <h4>Ventes <<<</h4></a><h4> Ajout d'une vente</h4>
        </div>
            <?php
                if(isset($_POST['submit'])){
                    $medicamentID=$_POST['medicamentID'];
                    $prixUnitaire=$_POST['prixUnitaire'];
                    $quantite=$_POST['quantite'];

                    $stockverifsql = "select quantite from `stock` where medicamentID=$medicamentID";
                    $stockverifresult = mysqli_query($con, $stockverifsql);
                    if($stockverifresult){
                        $stockverifrow = mysqli_fetch_assoc($stockverifresult);
                        $stockQuantite = $stockverifrow['quantite'];

                        if($stockQuantite >= $quantite){                        
                            $sql = "insert into `vente` (medicamentID, prixUnitaire, quantite) values('$medicamentID', '$prixUnitaire', '$quantite')";
                            $result=mysqli_query($con, $sql);
                            if($result){
                                $stockverifsql="select quantite from `stock` where medicamentID=$medicamentID";
                                $stockverifresult = mysqli_query($con, $stockverifsql);
                                if($stockverifresult){
                                    if($stockverifresult->num_rows ==0){
                                        $stocksql = "insert into   `stock`(medicamentID,quantite) values('$medicamentID','$quantite')";
                                        $stockresult = mysqli_query($con, $stocksql);
                                        if(!$stockresult){
                                            die(mysqli_error($con));
                                        }
                                    } else {
                                        $stocksql = "update `stock` set quantite = quantite - $quantite where medicamentID=$medicamentID";
                                        $stockresult = mysqli_query($con,$stocksql);
                                        if(!$stockresult) {
                                            die(mysqli_error($con));
                                        }
                                    }
                                } else {
                                    die(mysqli_error($con));
                                }
        
                                header('location: afficherventes.php');
                            } else {
                                die(mysqli_error($con));
                            }
                        } else {
                            echo '<p style="color:red;">On peut pas mettre une quantite supérieure à celle du stock</p>';
                        }
                    }else {
                        die(mysqli_error($con));
                    }


                }
            
            ?>
        <div class="profile-div" id="profile-div">
            <form method="post" class="profile-form">
                <div class="mb-3">
                    <label for="medicament" class="form-label">Medicament</label>
                    <select name="medicamentID" id="medicament" required>
                        <option value="" disabled selected>...............</option>
                        <?php
                            $sql = "Select medicament.medicamentID, medicament.nom from `medicament` inner join stock on medicament.medicamentID=stock.medicamentID";
                            $result = mysqli_query($con,$sql);
                            if($result){

                                while($row=mysqli_fetch_assoc($result)){
                                    $medicamentID = $row['medicamentID'];
                                    $nom = $row['nom'];

                                    echo '
                                        <option value="'.$medicamentID.'">'.$nom.'</option>
                                    ';
                                }
                            }

                            ob_end_flush();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="prixUnitaire" class="form-label">Prix unitaire</label>
                    <input type="number" class="form-control" id="prixUnitaire" name="prixUnitaire" placeholder="Saisissez le prix unitaire ici" required>
                </div>
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Saisissez la quantité ici" required>
                </div>
                <div class="profile-btns-container">
                    <button type="submit" id="submit" name = "submit" class="btn-primary modifierProfile-btn">Enregistrer
                    </button>
                    <button class="btn btn-danger profile-annuler-btn"><a href="afficherventes.php">Annuler</a></button>
                </div>
            </form>
    </div>

    <script src="./nav_ajouter.js"></script>
</body>
</html>