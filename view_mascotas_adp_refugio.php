<?php
include("dbconnection.php");
$con = dbconnection();

// Obtener el valor de idRefugio
$idRefugio = $_GET['idRefugio'];

// Consulta SQL con condición WHERE para filtrar por id_refugio
$query = "SELECT mascotas_adopcion.*, imagen_mascota.imagen_mascota, imagen_mascota.imagen_mascota_dos, imagen_mascota.imagen_mascota_tres, refugios.*,
             telefono_refugios.telefono_refugio, telefono_refugios.telefono_refugio_dos, telefono_refugios.telefono_refugio_tres, direccion_refugio.*
          FROM mascotas_adopcion
          INNER JOIN imagen_mascota ON mascotas_adopcion.id_mascota_adp = imagen_mascota.id_mascota_adp_fk
          INNER JOIN refugios ON mascotas_adopcion.id_refugio_fk = refugios.id_refugio
          LEFT JOIN telefono_refugios ON refugios.id_refugio = telefono_refugios.id_refugio_fk
          LEFT JOIN direccion_refugio ON refugios.id_refugio = direccion_refugio.id_refugio_fk
          WHERE imagen_mascota.id_mascota_adp_fk IS NOT NULL
          AND mascotas_adopcion.id_refugio_fk = $idRefugio";

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