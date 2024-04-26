<?php
include("dbconnection.php");
$con = dbconnection();


$idRefugio = $_POST['idRefugio'];
$idEstado = $_POST['idEstado'];


$query = "UPDATE refugios SET id_estado_refugio_fk = ? WHERE id_refugio = ?";


$stmt = mysqli_prepare($con, $query);
if ($stmt === false) {
    echo json_encode(array("error" => "Error preparando la consulta: " . mysqli_error($con)));
    exit;
}


mysqli_stmt_bind_param($stmt, "ii", $idEstado, $idRefugio);


$execute = mysqli_stmt_execute($stmt);
if ($execute) {
    echo json_encode(array("success" => "Estado del refugio actualizado correctamente."));
} else {
    echo json_encode(array("error" => "Error al actualizar el estado del refugio: " . mysqli_stmt_error($stmt)));
}


mysqli_stmt_close($stmt);
mysqli_close($con);
?>