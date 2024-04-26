<?php
include("dbconnection.php");
$con=dbconnection();

$query = "SELECT 
    refugios.*,
    direccion_refugio.ciudad_refugio,
    direccion_refugio.barrio_refugio,
    direccion_refugio.direccion_refugio,
    telefono_refugios.telefono_refugio,
    telefono_refugios.telefono_refugio_dos,
    telefono_refugios.telefono_refugio_tres
    FROM refugios
    LEFT JOIN direccion_refugio ON refugios.id_refugio = direccion_refugio.id_refugio_fk
    LEFT JOIN telefono_refugios ON refugios.id_refugio = telefono_refugios.id_refugio_fk
    WHERE refugios.id_estado_refugio_fk = 2";


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