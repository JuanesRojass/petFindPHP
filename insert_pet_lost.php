<?php

    include("dbconnection.php");
    $con=dbconnection();

    if(isset($_POST["nombre_mascota_lost"]))
    {
        $nombre_mascota_lost=$_POST["nombre_mascota_lost"];
    }
    else return;

    if(isset($_POST["tipo_mascota_lost"]))
    {
        $tipo_mascota_lost=$_POST["tipo_mascota_lost"];
    }
    else return;

    if(isset($_POST["raza_mascota_lost"]))
    {
        $raza_mascota_lost=$_POST["raza_mascota_lost"];
    }
    else return;

    if(isset($_POST["tamano_mascota_lost"]))
    {
        $tamano_mascota_lost=$_POST["tamano_mascota_lost"];
    }
    else return;

    if(isset($_POST["color_mascota_lost"]))
    {
        $color_mascota_lost=$_POST["color_mascota_lost"];
    }
    else return;

    if(isset($_POST["sexo_mascota_lost"]))
    {
        $sexo_mascota_lost=$_POST["sexo_mascota_lost"];
    }
    else return;

    if(isset($_POST["desc_mascota_lost"]))
    {
        $desc_mascota_lost=$_POST["desc_mascota_lost"];
    }
    else return;

    if(isset($_POST["recom_mascota_lost"]))
    {
        $recom_mascota_lost=$_POST["recom_mascota_lost"];
    }
    else return;

    if(isset($_POST["ciudad_mascota_lost"]))
    {
        $ciudad_mascota_lost=$_POST["ciudad_mascota_lost"];
    }
    else return;


    if(isset($_POST["barrio_mascota_lost"]))
    {
        $barrio_mascota_lost=$_POST["barrio_mascota_lost"];
    }
    else return;


    if(isset($_POST["direccion_mascota_lost"]))
    {
        $direccion_mascota_lost=$_POST["direccion_mascota_lost"];
    }
    else return;

    if(isset($_POST["idCliente"]))
    {
        $idCliente=$_POST["idCliente"];
    }
    else return;

    if(isset($_POST["data"]))
    {
        $data=($_POST["data"]);
    }
    else return;
    
    // if(isset($_POST["name"]))
    // {
    //     $name=$_POST["name"];
    // }
    // else return;
    
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
    
    // if(isset($_POST["name2"]))
    // {
    //     $nameDos=$_POST["name2"];
    // }
    // else return;
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
    
    // if(isset($_POST["name3"]))
    // {
    //     $nameTres=$_POST["name3"];
    // }
    // else return;
    $pathTres = null;
    if(isset($_POST["name3"]) && $_POST["name3"] !== "") {
        $nameTres = $_POST["name3"];
        $pathTres = "upload/$nameTres";
        file_put_contents($pathTres, base64_decode($dataTres));
}
    $queryCiudad = "SELECT nombre_ciudad FROM ciudad WHERE id_ciudad = '$ciudad_mascota_lost'";
    $resultCiudad = mysqli_query($con, $queryCiudad);

    if($rowCiudad = mysqli_fetch_assoc($resultCiudad)){
        $nombreCiudad = $rowCiudad['nombre_ciudad'];
    }

    $queryBarrio = "SELECT nombre_barrio FROM barrios WHERE id_barrio = '$barrio_mascota_lost'";
    $resultBarrio = mysqli_query($con, $queryBarrio);

    if($rowBarrio = mysqli_fetch_assoc($resultBarrio)){
        $nombreBarrio = $rowBarrio['nombre_barrio'];
    }

    $queryTipo = "SELECT nombre_tipo_mascota FROM tipo_mascota WHERE id_tipo_mascota = '$tipo_mascota_lost'";
    $resultTipo = mysqli_query($con, $queryTipo);

    if($rowTipo = mysqli_fetch_assoc($resultTipo)){
        $nombreTipo = $rowTipo['nombre_tipo_mascota'];
    }

    $queryRaza = "SELECT nombre_raza FROM raza WHERE id_raza = '$raza_mascota_lost'";
    $resultRaza = mysqli_query($con, $queryRaza);

    if($rowRaza = mysqli_fetch_assoc($resultRaza)){
        $nombreRaza = $rowRaza['nombre_raza'];
    }

    $queryMascotasPerdidas = "INSERT INTO `mascotas_perdidas`(`nombre_mascota_lost`, `raza_mascota_lost`, `color_mascota_lost`, `tamano_mascota_lost`, `sexo_mascota_lost`, `desc_mascota_lost`, `recom_mascota_lost`, `tipo_mascota_lost`, `ciudad_mascota_lost`, `barrio_mascota_lost`, `direccion_mascota_lost`, `id_cliente_fk`, `id_ciudad_fk`, `id_tipo_mascota_fk`, `id_raza_fk`) VALUES ('$nombre_mascota_lost','$nombreRaza','$color_mascota_lost','$tamano_mascota_lost','$sexo_mascota_lost','$desc_mascota_lost','$recom_mascota_lost','$nombreTipo','$nombreCiudad','$nombreBarrio','$direccion_mascota_lost','$idCliente','$ciudad_mascota_lost','$tipo_mascota_lost','$raza_mascota_lost')";
        $exeMascotasPerdidas=mysqli_query($con, $queryMascotasPerdidas);

        if($exeMascotasPerdidas){
            // $idRefugio = $con->insert_id;
            $idMascotaPerdida = $con->insert_id;
        }
        
        // $path="upload/$name";
        // $pathDos="upload/$nameDos";
        // $pathTres="upload/$nameTres";

        $queryImagen = "INSERT INTO `imagen_mascota`(`imagen_mascota`,
         `imagen_mascota_dos`, `imagen_mascota_tres`, `id_mascota_adp_fk`, `id_mascota_lost_fk`,
          `id_mascota_calle_fk`)
          VALUES (?,?,?,NULL,?,NULL)";
            
        
            $stmt = $con->prepare($queryImagen);
                if (!$stmt) {
                    echo "Error preparando la consulta: " . $con->error;
                return;
                }
                // Vincula los parámetros y ejecuta
                $stmt->bind_param("sssi", $path, $pathDos, $pathTres, $idMascotaPerdida);
                $stmt->execute();

            if ($exeMascotasPerdidas) {
                $response = array("success" => true, "message" => "Insertado con éxito en ambas tablas");
                echo json_encode($response);
            } else {
                $response = array("success" => false, "message" => "Error al insertar en direccion_refugio");
                echo json_encode($response);
            }
?>