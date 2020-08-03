<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo integral GLF</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="/TrabInteg/assets/styles.css">
<body>
    
  <!--Navvar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
        <a class="navbar-brand"  href="/TrabInteg"><img src="https://static-s.aa-cdn.net/img/gp/20600011146013/Ht1Wa_JFJI9zJtrQTmB9pe3sPFnKJz8tHKF_GXSo4KBoTsHrD_eKDwqlkvaQqSS85mw=s300?v=1" width="70" height="65" alt="Logo utem"> Trabajo Integral GLF</a>
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
      <div class="card card-body ancho-ct contenedor">
        <?php
        // Realizamos la conexión con el servidor

          $conexion = mysqli_connect('localhost', 'root', '');

          $sql ="CREATE DATABASE TrabajoIntegralGLF";

          if($conexion->query($sql) === true){
          
            echo "Base de datos creada.";

            echo'<form action="exportar.php" method="POST">
                    <input type="hidden" name="nombrearchivo" value="'.$_POST['nombrearchivo'].'">                        
                    <button id="btn_enviar" type="submit"  class="btn btn-sm btn-primary">Exportar a BD.</button>
                  </form>';
          }
          else{

            if($conexion->error=="Can't create database 'trabajointegralglf'; database exists")
            {
              echo'<form action="exportar.php" method="POST">
                    <input class="text-center" type="hidden" name="nombrearchivo" value="'.$_POST['nombrearchivo'].'">
                    La base de datos ya está creada<br>                        
                    <button id="btn_enviar" type="submit"  class="btn btn-secondary centrar-btn">Continuar</button>
                  </form>';
            }
          }
        
        


        
        ?>
      </div>

</body>