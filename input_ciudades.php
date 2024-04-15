<?php
include("dbconnection.php");
$con=dbconnection();

$query="SELECT `id_ciudad`, `nombre_ciudad` FROM `ciudad`";

$result=mysqli_query($con,$query);

$ciudades=[];

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $ciudades[] = $row;
    }
    echo json_encode($ciudades);
} else {
    echo "0 resultados";
}

?>