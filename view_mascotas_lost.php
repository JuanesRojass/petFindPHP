<?php
include("dbconnection.php");
$con=dbconnection();

$query="SELECT `id_mascota_lost`, `nombre_mascota_lost`, `raza_mascota_lost`,
 `color_mascota_lost`, `tamano_mascota_lost`, `sexo_mascota_lost`, `desc_mascota_lost`,
  `recom_mascota_lost`, `tipo_mascota_lost`,`direccion_mascota_lost`,`telefono_mascota_lost`,
    `imagen_mascota_lost`, `id_refugio_fk`, `id_usuario_fk`, `id_ciudad_fk` FROM `mascotas_perdidas`";

$exe=mysqli_query($con,$query);

$arr=[];

while($row=mysqli_fetch_array($exe))
{
    $arr[]=$row;
}

print(json_encode($arr));

?>