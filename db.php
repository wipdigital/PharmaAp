<?php
    $con = new mysqli('localhost', 'root', '', 'pharmaciedb');

    if(!$con){
        die(mysqli_error($con));
    }
?>