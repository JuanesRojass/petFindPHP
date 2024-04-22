<?php
include("dbconnection.php");
$con = dbconnection();

$idCliente = $_GET['idCliente'];

$query = "SELECT 
    mc.`id_mascota_calle`,
    mc.`tipo_mascota_calle`,
    mc.`color_mascota_calle`,
    mc.`raza_mascota_calle`,
    mc.`tamano_mascota_calle`,
    mc.`ciudad_mascota_calle`,
    mc.`barrio_mascota_calle`,
    mc.`direccion_mascota_calle`,
    mc.`desc_mascota_calle`,
    mc.`sexo_mascota_calle`,
    mc.`id_usuario_fk`,
    mc.`id_refugio_fk`,
    mc.`id_ciudad_fk`,
    mc.`id_tipo_mascota_fk`,
    mc.`id_raza_fk`,
    im.`imagen_mascota`,
    im.`imagen_mascota_dos`,
    im.`imagen_mascota_tres`
FROM 
    `mascotas_calle` as mc
LEFT JOIN 
    `imagen_mascota` as im
ON 
    mc.`id_mascota_calle` = im.`id_mascota_calle_fk`
WHERE 
    mc.`id_usuario_fk` = $idCliente";

$result = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}

echo json_encode($arr);

mysqli_close($con);
?>