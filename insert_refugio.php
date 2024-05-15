<?php
    include("dbconnection.php");
    $con=dbconnection();

    if(isset($_POST["nombre_refugio"]))
    {
        $nombre_refugio=$_POST["nombre_refugio"];
    }
    else return;

    if(isset($_POST["email_refugio"]))
    {
        $email_refugio=$_POST["email_refugio"];
    }
    else return;

    if(isset($_POST["password_refugio"]))
    {
        $password_refugio=md5($_POST["password_refugio"]);
    }
    else return;

    if(isset($_POST["telefono_refugio"]))
    {
        $telefono_refugio=$_POST["telefono_refugio"];
    }
    else return;

    if(isset($_POST["desc_refugio"]))
    {
        $desc_refugio=$_POST["desc_refugio"];
    }
    else return;

    if(isset($_POST["mision_refugio"]))
    {
        $mision_refugio=$_POST["mision_refugio"];
    }
    else return;

    if(isset($_POST["ciudad_refugio"]))
    {
        $ciudad_refugio=$_POST["ciudad_refugio"];
    }
    else return;

    if(isset($_POST["barrio_refugio"]))
    {
        $barrio_refugio=$_POST["barrio_refugio"];
    }
    else return;

    if(isset($_POST["direccion_refugioo"]))
    {
        $direccion_refugioo=$_POST["direccion_refugioo"];
    }
    else return;

    if(isset($_POST["estado_refugio"]))
    {
        $estado_refugio=$_POST["estado_refugio"];
    }
    else return;

    $queryCiudad = "SELECT nombre_ciudad FROM ciudad WHERE id_ciudad = '$ciudad_refugio'";
    $resultCiudad = mysqli_query($con, $queryCiudad);

    if($rowCiudad = mysqli_fetch_assoc($resultCiudad)){
        $nombreCiudad = $rowCiudad['nombre_ciudad'];
    }

    $queryBarrio = "SELECT nombre_barrio FROM barrios WHERE id_barrio = '$barrio_refugio'";
    $resultBarrio = mysqli_query($con, $queryBarrio);

    if($rowBarrio = mysqli_fetch_assoc($resultBarrio)){
        $nombreBarrio = $rowBarrio['nombre_barrio'];
    }
    
    

    $queryRefugios = "INSERT INTO `refugios` (`nombre_refugio`, `email_refugio`, `password_refugio`, `desc_refugio`, `mision_refugio`, `id_ciudad_fk`, `id_estado_refugio_fk`) 
    VALUES ('$nombre_refugio','$email_refugio','$password_refugio','$desc_refugio','$mision_refugio','$ciudad_refugio','$estado_refugio')";
    $exeRefugios=mysqli_query($con, $queryRefugios);
    // $stmt = $con->prepare($queryRefugios);
    // $stmt->bind_param("sssssi", $nombreRefugio, $emailRefugio, $passwordRefugio, $descriptionRefugio, $misionRefugio, $ciudadRefugio);
    // $resultadosRefugios = $stmt->execute();

    if($exeRefugios){
        // $idRefugio = $con->insert_id;
        $idRefugio = $con->insert_id;
    }

    $queryDireccion = "INSERT INTO `direccion_refugio` (`ciudad_refugio`, `barrio_refugio`, `direccion_refugio`, `id_refugio_fk`) 
    VALUES ('$nombreCiudad','$nombreBarrio','$direccion_refugioo','$idRefugio')";
    $exeDireccion=mysqli_query($con, $queryDireccion);
    // $stmt = $con->prepare($queryDireccion);
    // $stmt->bind_param("sssi", $ciudadRefugio, $barrioRefugio, $direccionRefugio, $idRefugio);
    // $resultadosDireccion = $stmt->execute();


    $queryTelefono = "INSERT INTO `telefono_refugios` (`telefono_refugio`, `telefono_refugio_dos`, `telefono_refugio_tres`, `id_refugio_fk`)
    VALUES ('$telefono_refugio', NULL, NULL, '$idRefugio')";
    $exeTelefono=mysqli_query($con, $queryTelefono);
    // $stmt = $con->prepare($queryTelefono);
    // $stmt->bind_param("si", $telefonoRefugio, $idRefugio);
    // $resultadosTelefono = $stmt->execute();

    if ($exeRefugios && $exeDireccion && $exeTelefono) {
        $response = array("success" => true, "message" => "Insertado con éxito en ambas tablas");
        echo json_encode($response);
    } else {
        $response = array("success" => false, "message" => "Error al insertar en direccion_refugio");
        echo json_encode($response);
    }
        

?>
