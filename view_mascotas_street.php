<?php
include("dbconnection.php");
$con=dbconnection();

$query = "SELECT imagen_mascota.*, mascotas_calle.*, refugios.*, usuarios.*, telefono_refugios.telefono_refugio,  telefono_refugios.telefono_refugio_dos, telefono_refugios.telefono_refugio_tres, direccion_refugio.*
          FROM imagen_mascota
          LEFT JOIN mascotas_calle ON imagen_mascota.id_mascota_calle_fk = mascotas_calle.id_mascota_calle
          LEFT JOIN refugios ON mascotas_calle.id_refugio_fk = refugios.id_refugio
          LEFT JOIN usuarios ON mascotas_calle.id_usuario_fk = usuarios.id
          LEFT JOIN telefono_refugios ON refugios.id_refugio = telefono_refugios.id_refugio_fk
          LEFT JOIN direccion_refugio ON refugios.id_refugio = direccion_refugio.id_refugio_fk
          WHERE imagen_mascota.id_mascota_calle_fk IS NOT NULL";
          

$conditions = [];

if (!empty($_GET['tipo'])) {
    $conditions[] = "mascotas_calle.tipo_mascota_calle = '{$_GET['tipo']}'";
}

if (!empty($_GET['raza'])) {
    $conditions[] = "mascotas_calle.raza_mascota_calle = '{$_GET['raza']}'";
}

if (!empty($_GET['sexo'])) {
    $conditions[] = "mascotas_calle.sexo_mascota_calle = '{$_GET['sexo']}'";
}

if (!empty($_GET['tamano'])) {
    $conditions[] = "mascotas_calle.tamano_mascota_calle = '{$_GET['tamano']}'";
}

if (!empty($_GET['ciudad'])) {
    $conditions[] = "mascotas_calle.id_ciudad_fk = {$_GET['ciudad']}";
}

if (!empty($conditions)) {
    $query .= " AND " . implode(" AND ", $conditions);
}

$query .= " ORDER BY mascotas_calle.id_mascota_calle DESC";

$result = mysqli_query($con, $query);

if ($result) {
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    echo json_encode($response); 
} else {
    echo json_encode(array("error" => "Error al obtener datos de mascotas en calle, refugios, teléfonos y direcciones."));
}
mysqli_close($con);
?>