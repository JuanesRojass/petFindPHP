<?php
include("dbconnection.php");
$con = dbconnection();

$idRefugio = $_GET['idRefugio'];

$query = "SELECT 
    ma.`id_mascota_adp`,
    ma.`nombre_mascota_adp`,
    ma.`raza_mascota_adp`,
    ma.`tamano_mascota_adp`,
    ma.`edad_mascota_adp`,
    ma.`color_mascota_adp`,
    ma.`desc_mascota_adp`,
    ma.`salud_mascota_adp`,
    ma.`sexo_mascota_adp`,
    ma.`tipo_mascota_adp`,
    ma.`id_refugio_fk`,
    ma.`id_tipo_mascota_fk`,
    ma.`id_raza_fk`,
    im.`imagen_mascota`,
    im.`imagen_mascota_dos`,
    im.`imagen_mascota_tres`
FROM 
    `mascotas_adopcion` as ma
LEFT JOIN 
    `imagen_mascota` as im
ON 
    ma.`id_mascota_adp` = im.`id_mascota_adp_fk`
WHERE 
    ma.`id_refugio_fk` = $idRefugio";

$result = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}

echo json_encode($arr);

mysqli_close($con);
?>