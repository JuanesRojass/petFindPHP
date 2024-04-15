<?php

    include("dbconnection.php");
    $con=dbconnection();

    if(isset($_POST["nombre_mascota_adp"]))
    {
        $nombre_mascota_adp=$_POST["nombre_mascota_adp"];
    }
    else return;

    if(isset($_POST["tipo_mascota_adp"]))
    {
        $tipo_mascota_adp=$_POST["tipo_mascota_adp"];
    }
    else return;

    if(isset($_POST["raza_mascota_adp"]))
    {
        $raza_mascota_adp=$_POST["raza_mascota_adp"];
    }
    else return;

    if(isset($_POST["tamano_mascota_adp"]))
    {
        $tamano_mascota_adp=$_POST["tamano_mascota_adp"];
    }
    else return;

    if(isset($_POST["color_mascota_adp"]))
    {
        $color_mascota_adp=$_POST["color_mascota_adp"];
    }
    else return;

    if(isset($_POST["sexo_mascota_adp"]))
    {
        $sexo_mascota_adp=$_POST["sexo_mascota_adp"];
    }
    else return;

    if(isset($_POST["desc_mascota_adp"]))
    {
        $desc_mascota_adp=$_POST["desc_mascota_adp"];
    }
    else return;

    if(isset($_POST["salud_mascota_adp"]))
    {
        $salud_mascota_adp=$_POST["salud_mascota_adp"];
    }
    else return;

    if(isset($_POST["edad_mascota_adp"]))
    {
        $edad_mascota_adp=$_POST["edad_mascota_adp"];
    }
    else return;

    if(isset($_POST["idRefugio"]))
    {
        $idRefugio=$_POST["idRefugio"];
    }
    else return;

    if(isset($_POST["data"]))
    {
        $data=($_POST["data"]);
    }
    else return;
      
    $path = null;
    if(isset($_POST["name"]) && $_POST["name"] !== "") {
        $name = $_POST["name"];
        $path = "upload/$name";
        file_put_contents($path, base64_decode($data));
    }

    if(isset($_POST["data2"]))
    {
        $dataDos=($_POST["data2"]);
    }
    else return;
    
    $pathDos = null;
    if(isset($_POST["name2"]) && $_POST["name2"] !== "") {
        $nameDos = $_POST["name2"];
        $pathDos = "upload/$nameDos";
        file_put_contents($pathDos, base64_decode($dataDos));
    }

    if(isset($_POST["data3"]))
    {
        $dataTres=($_POST["data3"]);
    }
    else return;
    
    $pathTres = null;
    if(isset($_POST["name3"]) && $_POST["name3"] !== "") {
        $nameTres = $_POST["name3"];
        $pathTres = "upload/$nameTres";
        file_put_contents($pathTres, base64_decode($dataTres));
}
    // $queryCiudad = "SELECT nombre_ciudad FROM ciudad WHERE id_ciudad = '$ciudad_mascota_adp'";
    // $resultCiudad = mysqli_query($con, $queryCiudad);

    // if($rowCiudad = mysqli_fetch_assoc($resultCiudad)){
    //     $nombreCiudad = $rowCiudad['nombre_ciudad'];
    // }

    // $queryBarrio = "SELECT nombre_barrio FROM barrios WHERE id_barrio = '$barrio_mascota_lost'";
    // $resultBarrio = mysqli_query($con, $queryBarrio);

    // if($rowBarrio = mysqli_fetch_assoc($resultBarrio)){
    //     $nombreBarrio = $rowBarrio['nombre_barrio'];
    // }

    $queryTipo = "SELECT nombre_tipo_mascota FROM tipo_mascota WHERE id_tipo_mascota = '$tipo_mascota_adp'";
    $resultTipo = mysqli_query($con, $queryTipo);

    if($rowTipo = mysqli_fetch_assoc($resultTipo)){
        $nombreTipo = $rowTipo['nombre_tipo_mascota'];
    }

    $queryRaza = "SELECT nombre_raza FROM raza WHERE id_raza = '$raza_mascota_adp'";
    $resultRaza = mysqli_query($con, $queryRaza);

    if($rowRaza = mysqli_fetch_assoc($resultRaza)){
        $nombreRaza = $rowRaza['nombre_raza'];
    }

    $queryMascotasAdopcion = "INSERT INTO `mascotas_adopcion`(`nombre_mascota_adp`, `raza_mascota_adp`, `tamano_mascota_adp`, `edad_mascota_adp`, `color_mascota_adp`, `desc_mascota_adp`, `salud_mascota_adp`, `sexo_mascota_adp`, `tipo_mascota_adp`, `id_refugio_fk`, `id_tipo_mascota_fk`, `id_raza_fk`) VALUES ('$nombre_mascota_adp','$nombreRaza','$tamano_mascota_adp','$edad_mascota_adp','$color_mascota_adp','$desc_mascota_adp','$salud_mascota_adp','$sexo_mascota_adp','$nombreTipo','$idRefugio','$tipo_mascota_adp','$raza_mascota_adp')";
        $exeMascotasAdopcion=mysqli_query($con, $queryMascotasAdopcion);

        if($exeMascotasAdopcion){
            // $idRefugio = $con->insert_id;
            $idMascotaAdopcion = $con->insert_id;
        }
               

        $queryImagen = "INSERT INTO `imagen_mascota`(`imagen_mascota`,
         `imagen_mascota_dos`, `imagen_mascota_tres`, `id_mascota_adp_fk`, `id_mascota_lost_fk`,
          `id_mascota_calle_fk`)
          VALUES (?,?,?,?,NULL,NULL)";
            
        
            $stmt = $con->prepare($queryImagen);
                if (!$stmt) {
                    echo "Error preparando la consulta: " . $con->error;
                return;
                }
                // Vincula los parámetros y ejecuta
                $stmt->bind_param("sssi", $path, $pathDos, $pathTres, $idMascotaAdopcion);
                $stmt->execute();

            if ($exeMascotasAdopcion) {
                $response = array("success" => true, "message" => "Insertado con éxito en ambas tablas");
                echo json_encode($response);
            } else {
                $response = array("success" => false, "message" => "Error al insertar en mascotas_adoptadas");
                echo json_encode($response);
            }
?>