<?php

  $conexion = mysqli_connect('localhost', 'root', '','trabajointegralglf'); 
  $centro=$_POST['centro_dib'];

  $sql1="CREATE TABLE PuntosVentas$centro(
      NumeroIdentificador INT, 
      Cant_prod INT,   
      Coordenadas INT,
      PRIMARY KEY(NumeroIdentificador)
        )";

  $conexion->query($sql1);
  
?>

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

      <div class="card card-body text-center contenedor ancho-ct2">

            <?php
              if(isset($_POST['boton'])){
                $num_ident=$_POST['pto_venta'];
                $cant_prod=$_POST['cant_prod'];
                $sen="INSERT INTO PuntosVentas$centro(NumeroIdentificador,Cant_prod) VALUE ('$num_ident','$cant_prod')";
                $conexion->query($sen);            
              }
            ?>

            <h5>Hoja de rutas del camion N° <?php echo $centro ?></h5>

        <form action="hoja.php" method="POST" autocomplete="off">

              <input type="hidden" name="centro_dib" value="<?php echo $centro?>">
              <input type="option" name="pto_venta" placeholder="Indicar Punto de venta" list="NumeroIdentificador" class="form-control">            
              <datalist id="NumeroIdentificador" name="Destino">
              <option value=" ">Seleccione:</option>
                  <?php   
                      $sql ="SELECT * from datoslocales where TipoLocal='P'";
                      $result=mysqli_query($conexion,$sql);
                      while($mostrar=mysqli_fetch_array($result)){
                        echo '<option value=" '.$mostrar['NumeroIdentificador'].'"> </option>';
                      }
                  ?>
                </datalist>
                <label for="cant_prod" >Cantidad de producto: </label>
                    <input type="number" size="40" min="1" max="1000" name="cant_prod" >
                  
              <div class="col-md-9 mt-4">
              <table class="table table-striped table-bordered bg-white table-sm">
                  <thead>
                    <tr>
                        <td>Camion</td>
                        <td>Punto de Venta</td>
                        <td>Cantidad de producto</td>
                    </tr>
                  </thead>
                    <?php

                  $sql3 ="SELECT * from PuntosVentas$centro";
                  $result=mysqli_query($conexion,$sql3);
                  $cant_prod=0;
                  while($mostrar=mysqli_fetch_array($result))
                  {
                      $cant_prod = $cant_prod + $mostrar['Cant_prod'];
                      
                      ?>
                  <tbody>
                    <tr>
                      <td><center><?php echo $centro?></center></td>
                      <td><center><?php echo $mostrar['NumeroIdentificador']?></center></td>
                      <td><center><?php echo $mostrar['Cant_prod']?></center></td>
                    </tr>
                  </tbody>
                  <?php
                  }

                  if($cant_prod<1000){
                  ?>
                  <div class="form-group pt-3">
                    <button type="submit" name="boton" class="btn btn-secondary btn-block centrar-btn" ><img width="30" height="30" src="https://cdn.discordapp.com/attachments/704799632492069024/738630514487066684/61436c0c8a8f5f4e2433a3f6dbbaa3af.png">Añadir Punto de venta. </button>
                  </div>
                  <?php
                  }

                  ?>
                </table>
              </form>
              
            </div>
              
      </div>

                  <?php
                
                    if($cant_prod<=1000){
                      ?>


                        <form action="matrizdistancia.php" method="POST">
                        <input type="hidden" name="cant_prod" value="<?php echo $cant_prod?>">
                        <input type="hidden" name="centro_dib" value="<?php echo $centro ?>">
                        <input type="submit" class="btn btn-secondary centrar-btn" value="Generar Ruta más eficiente.">
                        </form>
                         

                      <?php
                    }
                    else{

                      if($cant_prod>1000){
                        echo" <script>
                              alert('Error, los productos distribuidos superan los 1000 unidades, los puntos de venta se eliminarán.')
                              </script>
                              ";

                        $sql4="TRUNCATE TABLE PuntosVentas$centro";
                        $conexion->query($sql4);

                        echo '<form action="hoja.php" method="POST">
                              <input type="hidden" name="centro_dib" value="'.$centro.'">
                              <input type="submit" class="btn btn-secondary" value="Refrescar">
                              </form>';
                      }
                  }
                
                ?>

</html>

</body>