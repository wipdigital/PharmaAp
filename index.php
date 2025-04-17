<?php
    include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body class="index-body">
    <div class="index-page">
        <div class="login-header">
            <a href="#" class="login-head"><h1>Connectez-vous pour acceder à la pharmacie</h1></a>
        </div>
        <div class="login-header">
            <a href="#" class="login-head">😊[Email: add6@gmail.com; Password: add6@@@]</a>
        </div>
        <div class="form-container">
            <form method="post">
                <?php
                    if(isset($_POST['btncontinue'])){
                        header('location: afficherstock.php');
                    }
                    if(isset($_POST['submit'])){
                        $email=$_POST['email'];
                        $mot_de_passe=$_POST['mot_de_passe'];
    
                        if($email!="" && $mot_de_passe!=""){
                            $sql = "Select adminID,niveau from `admins` where email='$email' and mot_de_passe='$mot_de_passe'";
                            $result = mysqli_query($con, $sql);
                            if($result){
                                if($result->num_rows != 0){
                                    $row = mysqli_fetch_assoc($result);
                                    $adminID = $row['adminID'];
                                    $niveau = $row['niveau'];
                                    session_start();
                                    $_SESSION['adminID'] = $adminID;
                                    $_SESSION['niveau'] = $niveau;
                                    header('location: afficherstock.php');
                                } else {
                                    echo '<p style="color:red;">Email ou mot de passe incorrect<p>';
                                }
        
                            }else {
                                die(mysqli_error($con));
                            }
        
                        } else {
                            echo '<p style="color:red;">Veillez remplir tous les champs<p>';
                        }
                    }
                 ?>
                <div class="fd">
                    <label for="email" class="fl">Adresse email</label>
                    <input type="text" class="fc" id="email" name="email">
                </div>
                
                <div class="fd">
                    <label for="mot_de_passe" class="fl">Mot de passe</label>
                    <input type="password" class="fc" id="mot_de_passe" name="mot_de_passe">
                </div>

                <div class="btn-container">
                    <button type="submit" class="fb go-btn" name="submit">Se connecter</button>
                    <button type="submit" class="btn-continue fb" name="btncontinue">Continuer sans se connecter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>