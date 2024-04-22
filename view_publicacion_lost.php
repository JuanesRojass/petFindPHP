<?php
include("dbconnection.php");
$con = dbconnection();

$idCliente = $_GET['idCliente'];

$query = "SELECT 
    mp.`id_mascota_lost`,
    mp.`nombre_mascota_lost`,
    mp.`raza_mascota_lost`,
    mp.`color_mascota_lost`,
    mp.`tamano_mascota_lost`,
    mp.`sexo_mascota_lost`,
    mp.`desc_mascota_lost`,
    mp.`recom_mascota_lost`,
    mp.`tipo_mascota_lost`,
    mp.`ciudad_mascota_lost`,
    mp.`barrio_mascota_lost`,
    mp.`direccion_mascota_lost`,
    mp.`id_cliente_fk`,
    mp.`id_ciudad_fk`,
    mp.`id_tipo_mascota_fk`,
    mp.`id_raza_fk`,
    im.`imagen_mascota`,
    im.`imagen_mascota_dos`,
    im.`imagen_mascota_tres`
FROM 
    `mascotas_perdidas` as mp
LEFT JOIN 
    `imagen_mascota` as im
ON 
    mp.`id_mascota_lost` = im.`id_mascota_lost_fk`
WHERE 
    mp.`id_cliente_fk` = $idCliente";

$result = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}

echo json_encode($arr);

mysqli_close($con);
?>