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
        <a class="navbar-brand"  href="/TrabInteg"><img src="https://static-s.aa-cdn.net/img/gp/20600011146013/Ht1Wa_JFJI9zJtrQTmB9pe3sPFnKJz8tHKF_GXSo4KBoTsHrD_eKDwqlkvaQqSS85mw=s300?v=1" width="70" alt="Logo utem" height="65"> Trabajo Integral GLF</a>
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

      <div class="card card-body contenedor pl-2 ancho-ct2">
          <h1 class="display-5 text-center">Agregar Local</h1>
            <form action="procesar.php" method="POST" enctype="multipart/form-data" >
              <div class="form-group has-feedback">
                <label for="archivo" role="button">Adjuntar archivo con Coordenadas GPS de los Centros y Puntos de venta:</label>
                <input id="archivo" type="file" name="archivo" class="form-control" onchange="return validarExt()"/>
              </div>  
              <div id="visorArchivo">

              </div>             
              <input type="hidden" name="MAX_FILE_SIZE" value="10000">
              <button id="btn_enviar" type="submit"  class="btn btn-secondary centrar-btn">Enviar archivo</button>
            </form>
        </div>

</body>
</html>

<!--script-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"    crossorigin="anonymous"></script>

    <script type="text/javascript">
      function validarExt(){
        var archivoInput = document.getElementById('archivo');
        var archivoRuta = archivoInput.value;
        var extPermitidas = /(.txt)$/i;

        if(!extPermitidas.exec(archivoRuta)){
          alert('Asegurate de seleccionar un archivo de texto .txt');
          archivoInput.value='';
          return false;
        }
        else{
          if(archivoInput.files && archivoInput.files[0]){
            var visor = new FileReader();
            visor.onload = function(e){
              document.getElementById('visorArchivo'); 
            };
            visor.readAsDataURL(archivoInput.files[0]);
          }
        }
      }
    </script>