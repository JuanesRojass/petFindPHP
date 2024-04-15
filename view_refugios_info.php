<?php
include("dbconnection.php");
$con=dbconnection();

//Obtengo id Refugio
// $idRefugio = isset($_GET['idRefugio']) ? $_GET['idRefugio'] : 0;
$idRefugio = $_GET['id_refugio'] ?? 0;

$response = [
    'direcciones' => [],
    'telefonos' => []
];

//Direcciones Refugio
$queryDirecciones = "SELECT `id_direccion_refugio`, `ciudad_refugio`, `barrio_refugio`, `direccion_refugio` FROM `direccion_refugio` WHERE id_refugio_fk = ?";
$stmt = $con->prepare($queryDirecciones);
$stmt->bind_param("i", $idRefugio);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $response['direcciones'][] = $row;
}

//Telefonos Refugio
$queryTelefonos="SELECT `id_telefono_refugio`, `telefono_refugio` FROM `telefono_refugios` WHERE `id_refugio_fk` = ?";
$stmt = $con->prepare($queryTelefonos);
$stmt->bind_param("i", $idRefugio);
$stmt->execute();
$result = $stmt->get_result();

// $telefonos = [];

while($row = $result->fetch_assoc()){
    $response['telefonos'][] = $row;
}

echo json_encode($response);
?>