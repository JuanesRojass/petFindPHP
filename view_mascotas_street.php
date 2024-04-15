<?php
include("dbconnection.php");
$con=dbconnection();

$query="SELECT `id_mascota_calle`, `color_mascota_calle`, `raza_mascota_calle`,
 `tamano_mascota_calle`, `ubicacion_mascota_calle`, `direccion_mascota_calle`, `telefono_mascota_calle`,
  `desc_mascota_calle`, `imagen_mascota_calle`, `sexo_mascota_calle`,
  `id_usuario_fk`, `id_refugio_fk`, `id_ciudad_fk` FROM `mascotas_calle`";

$exe=mysqli_query($con,$query);

$arr=[];

while($row=mysqli_fetch_array($exe))
{
    $arr[]=$row;
}

print(json_encode($arr));

?>