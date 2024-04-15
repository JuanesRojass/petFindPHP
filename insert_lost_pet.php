<?php
    include("dbconnection.php");
    $con=dbconnection();

    if(isset($_POST["nombre_mascota_lost"]))
    {
        $nombre_mascota_lost=$_POST["nombre_mascota_lost"];
    }
    else return;

    // if(isset($_POST["tipo_mascota_lost"]))
    // {
    //     $tipo_mascota=$_POST["tipo_mascota_lost"];
    // }
    // else return;

    
    
    // if(isset($_POST["raza_mascota_lost"]))
    //     {
    //         $raza_mascota=$_POST["raza_mascota_lost"];
    //     }
    //     else return;

    

    // if(isset($_POST["tamano_mascota_lost"]))
    //     {
    //     $tamano_mascota=$_POST["tamano_mascota_lost"];
    //     }
    //     else return;

    // if(isset($_POST["color_mascota_lost"]))
    //     {
    //         $color_mascota=$_POST["color_mascota_lost"];
    //     }
    //     else return;

    // if(isset($_POST["sexo_mascota_lost"]))
    // {
    //     $sexo_mascota=$_POST["sexo_mascota_lost"];
    // }
    // else return;

    // if(isset($_POST["desc_mascota_lost"]))
    // {
    //     $desc_mascota=$_POST["desc_mascota_lost"];
    // }
    // else return;

    // if(isset($_POST["recom_mascota_lost"]))
    // {
    //     $recom_mascota=$_POST["recom_mascota_lost"];
    // }
    // else return;

    // if(isset($_POST["ciudad_mascota_lost"]))
    // {
    //     $ciudad_mascota=$_POST["ciudad_mascota_lost"];
    // }
    // else return;
    

    

    // if(isset($_POST["barrio_mascota_lost"]))
    // {
    //     $barrio_mascota=$_POST["barrio_mascota_lost"];
    // }
    // else return;
    
    

    // if(isset($_POST["direccion_mascota_lost"]))
    // {
    //     $direccion_mascota=$_POST["direccion_mascota_lost"];
    // }
    // else return;

    // if(isset($_POST["telefono_mascota_lost"]))
    // {
    //     $telefono_mascota=$_POST["telefono_mascota_lost"];
    // }
    // else return;

    // if(isset($_POST["idCliente"]))
    // {
    //     $id_cliente=$_POST["idCliente"];
    // }
    // else return;

    if(isset($_POST["data"]))
    {
        $data=md5($_POST["data"]);
    }
    else return;
    
    if(isset($_POST["name"]))
    {
        $name=$_POST["name"];
    }
    else return;

    

    $queryMascotasPerdidas = "INSERT INTO `mascotas_perdidas`(`nombre_mascota_lost`, `raza_mascota_lost`, `color_mascota_lost`, `tamano_mascota_lost`, `sexo_mascota_lost`, `desc_mascota_lost`, `recom_mascota_lost`, `tipo_mascota_lost`, `ciudad_mascota_lost`, `barrio_mascota_lost`, `direccion_mascota_lost`, `telefono_mascota_lost`, `id_cliente_fk`, `id_ciudad_fk`, `id_tipo_mascota_fk`, `id_raza_fk`) VALUES ('$nombre_mascota_lost','','','','','','','','','','','','','','','')";
        $exeMascotasPerdidas=mysqli_query($con, $queryMascotasPerdidas);

     $arr=[];
     if($exeMascotasPerdidas)
     {
        $arr["success"]="true";
     }
     else
     {
        $arr["success"]="false";
     }
     print(json_encode($arr));
    
    if($exeMascotasPerdidas){
        // $idRefugio = $con->insert_id;
        $idMascotaPerdida = $con->insert_id;
    }

    $queryImagen = "INSERT INTO `imagen_mascota`(`imagen_mascota`,
     `imagen_mascota_dos`, `imagen_mascota_tres`, `id_mascota_adp_fk`, `id_mascota_lost_fk`,
      `id_mascota_calle_fk`) 
      VALUES ('$path','$idMascotaPerdida','$idMascotaPerdida','$idMascotaPerdida','$idMascotaPerdida','$idMascotaPerdida')";
      file_put_contents($path,base64_decode($data));
        $exeImagen=mysqli_query($con, $queryImagen);
    
        
        if ($exeMascotasPerdidas && $exeImagen) {
            $response = array("success" => true, "message" => "Insertado con éxito en ambas tablas");
            echo json_encode($response);
        } else {
            $response = array("success" => false, "message" => "Error al insertar en direccion_refugio");
            echo json_encode($response);
        }
?>