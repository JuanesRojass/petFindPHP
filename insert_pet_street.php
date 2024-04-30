<?php

    include("dbconnection.php");
    $con=dbconnection();

    if(isset($_POST["tipo_mascota_street"]))
    {
        $tipo_mascota_street=$_POST["tipo_mascota_street"];
    }
    else return;

    if(isset($_POST["raza_mascota_street"]))
    {
        $raza_mascota_street=$_POST["raza_mascota_street"];
    }
    else return;

    if(isset($_POST["color_mascota_street"]))
    {
        $color_mascota_street=$_POST["color_mascota_street"];
    }
    else return;

    if(isset($_POST["tamano_mascota_street"]))
    {
        $tamano_mascota_street=$_POST["tamano_mascota_street"];
    }
    else return;

    if(isset($_POST["sexo_mascota_street"]))
    {
        $sexo_mascota_street=$_POST["sexo_mascota_street"];
    }
    else return;

    if(isset($_POST["desc_mascota_street"]))
    {
        $desc_mascota_street=$_POST["desc_mascota_street"];
    }
    else return;


    if(isset($_POST["ciudad_mascota_street"]))
    {
        $ciudad_mascota_street=$_POST["ciudad_mascota_street"];
    }
    else return;


    if(isset($_POST["barrio_mascota_street"]))
    {
        $barrio_mascota_street=$_POST["barrio_mascota_street"];
    }
    else return;


    if(isset($_POST["direccion_mascota_street"]))
    {
        $direccion_mascota_street=$_POST["direccion_mascota_street"];
    }
    else return;

    $ubicacion_mascota_street = isset($_POST["ubicacion_mascota_street"]) &&
     $_POST["ubicacion_mascota_street"] !== "" ? $_POST["ubicacion_mascota_street"] : NULL;

    if(isset($_POST["idUsuario"]))
    {
        $idUsuario=$_POST["idUsuario"];
    }
    else return;

    if(isset($_POST["nombreRol"]))
    {
        $nombreRol=$_POST["nombreRol"];
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

    $idRefugio = NULL;
    $idCliente = NULL;

    if ($nombreRol == "Refugio") {
        $idRefugio = $idUsuario;
    } elseif ($nombreRol == "Cliente") {
        $idCliente = $idUsuario;
    }

    $queryCiudad = "SELECT nombre_ciudad FROM ciudad WHERE id_ciudad = '$ciudad_mascota_street'";
    $resultCiudad = mysqli_query($con, $queryCiudad);

    if($rowCiudad = mysqli_fetch_assoc($resultCiudad)){
        $nombreCiudad = $rowCiudad['nombre_ciudad'];
    }

    $queryBarrio = "SELECT nombre_barrio FROM barrios WHERE id_barrio = '$barrio_mascota_street'";
    $resultBarrio = mysqli_query($con, $queryBarrio);

    if($rowBarrio = mysqli_fetch_assoc($resultBarrio)){
        $nombreBarrio = $rowBarrio['nombre_barrio'];
    }

    $queryTipo = "SELECT nombre_tipo_mascota FROM tipo_mascota WHERE id_tipo_mascota = '$tipo_mascota_street'";
    $resultTipo = mysqli_query($con, $queryTipo);

    if($rowTipo = mysqli_fetch_assoc($resultTipo)){
        $nombreTipo = $rowTipo['nombre_tipo_mascota'];
    }

    $queryRaza = "SELECT nombre_raza FROM raza WHERE id_raza = '$raza_mascota_street'";
    $resultRaza = mysqli_query($con, $queryRaza);

    if($rowRaza = mysqli_fetch_assoc($resultRaza)){
        $nombreRaza = $rowRaza['nombre_raza'];
    }

    $queryMascotasCalle = "INSERT INTO `mascotas_calle`(
        `tipo_mascota_calle`, `color_mascota_calle`, `raza_mascota_calle`, 
        `tamano_mascota_calle`, `ciudad_mascota_calle`, `barrio_mascota_calle`,
        `direccion_mascota_calle`, `ubicacion_mascota_calle`, `desc_mascota_calle`, `sexo_mascota_calle`, 
        `id_usuario_fk`, `id_refugio_fk`, `id_ciudad_fk`, `id_tipo_mascota_fk`, `id_raza_fk`)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // $exeMascotasCalle=mysqli_query($con, $queryMascotasCalle);

        $stmtt = $con->prepare($queryMascotasCalle);
                if (!$stmtt) {
                    echo "Error preparando la consulta: " . $con->error;
                return;
                }
                // Vincula los parámetros y ejecuta
                $stmtt->bind_param("ssssssssssiiiii",  $nombreTipo, $color_mascota_street, $nombreRaza, $tamano_mascota_street,
                $nombreCiudad, $nombreBarrio, $direccion_mascota_street, $ubicacion_mascota_street, $desc_mascota_street,
                $sexo_mascota_street, $idCliente, $idRefugio, $ciudad_mascota_street,
                $tipo_mascota_street, $raza_mascota_street);
                
                if($stmtt->execute()){
                    $idMascotaCalle = $con->insert_id;
                    echo "ID insertado con éxito. ID: $idMascotaCalle";
                }else{
                    echo "Error al insertar: " . $stmtt->error;
                }

        // if($exeMascotasCalle){
        //     mysqli_stmt_bind_param($stmt, "sssssssssiiiii",
        //     $color_mascota_street, $nombreTipo, $nombreRaza, $tamano_mascota_street,
        //     $nombreCiudad, $nombreBarrio, $direccion_mascota_street, $desc_mascota_street,
        //     $sexo_mascota_street, $idCliente, $idRefugio, $ciudad_mascota_street,
        //     $tipo_mascota_street, $raza_mascota_street);
        
        // if($stmtt){
        //     // $idRefugio = $con->insert_id;
        //     $idMascotaCalle = $con->insert_id;
        // }
        


        $queryImagen = "INSERT INTO `imagen_mascota`(`imagen_mascota`,
         `imagen_mascota_dos`, `imagen_mascota_tres`, `id_mascota_adp_fk`, `id_mascota_lost_fk`,
          `id_mascota_calle_fk`)
          VALUES (?,?,?,NULL,NULL,?)";
            
        
            $stmt = $con->prepare($queryImagen);
                if (!$stmt) {
                    echo "Error preparando la consulta: " . $con->error;
                return;
                }
                // Vincula los parámetros y ejecuta
                $stmt->bind_param("sssi", $path, $pathDos, $pathTres, $idMascotaCalle);
                $stmt->execute();

            // if ($exeMascotasCalle) {
            //     $response = array("success" => true, "message" => "Insertado con éxito en ambas tablas");
            //     echo json_encode($response);
            // } else {
            //     $response = array("success" => false, "message" => "Error al insertar en mascotas_calle");
            //     echo json_encode($response);
            // }
    
?>