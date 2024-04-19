<?php
include("dbconnection.php");
$con=dbconnection();

// if(isset($_POST["tipo"]))
// {
//     $tipo=$_POST["tipo"];
// }
// else return;

// if(isset($_POST["raza"]))
// {
//     $raza=$_POST["raza"];
// }
// else return;

// $queryTipo = "SELECT nombre_tipo_mascota FROM tipo_mascota WHERE id_tipo_mascota = '$tipo'";
//     $resultTipo = mysqli_query($con, $queryTipo);

//     if($rowTipo = mysqli_fetch_assoc($resultTipo)){
//         $nombreTipo = $rowTipo['nombre_tipo_mascota'];
//     }else{
//         $nombreTipo = null;
//     }

// $queryRaza = "SELECT nombre_raza FROM raza WHERE id_raza = '$raza'";
//     $resultRaza = mysqli_query($con, $queryRaza);

//     if($rowRaza = mysqli_fetch_assoc($resultRaza)){
//         $nombreRaza = $rowRaza['nombre_raza'];
//     }else{
//         $nombreRaza = null;
//     }

$query = "SELECT mascotas_adopcion.*, imagen_mascota.imagen_mascota, imagen_mascota.imagen_mascota_dos, imagen_mascota.imagen_mascota_tres, refugios.*, telefono_refugios.telefono_refugio,  telefono_refugios.telefono_refugio_dos, telefono_refugios.telefono_refugio_tres, direccion_refugio.*
          FROM mascotas_adopcion
          INNER JOIN imagen_mascota ON mascotas_adopcion.id_mascota_adp = imagen_mascota.id_mascota_adp_fk
          INNER JOIN refugios ON mascotas_adopcion.id_refugio_fk = refugios.id_refugio
          LEFT JOIN telefono_refugios ON refugios.id_refugio = telefono_refugios.id_refugio_fk
          LEFT JOIN direccion_refugio ON refugios.id_refugio = direccion_refugio.id_refugio_fk
          WHERE imagen_mascota.id_mascota_adp_fk IS NOT NULL";

$conditions = [];

if (!empty($_GET['tipo'])) {
    $conditions[] = "mascotas_adopcion.tipo_mascota_adp = '{$_GET['tipo']}'";
}

if (!empty($_GET['raza'])) {
    $conditions[] = "mascotas_adopcion.raza_mascota_adp = '{$_GET['raza']}'";
}

if (!empty($_GET['sexo'])) {
    $conditions[] = "mascotas_adopcion.sexo_mascota_adp = '{$_GET['sexo']}'";
}

if (!empty($_GET['tamano'])) {
    $conditions[] = "mascotas_adopcion.tamano_mascota_adp = '{$_GET['tamano']}'";
}

if (!empty($_GET['edad'])) {
    $conditions[] = "mascotas_adopcion.edad_mascota_adp = {$_GET['edad']}";
}

if (!empty($_GET['ciudad'])) {
    $conditions[] = "refugios.id_ciudad_fk = {$_GET['ciudad']}";
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
    echo json_encode(array("error" => "Error al obtener datos de mascotas en adopción, refugios, teléfonos y direcciones."));
}
mysqli_close($con);
?>