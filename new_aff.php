<?php

    ob_start();

    include 'db.php';

    session_start();
    if (!isset($_SESSION['niveau'])) {
        header('location: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Achats</title>
</head>
<body>
<nav class="nav-afficher">
    <a class="profile
            <?php
        if($_SESSION['niveau'] > 2){
            echo "connected-profile";
        }
        ?> 
    " href="profile.php" id="profile" title="Mon profile">
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
        <a class="selected submenu mini-size" href="new_aff.php">Achats</a>
        <a class="page-title" href="#">Gestion Pharmacie</a>
        <div class="menu-container" id="navbarSupportedContent">
            <ul class="menu" id="menu">
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
                <a class="selected" href="new_aff.php">Achats</a>
                </li>
                <li>
                <a href="afficherventes.php">Ventes</a>
                </li>
                <li>
                <a href="afficherstock.php">Stock</a>
                </li>
                <li >
                <a aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
        <div class="pdf-search">
            <form class="pdf
                <?php
                if($_SESSION['niveau'] > 2){
                    echo "connected-pdf";
                }
                ?> 
    " id="pdf" method="post" action="new_gen.php">
                <button class="btn btn-outline-success" type="submit" name="pdf" title="Generer un document pdf">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z"/>
                <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103"/>
                </svg>
                </button>
            </form>
            <form class="search" role="search" method="post">
                <div class="fd">
                    <input class="sfc" id="searchInput" type="search" placeholder="Search" aria-label="Search" name="searchVal">
                    <button class="fb" type="submit" name="search">Search</button>
                </div>
            </form>
        </div>
    </nav>

    <div class="info-div" id="info-div">
        <form method="post" class="info-form">
            <div>
                <label for="info_idAchat" class="form-label">ID achat :</label>
                <input type="text" id="info_idAchat" value="................" disabled>
            </div>
            <div>
                <label for="info_medicament" class="form-label">Medicament :</label>
                <input type="text" id="info_medicament" value="......................." disabled>
            </div>
            <div>
                <label for="info_distributeur" class="form-label">Distributeur :</label>
                <input type="text" id="info_distributeur" value="................................" disabled>
            </div>
            <div>
                <label for="info_prixUnitaire" class="form-label">Prix Unitaire :</label>
                <input type="text" id="info_prixUnitaire" value="................" disabled>
            </div>
            <div>
                <label for="info_quantite" class="form-label">Quantité :</label>
                <input type="text" id="info_quantite" value="......................." disabled>
            </div>
            <div>
                <label for="info_dateAchat" class="form-label">Date achat :</label>
                <input type="text" id="info_dateAchat" value="................................" disabled>
            </div>
            <button class="btn-primary closeInfo-btn" id="closeInfo-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
            </svg>Fermer</button>
        </form>
    </div>

    <div class="container afficher-achats">
        <?php
            if ($_SESSION['niveau'] <=2) {
                echo '
                    <button class="btn btn-ajouter btn-primary"><a href="new_aj.php" class="text-light" style="text-decoration: none;">Ajouter un achat</a></button>
                ';
            }

            //suppression d'un medicament des achats
            if(isset($_GET['supprimerID'])){
                $suppressionID = $_GET['supprimerID'];
        
                $achatsql = "select medicamentID,quantite from `achat` where achatID=$suppressionID";
                $achatresult = mysqli_query($con, $achatsql);
                if($achatresult){
                    $row = mysqli_fetch_assoc($achatresult);
                    $medicamentID = $row['medicamentID'];
                    $quantite = $row['quantite'];
        
                    
        
                    $stockverifsql = "select quantite from `stock` where medicamentID=$medicamentID";
                    $stockverifresult = mysqli_query($con, $stockverifsql);
                    if($stockverifresult){
                        $stockverifrow = mysqli_fetch_assoc($stockverifresult);
                        $stockQuantite = $stockverifrow['quantite'];
        
                        if($stockQuantite >= $quantite){
                            $stocksql = "update `stock` set quantite = quantite - $quantite where medicamentID = $medicamentID";
                            $stockresult = mysqli_query($con, $stocksql);
                            if($stockresult){
                                $sql="delete from `achat` where achatID=$suppressionID";
                                $result=mysqli_query($con, $sql);
                                if($result){
                                    header("location: new_aff.php");
                                }else {
                                    die(mysqli_error($con));
                                }
                            } else {
                                die(mysqli_error($con));
                            }
                        } else {
                            echo '<p style="color: red;">On ne peut pas supprimer une quantite non disponible au niveau du stock</p>';
                        }
                    }
                } else {
                    die(mysqli_error($con));
                }
            }
        ?>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"class="achat-1">ID achat</th>
                    <th scope="col">Medicament</th>
                    <th scope="col"class="achat-3">Distibuteur</th>
                    <th scope="col"class="achat-4">Prix Unitaire</th>
                    <th scope="col">Quantité</th>
                    <th scope="col"class="achat-5">Date de l'achat</th>
                    <?php
                    if ($_SESSION['niveau'] >2){
                        echo '<th class="connected-operations achat-connected-operations" scope="col">Opérations</th>';
                    }
                    elseif ($_SESSION['niveau'] <=2){
                        echo '<th scope="col">Opérations</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody id="table-content">
                <?php

                if(isset($_POST['search']) && $_POST['searchVal'] != ""){
                    $searchTerm = $_POST['searchVal'];
                    if($searchTerm!=""){
                        $sql = "Select achatID, achat.medicamentID, distributeur, prixUnitaire, quantite, dateAchat from `achat` inner join `medicament` where achat.medicamentID=medicament.medicamentID and (medicament.nom like '%$searchTerm%' or achat.distributeur like '%$searchTerm%') order by achatID desc";
                    $result = mysqli_query($con,$sql);
                    if($result){
                        $mnom = "";
                        while($row=mysqli_fetch_assoc($result)){
                            $achatID = $row['achatID'];
                            $medicamentID = $row['medicamentID'];
                            $distributeur = $row['distributeur'];
                            $prixUnitaire = $row['prixUnitaire'];
                            $quantite = $row['quantite'];
                            $dateAchat = $row['dateAchat'];

                            $msql = "select nom from `medicament` where medicamentID='$medicamentID'";
                            $mresult = mysqli_query($con, $msql);

                            if($mresult){
                                $mrow = mysqli_fetch_assoc($mresult);
                                $mnom = $mrow['nom'];
                            }
                            echo '
                            <tr>
                                <th scope="row" class="achat-1">'.$achatID.'</th>
                                    <td>'.$mnom.'</td>
                                    <td class="achat-3">'.$distributeur.'</td>
                                    <td class="achat-4">'.$prixUnitaire.'</td>
                                    <td>'.$quantite.'</td>
                                    <td class="achat-5">'.$dateAchat.'</td>
                            ';
                            if ($_SESSION['niveau'] <= 2){
                                echo '
                                    <td>
                                ';
                            }
                            if ($_SESSION['niveau'] > 2){
                                echo '
                                    <td class="connected-ops achat-connected-ops">
                                ';
                            }
                            if ($_SESSION['niveau']){
                                echo '
                                        <button class="btn btn-primary row-menu-btn achat-row-menu-btn" mymenu="'.$achatID.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                            </svg>
                                        </button>
                                        <div class="row-menu-container activate-menu'.$achatID.' " menu="'.$achatID.'">
                                            <ul class="row-menu">
                                                <li>
                                                    <button class="btn btn-primary info-btn" id="info-btn" infoID="'.$achatID.'"><a href="#" class="text-light" style="text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg></a></button>
                                                </li>
                                ';
                            }
                            if ($_SESSION['niveau'] <=2){
                                echo '
                                                <li>
                                                    <button class="btn btn-primary"><a href="new_meta.php? mettre_a_jourID='.$achatID.'" class="text-light" style="text-decoration: none;">Mettre à jour</a></button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-danger"><a href="new_aff.php? supprimerID='.$achatID.'" class="text-light" style="text-decoration: none;">Supprimer</a></button>
                                                </li>
                                ';
                            }
                            if ($_SESSION['niveau']){
                                echo '
                                                <li>
                                                    <button class="btn btn-primary close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                                    </svg>Fermer</button>
                                                </li>
                                            </ul>
                                        </div>
                                ';
                            }
                            if ($_SESSION['niveau'] <=2){
                                echo '
                                        <button class="btn btn-primary achat-2"><a href="new_meta.php? mettre_a_jourID='.$achatID.'" class="text-light" style="text-decoration: none;">Mettre à jour</a></button>
                                        <button class="btn btn-danger achat-2"><a href="new_aff.php? supprimerID='.$achatID.'" class="text-light" style="text-decoration: none;">Supprimer</a></button>
                                ';
                            }
                            if ($_SESSION['niveau']){
                                echo '
                                        </td>
                                ';
                            }
                            echo '
                                </tr>
                            ';
                        }
                    }
                    }
                }else {
                    $sql = "Select * from `achat`  order by achatID desc";
                    $result = mysqli_query($con,$sql);
                    if($result){
                        $mnom = "";
                        while($row=mysqli_fetch_assoc($result)){
                            $achatID = $row['achatID'];
                            $medicamentID = $row['medicamentID'];
                            $distributeur = $row['distributeur'];
                            $prixUnitaire = $row['prixUnitaire'];
                            $quantite = $row['quantite'];
                            $dateAchat = $row['dateAchat'];


                            $msql = "select nom from `medicament` where medicamentID='$medicamentID'";
                            $mresult = mysqli_query($con, $msql);

                            if($mresult){
                                $mrow = mysqli_fetch_assoc($mresult);
                                $mnom = $mrow['nom'];
                            }

                            echo '
                            <tr>
                                <th scope="row" class="achat-1">'.$achatID.'</th>
                                    <td>'.$mnom.'</td>
                                    <td class="achat-3">'.$distributeur.'</td>
                                    <td class="achat-4">'.$prixUnitaire.'</td>
                                    <td>'.$quantite.'</td>
                                    <td class="achat-5">'.$dateAchat.'</td>
                            ';
                            if ($_SESSION['niveau'] <= 2){
                                echo '
                                    <td>
                                ';
                            }
                            if ($_SESSION['niveau'] > 2){
                                echo '
                                    <td class="connected-ops achat-connected-ops">
                                ';
                            }
                            if ($_SESSION['niveau']){
                                echo '
                                        <button class="btn btn-primary row-menu-btn achat-row-menu-btn" mymenu="'.$achatID.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                            </svg>
                                        </button>
                                        <div class="row-menu-container activate-menu'.$achatID.' " menu="'.$achatID.'">
                                            <ul class="row-menu">
                                                <li>
                                                    <button class="btn btn-primary info-btn" id="info-btn" infoID="'.$achatID.'"><a href="#" class="text-light" style="text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg></a></button>
                                                </li>
                                ';
                            }
                            if ($_SESSION['niveau'] <=2){
                                echo '
                                                <li>
                                                    <button class="btn btn-primary"><a href="new_meta.php? mettre_a_jourID='.$achatID.'" class="text-light" style="text-decoration: none;">Mettre à jour</a></button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-danger"><a href="new_aff.php? supprimerID='.$achatID.'" class="text-light" style="text-decoration: none;">Supprimer</a></button>
                                                </li>
                                ';
                            }
                            if ($_SESSION['niveau']){
                                echo '
                                                <li>
                                                    <button class="btn btn-primary close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                                    </svg>Fermer</button>
                                                </li>
                                            </ul>
                                        </div>
                                ';
                            }
                            if ($_SESSION['niveau'] <=2){
                                echo '
                                        <button class="btn btn-primary achat-2"><a href="new_meta.php? mettre_a_jourID='.$achatID.'" class="text-light" style="text-decoration: none;">Mettre à jour</a></button>
                                        <button class="btn btn-danger achat-2"><a href="new_aff.php? supprimerID='.$achatID.'" class="text-light" style="text-decoration: none;">Supprimer</a></button>
                                ';
                            }
                            if ($_SESSION['niveau']){
                                echo '
                                    </td>
                                ';
                            }
                            echo '
                                </tr>
                            ';
                        }
                    }
                } 
                ob_end_flush();
                ?>
            </tbody>
        </table>
    </div>
    <script src="./nav.js"></script>
    <script src="./row_menu_achat.js"></script>
    <script src="./info_achat.js"></script>
</body>
</html>