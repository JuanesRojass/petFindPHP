<?php
include("dbconnection.php");
$con = dbconnection();

$id = $_GET['id'];

$query = "SELECT 
            r.id_refugio, r.nombre_refugio, r.email_refugio, r.password_refugio, r.desc_refugio, r.mision_refugio, 
            r.id_ciudad_fk, r.id_estado_refugio_fk, 
            t.telefono_refugio, t.telefono_refugio_dos, t.telefono_refugio_tres, 
            d.ciudad_refugio, d.barrio_refugio, d.direccion_refugio 
          FROM refugios r
          LEFT JOIN telefono_refugios t ON r.id_refugio = t.id_refugio_fk 
          LEFT JOIN direccion_refugio d ON r.id_refugio = d.id_refugio_fk
          WHERE r.id_refugio = $id";

$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print(json_encode($arr));

mysqli_close($con);
?>