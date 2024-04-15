<?php
include("dbconnection.php");
$con=dbconnection();

$query="SELECT `id_refugio`, `nombre_refugio`, `email_refugio`, `password_refugio`, 
 `desc_refugio`, `mision_refugio`, `id_ciudad_fk`, `id_estado_refugio_fk` FROM `refugios`";

$exe=mysqli_query($con,$query);

$arr=[];

while($row=mysqli_fetch_array($exe))
{
    $arr[]=$row;
}

print(json_encode($arr));

?>