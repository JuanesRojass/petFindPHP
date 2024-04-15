<?php

    include("dbconnection.php");
    $con=dbconnection();

    if(isset($_POST["username"]))
    {
        $username=$_POST["username"];
    }
    else return;

    if(isset($_POST["password"]))
    {
        $password=md5($_POST["password"]);
    }
    else return;
    
    if(isset($_POST["rol"]))
    {
        $rol=$_POST["rol"];
    }
    else return;

    if(isset($_POST["email"]))
    {
        $email=$_POST["email"];
    }
    else return;

    if(isset($_POST["telefono_usuario"]))
    {
        $telefono=$_POST["telefono_usuario"];
    }
    else return;


    $query="INSERT INTO `usuarios`( `username`, `password`, `rol`, `email`, `telefono_usuario`)
     VALUES ('$username', '$password', '$rol', '$email', '$telefono')";
     $exe=mysqli_query($con, $query);

     $arr=[];
     if($exe)
     {
        $arr["success"]="true";
     }
     else
     {
        $arr["success"]="false";
     }
     print(json_encode($arr));
?>