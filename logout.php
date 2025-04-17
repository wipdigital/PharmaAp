<?php
    session_start();

    //suppression de toutes les variables de session
    $_SESSION =  array();

    //pour detruire completement la session on supprime également
    //le cookie de session
    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
    );
    }

    //enfin destruction de la session
    session_destroy();

    //redirection vers la page de connection

    header("location: index.php");
    exit;
?>