<?php

    include 'dbconnection.php';
    $con=dbconnection();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $consultar=$con->query("SELECT * FROM usuarios WHERE email='".$email."' and password='".md5($password)."'");

    $resultado=array();

    while($extraerDatos=$consultar->fetch_assoc()){
        $resultado[]=$extraerDatos;
    }

    echo json_encode($resultado);

    

?>


