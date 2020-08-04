<?php

  include "conexion.php";

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
        <a class="navbar-brand"  href="/TrabInteg"><img src="https://static-s.aa-cdn.net/img/gp/20600011146013/Ht1Wa_JFJI9zJtrQTmB9pe3sPFnKJz8tHKF_GXSo4KBoTsHrD_eKDwqlkvaQqSS85mw=s300?v=1" width="70" height="65" alt="logo"> Trabajo Integral GLF</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav  justify-content-end " id="navbarNav">
          <ul class="nav nav-tabs ">
            <li class="nav-item ">
              <a class="nav-link blanco" href="/TrabInteg">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link blanco" href="/TrabInteg/templates/agregarlocal.php">Comenzar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link blanco" href="/TrabInteg/templates/about.php">Sobre nosotros</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="card card-body text-center contenedor ancho-ct2">

            <?php
              session_start();
              
              $mataaux='mataaux';

              if(isset($_POST['boton'])){

                $num_ident=$_POST['Destino'];
                $cant_prod=$_POST['cant_prod'];
                $sen="INSERT INTO PuntosVentas$centro(NumeroIdentificador,Cant_prod) VALUE ('$num_ident','$cant_prod')";
                $conexion->query($sen);
                $pos=array_search($_POST['Destino'],$_SESSION[$mataaux]);
                unset($_SESSION[$mataaux][$pos]);

              }

              if(isset($_POST['boton2'])){

                if($_POST['cant_producto']>1000){
                  $_SESSION[$mataaux]=$_SESSION['arreglo'];
                }

              }

              
          

            ?>

            <h4>Hoja de rutas del camion N° <?php echo $centro ?></h4>

        <form action="hoja.php" method="POST" autocomplete="off">

              <input type="hidden" name="centro_dib" value="<?php echo $centro?>">


              <label>Seleccione punto de venta: </label>
              <select type="text "id="NumeroIdentificador" name="Destino">
              
                  <?php   
                    for($a=0;$a<$_SESSION['cant_pv'];$a++){

                      if(isset($_SESSION[$mataaux][$a])){

                      echo '<option value=" '.$_SESSION[$mataaux][$a].'">'.$_SESSION[$mataaux][$a].'</option>';
                      
                      }
                    }
                  ?>
                </select>


                <br><label for="cant_prod" >Cantidad de producto: </label>
                    <input type="number" size="40" min="1" max="1000" name="cant_prod" required="" min="1" >
                  
              <div class="col-md-9 mt-4">
              <table class="table table-striped table-bordered bg-white table-sm">
                <caption> </caption>
                  <thead>
                    <tr>
                        <th id="camion">Camion</th>
                        <th id="punto">Punto de Venta</th>
                        <th id="cantidad">Cantidad de producto</th>
                    </tr>
                  </thead>
                    <?php

                  $sql3 ="SELECT * from PuntosVentas$centro";
                  $result=mysqli_query($conexion,$sql3);
                  $cant_prod=0;
                  $contador=0;
                  while($mostrar=mysqli_fetch_array($result))
                  {
                      $contador++;
                      $cant_prod = $cant_prod + $mostrar['Cant_prod'];
                      
                      ?>
                  <tbody>
                    <tr>
                      <td><?php echo $centro?></td>
                      <td><?php echo $mostrar['NumeroIdentificador']?></td>
                      <td><?php echo $mostrar['Cant_prod']?></td>
                    </tr>
                  </tbody>
                  <?php
                  }

                  if($cant_prod<1000){
                  ?>
                  <div class="form-group pt-3">
                    <button type="submit" name="boton" class="btn btn-secondary btn-block centrar-btn" ><img width="30" height="30" src="https://cdn.discordapp.com/attachments/704799632492069024/738630514487066684/61436c0c8a8f5f4e2433a3f6dbbaa3af.png" alt="Punto">Añadir Punto de venta. </button>
                  </div>
                  <?php
                  }

                  ?>
                </table>
              </form>
              
            </div>
      
            


            <?php
                      
                    if($cant_prod<=1000){
                      if($contador>=2){

                      ?>

                        <form action="matrizdistancia.php" method="POST">
                          <?php
                          
    
                          ?>
                        <input type="hidden" name="cant_prod" value="<?php echo $cant_prod?>">
                        <input type="hidden" name="centro_dib" value="<?php echo $centro ?>">
                        <input type="submit" class="btn btn-secondary centrar-btn" name="boton3" value="Generar Ruta más eficiente.">
                        </form>
                         

                      <?php
                      }
                    }
                    else{

                      if($cant_prod>1000){
                        echo" <script>
                              alert('Error, los productos distribuidos superan los 1000 unidades, los puntos de venta se eliminarán.')
                              </script>
                              ";
                        
                          $_SESSION[$mataaux]=$_SESSION['arreglo'];


                        $sql4="TRUNCATE TABLE PuntosVentas$centro";
                        $conexion->query($sql4);

                        echo '<form action="hoja.php" method="POST">
                              <input type="hidden" name="cant_producto" value="'.$cant_prod.'">
                              <input type="hidden" name="centro_dib" value="'.$centro.'">
                              <input type="submit" name="boton2" class="btn btn-secondary" value="Refrescar">
                              </form>';
                      }
                      
                  }
                
                ?>
      </div>

                  

</html>

</body>