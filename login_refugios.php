<?php

    include 'dbconnection.php';
    $con=dbconnection();

    
    $email = $_POST['email_refugio'];
    $password = $_POST['password_refugio'];

    $consultar=$con->query("SELECT * FROM refugios WHERE email_refugio='".$email."' and password_refugio='".$password."'");

    $resultado=array();

    while($extraerDatos=$consultar->fetch_assoc()){
        $resultado[]=$extraerDatos;
    }

    echo json_encode($resultado);

    

?>