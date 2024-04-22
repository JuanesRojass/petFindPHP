<?php
include("dbconnection.php");
$con = dbconnection();

$idMascota = $_GET['idMascota'];
$nombreMascota = $_GET['nombreMascota'];
$tipoMascota = $_GET['tipoMascota'];
$razaMascota = $_GET['razaMascota'];
$sexoMascota = $_GET['sexoMascota'];
$tamanoMascota = $_GET['tamanoMascota'];
$colorMascota = $_GET['colorMascota'];
$recomMascota = $_GET['recomMascota'];
$descMascota = $_GET['descMascota'];
$ciudadMascota = $_GET['ciudadMascota'];
$barrioMascota = $_GET['barrioMascota'];
$dirMascota = $_GET['dirMascota'];

if (empty($idMascota)) {
    echo json_encode(array("message" => "El ID de la mascota está vacío"));
    exit;
}

$sql = "UPDATE `mascotas_perdidas` SET ";

if (!empty($nombreMascota)) {
    $sql .= "`nombre_mascota_lost`='$nombreMascota', ";
}

if (!empty($tipoMascota)) {
    $sql .= "`tipo_mascota_lost`='$tipoMascota', ";
}

if (!empty($razaMascota)) {
    $sql .= "`raza_mascota_lost`='$razaMascota', ";
}

if (!empty($sexoMascota)) {
    $sql .= "`sexo_mascota_lost`='$sexoMascota', ";
}

if (!empty($tamanoMascota)) {
    $sql .= "`tamano_mascota_lost`='$tamanoMascota', ";
}

if (!empty($colorMascota)) {
    $sql .= "`color_mascota_lost`='$colorMascota', ";
}

if (!empty($recomMascota)) {
    $sql .= "`recom_mascota_lost`='$recomMascota', ";
}

if (!empty($descMascota)) {
    $sql .= "`desc_mascota_lost`='$descMascota', ";
}

if (!empty($ciudadMascota)) {
    $sql .= "`ciudad_mascota_lost`='$ciudadMascota', ";
}

if (!empty($barrioMascota)) {
    $sql .= "`barrio_mascota_lost`='$barrioMascota', ";
}

if (!empty($dirMascota)) {
    $sql .= "`direccion_mascota_lost`='$dirMascota', ";
}

$sql = rtrim($sql, ", ");

$sql .= " WHERE `id_mascota_lost`='$idMascota'";

if ($con->query($sql) === TRUE) {
    echo json_encode(array("message" => "Los datos se actualizaron correctamente"));
} else {
    echo json_encode(array("message" => "Error al actualizar los datos: " . $con->error));
}

$con->close();
?>