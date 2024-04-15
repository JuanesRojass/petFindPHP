<?php
include("dbconnection.php");
$con=dbconnection();

$query="SELECT `id_tipo_mascota`, `nombre_tipo_mascota` FROM `tipo_mascota`";

$result=mysqli_query($con,$query);

$tipos=[];

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $tipos[] = $row;
    }
    echo json_encode($tipos);
} else {
    echo "0 resultados";
}

?>