<?php
include("dbconnection.php");
$con=dbconnection();

//obtengo ID ciudad
$idCiudad = isset($_GET['idCiudad']) ? $_GET['idCiudad'] : 0;

$query="SELECT `id_barrio`, `nombre_barrio` FROM `barrios` WHERE `id_ciudad_fk` = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $idCiudad);
$stmt->execute();
$result = $stmt->get_result();

$barrios = [];

while($row = $result->fetch_assoc()){
    $barrios[] = $row;
}

echo json_encode($barrios);
?>