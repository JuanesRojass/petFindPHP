<?php
include("dbconnection.php");
$con=dbconnection();

$id = $_GET['id'];

$query = "SELECT `id`, `username`, `password`, `email`, `telefono_usuario`, `rol` FROM `usuarios` WHERE `id` = $id";

$exe=mysqli_query($con,$query);

$arr=[];

while($row=mysqli_fetch_array($exe))
{
    $arr[]=$row;
}

print(json_encode($arr));

?>