<?php
include("dbconnection.php");
$con=dbconnection();

//obtengo ID ciudad
$idRaza = isset($_GET['idTipo']) ? $_GET['idTipo'] : 0;

$query="SELECT `id_raza`, `nombre_raza` FROM `raza` WHERE `id_tipo_mascota_fk` = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $idRaza);
$stmt->execute();
$result = $stmt->get_result();

$razas = [];

while($row = $result->fetch_assoc()){
    $razas[] = $row;
}

echo json_encode($razas);
?>