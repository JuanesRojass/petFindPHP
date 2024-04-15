<?php

// $connect = new mysqli("localhost","root","","mascotasbga");

function dbconnection()
{
    $con=mysqli_connect("localhost","root","","mascotasbga");
    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }
    return $con;
}
?>