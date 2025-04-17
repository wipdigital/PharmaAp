<?php

    ob_start();
    include 'db.php';

    session_start();

    if (!isset($_SESSION['niveau'])) {
        header('Location: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier ses informations</title>
</head>
<body>
    <nav>
        <div class="profile-logout" id="profile-logout">
            <a class="logout" href="logout.php" id="logout">Logout</a>
        </div>
        <button class="fb menubtn mini-size" id="menubtn" type="submit" name="search">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
            </svg>
        </button>   
        <a class="profile" id=profile href="profile.php" title="Mon profile">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                </svg>
            </div>
        </a>
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
                <?php
                    if (isset($_SESSION['niveau'])) {
                        echo '
                    <li>
                    <a href="affichermedicaments.php">Medicaments</a>
                    </li>
                    <li>
                    <a href="new_aff.php">Achats</a>
                    </li>
                    <li>
                    <a href="afficherventes.php">Ventes</a>
                    </li>
                    <li>';
                }
                ?>
                    <a href="afficherstock.php">Stock</a>
                    </li>
                <?php
                    if (isset($_SESSION['niveau'])) {
                        echo '
                <li >
                <a aria-current="page" href="dashboard.php">Dashboard</a>
                </li>
                ';
                        }
                    ?>
            </ul>
        </div>
    </nav>
    <div class="profile-container">
    <h3 class="info-header">Modifier mon profile</h3>
            <?php
                $adminID =  $_SESSION['adminID'];

                if(isset($_POST['enregistrer'])){
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $email = $_POST['email'];

                    $adminverifsql = "select email from admins where email= '$email' and adminID <> $adminID";
                    $adminverifresult = mysqli_query($con, $adminverifsql);
                    if($adminverifresult){
                        if($adminverifresult -> num_rows == 0){
                            $adminsql = "update admins set nom='$nom', prenom = '$prenom', email = '$email' where adminID=$adminID";
                            $adminresult = mysqli_query($con, $adminsql);
                            if($adminresult){
                                header('location: profile.php');
                            } else {
                                die(mysqli_error($con));
                            }
                        } else {
                            echo '<p style="color: red;">L email a été déjà utilisé</p>';
                        }
                    } else {
                        die(mysqli_error($con));
                    }
                    ob_end_flush();
                }
                
                $infosql = "select nom, prenom, email , niveau from admins where adminID=$adminID";
                $inforesult = mysqli_query($con, $infosql);
                if($inforesult){
                    $inforow = mysqli_fetch_assoc($inforesult);
                    $nom = $inforow['nom'];
                    $prenom = $inforow['prenom'];
                    $email = $inforow['email'];
                    $niveau = $inforow['niveau'];
                    echo '
                        <div class="profile-div" id="profile-div">
                            <form method="post" class="profile-form">
                                <div>
                                    <label for="info_idAdmin" class="form-label">ID admin :</label>
                                    <input type="text" id="info_idAdmin" value="'.$adminID.'" disabled>
                                </div>
                                <div>
                                    <label for="info_nom" class="form-label">Nom :</label>
                                    <input type="text" id="info_prenom" name="nom" value="'.$nom.'">
                                </div>
                                <div>
                                    <label for="info_prenom" class="form-label">Prénom :</label>
                                    <input type="text" id="info_prenom" name="prenom" value="'.$prenom.'">
                                </div>
                                <div>
                                    <label for="info_email" class="form-label">Adresse email :</label>
                                    <input type="text" id="info_email" name="email" value="'.$email.'">
                                </div>
                                <div>
                                    <label for="info_niveau" class="form-label">Niveau :</label>
                                    <input type="text" id="info_niveau" value="'.$niveau.'" disabled>
                                </div>
                                <div class="profile-btns-container">
                                    <button type="submit" id="enregistrer" name = "enregistrer" class="btn-primary modifierProfile-btn">Enregistrer
                                    </button>
                                    <button class="btn btn-danger profile-annuler-btn"><a href="profile.php">Annuler</a></button>
                                </div>
                            </form>
                        </div>
                    ';
                } else {
                    die(mysqli_error($con));
                }
            ?>
    </div>

    <script src="./nav_profile.js"></script>
</body>
</html>