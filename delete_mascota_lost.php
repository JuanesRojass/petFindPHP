<?php
include("dbconnection.php");
$con = dbconnection();

$idMascota = $_GET['idMascota'];

if (empty($idMascota)) {
    echo json_encode(array("message" => "El ID de la mascota está vacío"));
    exit;
}

$sql = "DELETE FROM `mascotas_perdidas` WHERE `id_mascota_lost` = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $idMascota);
if ($stmt->execute()) {
    echo json_encode(array("message" => "Mascota eliminada correctamente"));
} else {
    echo json_encode(array("message" => "Error al eliminar la mascota: " . $con->error));
}

$stmt->close();
$con->close();
?>