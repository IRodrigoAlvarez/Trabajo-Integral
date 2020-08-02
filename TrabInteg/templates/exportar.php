<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo integral GLF</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="/TrabInteg/assets/styles.css">
</head>
<body>
    
  <!--Navvar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
        <a class="navbar-brand"  href="/TrabInteg"><img src="https://static-s.aa-cdn.net/img/gp/20600011146013/Ht1Wa_JFJI9zJtrQTmB9pe3sPFnKJz8tHKF_GXSo4KBoTsHrD_eKDwqlkvaQqSS85mw=s300?v=1" width="70" height="65"> Trabajo Integral GLF</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav  justify-content-end " id="navbarNav">
          <ul class="nav nav-tabs ">
            <li class="nav-item ">
              <a class="nav-link blanco" href="/TrabInteg">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link blanco" href="/TrabInteg/templates/agregarlocal.php">Agregar un local</a>
            </li>
            <li class="nav-item">
              <a class="nav-link blanco" href="/TrabInteg/templates/about.php">Sobre nosotros</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="card card-body contenedor pl-2 ancho-ct">
       <?php

        $conexion = mysqli_connect('localhost', 'root', '','trabajointegralglf');
  
        $sql9 = "CREATE TABLE datoslocales(
        
          TipoLocal VARCHAR(1), 
          NumeroIdentificador INT NULL,   
          Coordenadas VARCHAR(1000),
          X VARCHAR(100),
          Y VARCHAR(100),
          PRIMARY KEY (NumeroIdentificador)
        
        )";

        if($conexion->query($sql9) === true){
          echo "Tabla creada.<br>";
        }
        else{

          if($conexion->error=="Table 'datoslocales' already exists")
          {}
        }
        $nombrearchivo=$_POST['nombrearchivo'];


        $sql="LOAD DATA INFILE 'C:/xampp/htdocs/TrabInteg/templates/$nombrearchivo'
              INTO TABLE datoslocales
              FIELDS TERMINATED BY ';'
              LINES TERMINATED BY '\n';
              ";
      
        if($conexion->query($sql)===true ){
          echo "Datos exportados correctamente.<br>";
        }else{
          echo "Error en la exportación: ".$conexion->error."<br>";
        }
      
        $sql2="UPDATE datoslocales
                SET 
                 X = SUBSTRING(Coordenadas,1,LOCATE(',',Coordenadas) - 1)

                ";
          $sql3="UPDATE datoslocales
                SET
                Y = SUBSTRING(Coordenadas,LOCATE(',',Coordenadas) + 1)
                ";       

          if($conexion->query($sql2)===true && $conexion->query($sql3)===true){
            echo "Coordenadas separadas correctamente.<br>";
          }else{

            die ("Error en la separación: ".$conexion->error);
          }

        ?>
        <form action="mostrarcentros.php">
          <input class="btn btn-secondary centrar-btn" type="submit" Value="Comenzar recorrido de camiones">
        </form>
      </div>
        

</body>