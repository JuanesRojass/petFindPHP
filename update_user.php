<?php
include("dbconnection.php");
$con = dbconnection();

$idCliente = $_GET['idCliente'];
$username = $_GET['username'];
$telefono = $_GET['telefono'];

if (empty($idCliente)) {
    echo json_encode(array("message" => "El ID del cliente está vacío"));
    exit;
}

$sql = "UPDATE `usuarios` SET ";

if (!empty($username)) {
    $sql .= "`username`='$username', ";
}

if (!empty($telefono)) {
    $sql .= "`telefono_usuario`='$telefono', ";
}

$sql = rtrim($sql, ", ");

$sql .= " WHERE `id`='$idCliente'";

if ($con->query($sql) === TRUE) {
    echo json_encode(array("message" => "Los datos se actualizaron correctamente"));
} else {
    echo json_encode(array("message" => "Error al actualizar los datos: " . $con->error));
}

$con->close();
?>