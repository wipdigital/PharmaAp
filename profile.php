<?php
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
    <title>Profile</title>
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
        <a class="large-logout" href="logout.php"><span class="large-logout">Logout</span></a>
        <a class="page-title" href="#">Gestion Pharmacie</a>
        <div class="menu-container">
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
    
    <?php
        $adminID =  $_SESSION['adminID'];
        
        $infosql = "select nom, prenom, email , niveau from admins where adminID=$adminID";
        $inforesult = mysqli_query($con, $infosql);
        if($inforesult){
            $inforow = mysqli_fetch_assoc($inforesult);
            $nom = $inforow['nom'];
            $prenom = $inforow['prenom'];
            $email = $inforow['email'];
            $niveau = $inforow['niveau'];

            
            echo '
                <div class="profile-container">
                    <h3 class="info-header">Mon profile</h3>
                    <div class="profile-div" id="profile-div">
                        <form method="post" class="profile-form">
                            <div>
                                <label for="info_idAdmin" class="form-label">ID admin :</label>
                                <input type="text" id="info_idAdmin" value="'.$adminID.'" disabled>
                            </div>
                            <div>
                                <label for="info_nom" class="form-label">Nom :</label>
                                <input type="text" id="info_prenom" name="nom" value="'.$nom.'" disabled>
                            </div>
                            <div>
                                <label for="info_prenom" class="form-label">Prénom :</label>
                                <input type="text" id="info_prenom" name="prenom" value="'.$prenom.'" disabled>
                            </div>
                            <div>
                                <label for="info_email" class="form-label">Adresse email :</label>
                                <input type="text" id="info_email" name="email" value="'.$email.'" disabled>
                            </div>
                            <div>
                                <label for="info_niveau" class="form-label">Niveau :</label>
                                <input type="text" id="info_niveau" value="'.$niveau.'" disabled>
                            </div>
                            <button class="btn-primary modifierProfile-btn" id="modifierProfile-btn">
                                <a href="profilemodifier.php? modificationID = '.$adminID.'">Modifier </a>
                            </button>
                        </form>
                    </div>
                </div>
            ';
        } else {
            die(mysqli_error($con));
        }
    ?>
    <script src="./nav_profile.js"></script>
</body>
</html>