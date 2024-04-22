<?php
include("dbconnection.php");
$con = dbconnection();

$idMascota = $_GET['idMascota'];
$tipoMascota = $_GET['tipoMascota'];
$razaMascota = $_GET['razaMascota'];
$sexoMascota = $_GET['sexoMascota'];
$tamanoMascota = $_GET['tamanoMascota'];
$colorMascota = $_GET['colorMascota'];
$descMascota = $_GET['descMascota'];
$ciudadMascota = $_GET['ciudadMascota'];
$barrioMascota = $_GET['barrioMascota'];
$dirMascota = $_GET['dirMascota'];

if (empty($idMascota)) {
    echo json_encode(array("message" => "El ID de la mascota está vacío"));
    exit;
}

$sql = "UPDATE `mascotas_calle` SET ";

if (!empty($tipoMascota)) {
    $sql .= "`tipo_mascota_calle`='$tipoMascota', ";
}
if (!empty($razaMascota)) {
    $sql .= "`raza_mascota_calle`='$razaMascota', ";
}
if (!empty($sexoMascota)) {
    $sql .= "`sexo_mascota_calle`='$sexoMascota', ";
}
if (!empty($tamanoMascota)) {
    $sql .= "`tamano_mascota_calle`='$tamanoMascota', ";
}
if (!empty($colorMascota)) {
    $sql .= "`color_mascota_calle`='$colorMascota', ";
}
if (!empty($descMascota)) {
    $sql .= "`desc_mascota_calle`='$descMascota', ";
}
if (!empty($ciudadMascota)) {
    $sql .= "`ciudad_mascota_calle`='$ciudadMascota', ";
}
if (!empty($barrioMascota)) {
    $sql .= "`barrio_mascota_calle`='$barrioMascota', ";
}
if (!empty($dirMascota)) {
    $sql .= "`direccion_mascota_calle`='$dirMascota', ";
}

$sql = rtrim($sql, ", ");

$sql .= " WHERE `id_mascota_calle`='$idMascota'";

if ($con->query($sql) === TRUE) {
    echo json_encode(array("message" => "Los datos se actualizaron correctamente"));
} else {
    echo json_encode(array("message" => "Error al actualizar los datos: " . $con->error));
}

$con->close();
?>