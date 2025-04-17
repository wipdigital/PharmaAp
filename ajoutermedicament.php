<?php
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
    <title>Ajouter un medicament</title>
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
        <a class="selected submenu mini-size" href="affichermedicaments.php">Medicaments</a>
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
                <a class="selected" href="affichermedicaments.php">Medicaments</a>
                </li>
                <li>
                <a href="new_aff.php">Achats</a>
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
    </nav>

    <div class="profile-container">
        <div class="retour">
            <a href="affichermedicaments.php" class="btn btn-primary"> <h4>Medicaments <<<</h4></a><h4> Ajout d'un medicament</h4>
        </div>
        <?php
            if(isset($_POST['submit'])){
                $nom=$_POST['nom'];
        
                $verifsql = "select nom from `medicament` where nom = '$nom'";
                $verifresult = mysqli_query($con, $verifsql);
        
                if($verifresult){
                    if($verifresult -> num_rows == 0){
                        $sql = "insert into `medicament` (nom) values('$nom')";
                        $result=mysqli_query($con, $sql);
                        if($result){
                            header('location: affichermedicaments.php');
                        } else {
                            die(mysqli_error($con));
                        }
                    } else {
                        echo '<p style="color: red;">Ce medicament existe déjà</p>';
                    }
                } else {
                    die(mysqli_error($con));
                }
            }
        ?>   
        <div class="profile-div" id="profile-div">
            <form method="post" class="profile-form">
                <div>
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="profile-btns-container">
                    <button type="submit" id="submit" name = "submit" class="btn-primary modifierProfile-btn">Enregistrer
                    </button>
                    <button class="btn btn-danger profile-annuler-btn"><a href="affichermedicaments.php">Annuler</a></button>
                </div>
            </form>
        </div>
    </div>

    <script src="./nav_ajouter.js"></script>
</body>
</html>