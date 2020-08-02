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
          $ruta="archivos".$_FILES['archivo']['name'];
          if(move_uploaded_file($_FILES['archivo']['tmp_name'],$ruta))
          {
              echo "Contenido en el archivo de texto: ";
              echo "<br>";
          }else{
              echo "Error, el archivo no se pudo subir";
          }
        
          // Abriendo el archivo
          $archivo = fopen("$ruta", "r");
        
          // Recorremos todas las lineas del archivo
          while(!feof($archivo)){
          // Leyendo una linea
              $traer = fgets($archivo);
          // Imprimiendo una linea
              echo nl2br($traer);
          }
        
          // Cerrando el archivo
          fclose($archivo);
        ?>

        <form action="crearbd.php" method="POST">
          <input type="hidden" name="nombrearchivo" value="<?php echo $ruta ?>">
          <button id="btn_enviar" type="submit"  class="btn btn-secondary centrar-btn">Exportar a BD.</button>
        </form>
    </div>
</body>