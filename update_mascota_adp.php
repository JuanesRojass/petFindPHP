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
$edadMascota = $_GET['edadMascota'];
$descMascota = $_GET['descMascota'];
$ciudadMascota = $_GET['ciudadMascota'];
$barrioMascota = $_GET['barrioMascota'];
$dirMascota = $_GET['dirMascota'];

if (empty($idMascota)) {
    echo json_encode(array("message" => "El ID de la mascota está vacío"));
    exit;
}

$sql = "UPDATE `mascotas_adopcion` SET ";

if (!empty($nombreMascota)) {
    $sql .= "`nombre_mascota_adp`='$nombreMascota', ";
}

if (!empty($tipoMascota)) {
    $sql .= "`tipo_mascota_adp`='$tipoMascota', ";
}

if (!empty($razaMascota)) {
    $sql .= "`raza_mascota_adp`='$razaMascota', ";
}

if (!empty($sexoMascota)) {
    $sql .= "`sexo_mascota_adp`='$sexoMascota', ";
}

if (!empty($tamanoMascota)) {
    $sql .= "`tamano_mascota_adp`='$tamanoMascota', ";
}

if (!empty($colorMascota)) {
    $sql .= "`color_mascota_adp`='$colorMascota', ";
}

if (!empty($edadMascota)) {
    $sql .= "`edad_mascota_adp`='$edadMascota', ";
}

if (!empty($descMascota)) {
    $sql .= "`desc_mascota_adp`='$descMascota', ";
}

if (!empty($ciudadMascota)) {
    $sql .= "`ciudad_mascota_adp`='$ciudadMascota', ";
}

if (!empty($barrioMascota)) {
    $sql .= "`barrio_mascota_adp`='$barrioMascota', ";
}

if (!empty($dirMascota)) {
    $sql .= "`direccion_mascota_adp`='$dirMascota', ";
}

$sql = rtrim($sql, ", ");

$sql .= " WHERE `id_mascota_adp`='$idMascota'";

if ($con->query($sql) === TRUE) {
    echo json_encode(array("message" => "Los datos se actualizaron correctamente"));
} else {
    echo json_encode(array("message" => "Error al actualizar los datos: " . $con->error));
}

$con->close();
?>