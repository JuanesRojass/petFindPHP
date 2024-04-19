<?php
include("dbconnection.php");
$con=dbconnection();

$query = "SELECT imagen_mascota.id_imagen_mascota,
                 imagen_mascota.imagen_mascota,
                 imagen_mascota.imagen_mascota_dos,
                 imagen_mascota.imagen_mascota_tres,
                 mascotas_perdidas.*,
                 usuarios.*
          FROM imagen_mascota
          INNER JOIN mascotas_perdidas ON imagen_mascota.id_mascota_lost_fk = mascotas_perdidas.id_mascota_lost
          INNER JOIN usuarios ON mascotas_perdidas.id_cliente_fk = usuarios.id
          WHERE usuarios.id IS NOT NULL";

$conditions = [];

if (!empty($_GET['tipo'])) {
    $conditions[] = "mascotas_perdidas.tipo_mascota_lost = '{$_GET['tipo']}'";
}

if (!empty($_GET['raza'])) {
    $conditions[] = "mascotas_perdidas.raza_mascota_lost = '{$_GET['raza']}'";
}

if (!empty($_GET['sexo'])) {
    $conditions[] = "mascotas_perdidas.sexo_mascota_lost = '{$_GET['sexo']}'";
}

if (!empty($_GET['tamano'])) {
    $conditions[] = "mascotas_perdidas.tamano_mascota_lost = '{$_GET['tamano']}'";
}

if (!empty($_GET['ciudad'])) {
    $conditions[] = "mascotas_perdidas.id_ciudad_fk = {$_GET['ciudad']}";
}

if (!empty($conditions)) {
    $query .= " AND " . implode(" AND ", $conditions);
}

$result = mysqli_query($con, $query);

if ($result) {
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    echo json_encode($response); 
} else {
    echo json_encode(array("error" => "Error al obtener datos de mascotas perdidas, refugios, teléfonos y direcciones."));
}
mysqli_close($con);
?>