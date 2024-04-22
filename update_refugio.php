<?php
include("dbconnection.php");
$con = dbconnection();

$idRefugio = $_GET['idRefugio'];
$nombreRefugio = $_GET['nombreRefugio'];
$telefonoRefugio = $_GET['telefonoRefugio'];
$telefonoRefugioDos = $_GET['telefonoRefugioDos'];
$telefonoRefugioTres = $_GET['telefonoRefugioTres'];
$desRefugio = $_GET['desRefugio'];
$misionRefugio = $_GET['misionRefugio'];
$ciudadRefugio = $_GET['ciudadRefugio'];
$barrioRefugio = $_GET['barrioRefugio'];
$dirRefugio = $_GET['dirRefugio'];

if (empty($idRefugio)) {
    echo json_encode(array("message" => "El ID del refugio está vacío"));
    exit;
}

mysqli_autocommit($con, false);

try {
    // Actualizar datos de la tabla refugios
    $sqlRefugio = "UPDATE `refugios` SET ";
    if (!empty($nombreRefugio)) {
        $sqlRefugio .= "`nombre_refugio`='$nombreRefugio', ";
    }
    if (!empty($desRefugio)) {
        $sqlRefugio .= "`desc_refugio`='$desRefugio', ";
    }
    if (!empty($misionRefugio)) {
        $sqlRefugio .= "`mision_refugio`='$misionRefugio', ";
    }
    $sqlRefugio = rtrim($sqlRefugio, ", ");
    $sqlRefugio .= " WHERE `id_refugio`='$idRefugio'";
    mysqli_query($con, $sqlRefugio);
    mysqli_commit($con);
} catch (Exception $e) {
    mysqli_rollback($con);
    echo json_encode(array("message" => "Error al actualizar los datos de refugios: " . $e->getMessage()));
}

try {
    // Actualizar datos de la tabla telefono_refugios
    $sqlTelefono = "UPDATE `telefono_refugios` SET ";
    if (!empty($telefonoRefugio)) {
        $sqlTelefono .= "`telefono_refugio`='$telefonoRefugio', ";
    }
    if (!empty($telefonoRefugioDos)) {
        $sqlTelefono .= "`telefono_refugio_dos`='$telefonoRefugioDos', ";
    }
    if (!empty($telefonoRefugioTres)) {
        $sqlTelefono .= "`telefono_refugio_tres`='$telefonoRefugioTres' ";
    }
    $sqlTelefono = rtrim($sqlTelefono, ", ");
    $sqlTelefono .= " WHERE `id_refugio_fk`='$idRefugio'";
    mysqli_query($con, $sqlTelefono);
    mysqli_commit($con);
} catch (Exception $e) {
    mysqli_rollback($con);
    echo json_encode(array("message" => "Error al actualizar los datos de telefono_refugios: " . $e->getMessage()));
}



try {
    // Actualizar datos de la tabla direccion_refugios
    $sqlDireccion = "UPDATE `direccion_refugio` SET ";
    if (!empty($ciudadRefugio)) {
        $sqlDireccion .= "`ciudad_refugio`='$ciudadRefugio', ";
    }
    if (!empty($barrioRefugio)) {
        $sqlDireccion .= "`barrio_refugio`='$barrioRefugio', ";
    }
    if (!empty($dirRefugio)) {
        $sqlDireccion .= "`direccion_refugio`='$dirRefugio', ";
    }
    $sqlDireccion = rtrim($sqlDireccion, ", ");
    $sqlDireccion .= " WHERE `id_refugio_fk`='$idRefugio'";
    mysqli_query($con, $sqlDireccion);
    mysqli_commit($con);
} catch (Exception $e) {
    mysqli_rollback($con);
    echo json_encode(array("message" => "Error al actualizar los datos de telefono_refugios: " . $e->getMessage()));
}

mysqli_close($con);
echo json_encode(array("message" => "Los datos se actualizaron correctamente"));
?>