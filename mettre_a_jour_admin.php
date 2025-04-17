<?php
    include 'db.php';

    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['niveau']) || $_SESSION['niveau'] !=1) {
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
    <title>Mettre à jour un admin</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <a class="profile profile-profile" href="profile.php" id="profile" title="Mon profile">
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
        <a class="selected submenu mini-size" href="afficheradmins.php">Admins</a>
        <a class="page-title" href="#">Gestion Pharmacie</a>
        <div class="menu-container" id="navbarSupportedContent">
            <ul class="menu menu-profile" id="menu">
                <li>
                    <a class="selected" href="afficheradmins.php">Admins</a>
                <li>
                <a href="affichermedicaments.php">Medicaments</a>
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
            <a href="afficheradmins.php" class="btn btn-primary"> <h4>Admins <<<</h4></a><h4> Mise à jour d'un administrateur</h4>
        </div>
        <?php
            $mise_a_jourID = $_GET['mettre_a_jourID'];
            $sql="select nom, prenom , email, niveau from `admins` where adminID = $mise_a_jourID";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $mise_a_jourNom=$row['nom'];
            $mise_a_jourPrenom=$row['prenom'];
            $mise_a_jourEmail=$row['email'];
            $mise_a_jourNiveau=$row['niveau'];
            if(isset($_POST['submit'])){
                $nom=$_POST['nom'];
                $prenom=$_POST['prenom'];
                $email=$_POST['email'];
                $niveau=$_POST['niveau'];
        
                $verifsql="select email from `admins` where email='$email' and adminID <> $mise_a_jourID";
                $verifresult = mysqli_query($con, $verifsql);
                if($verifresult){
                    if($verifresult -> num_rows === 0){
                        $sql = "update `admins` set nom='$nom', prenom='$prenom', email='$email', niveau=$niveau where adminID='$mise_a_jourID'";
                        $result=mysqli_query($con, $sql);
                        if($result){
                            header('location: afficheradmins.php');
                        } else {
                            die(mysqli_error($con));
                        }
                    } else {
                        echo '<p style="color: red;">L email a été déjà utilisé</p>';
                    }
                } else {
                    die(mysqli_error($con));
                }
            }
        ?>

        <div class="profile-div" id="profile-div">
            <form method="post" class="profile-form">
                <div >
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $mise_a_jourNom ?>">
                </div>
                <div >
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $mise_a_jourPrenom ?>">
                </div>
                <div>
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $mise_a_jourEmail ?>">
                </div>

                <div>
                    <label for="niveau" class="form-label">Niveau</label>
                    <select name="niveau" id="niveau">
                    <?php for($i=1; $i<=3;$i++){
                            echo '<option value="'.$i.'"';
                            if($mise_a_jourNiveau==$i){echo 'selected';}
                            echo '>niveau '.$i.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="profile-btns-container">
                    <button type="submit" id="submit" name = "submit" class="btn-primary modifierProfile-btn">Mettre à jour
                    </button>
                    <button class="btn btn-danger profile-annuler-btn"><a href="afficheradmins.php">Annuler</a></button>
                </div>
            </form>
        </div>
    </div>
    <script src="./nav_ajouter.js"></script>
</body>
</html>