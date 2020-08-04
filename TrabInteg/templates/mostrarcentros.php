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
        <a class="navbar-brand"  href="/TrabInteg"><img alt="logo utem" src="https://static-s.aa-cdn.net/img/gp/20600011146013/Ht1Wa_JFJI9zJtrQTmB9pe3sPFnKJz8tHKF_GXSo4KBoTsHrD_eKDwqlkvaQqSS85mw=s300?v=1" width="70" height="65"> Trabajo Integral GLF</a>
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

      <h2 class="text-center display-4 pt-5">Datos Ingresados en la Base de Datos</h2>
      <div class="col-md-6 contenedor pl-2 mt-0">

        <table class="table table-striped table-bordered bg-white table-sm"> <caption> </caption>
            <thead>
                <tr>
                    <th id="Centros" class="text-center">Centros de Distribucion</th>
                    <th id="Identificador" class="text-center">NumeroIdentificador</th>
                    <th id="Camiones" class="text-center">Camiones</th>
                </tr>
              </thead>
                <?php


                session_start();
                include "conexion.php";

              
                $sql2 ="SELECT * from datoslocales where TipoLocal='P'";
                $result=mysqli_query($conexion,$sql2);


                if($_SESSION['cant_pv']==0)
                {
                  while($mostrar2=mysqli_fetch_array($result)){
                    array_push($_SESSION['arreglo'],$mostrar2['NumeroIdentificador']);
                  }
                  $_SESSION['mataaux']=$_SESSION['arreglo'];
                  $_SESSION['cant_pv']=count($_SESSION['arreglo']);
                }


               
                



                $sql ="SELECT * from datoslocales where TipoLocal='C'";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result))
                {
                  $num='NumeroIdentificador';  
                ?>
                    
                    <tbody>
                    
                    <tr>
                        <td><?php echo $mostrar['TipoLocal']?></td>
                        <td><?php echo $mostrar[$num]?></td>
                        
                        <td>

                        <form action="hoja.php" method="POST">
                        
                        <?php
                          
                          echo "<input type='hidden' name='cant_pv' value='".count($_SESSION['arreglo'])."'>";


                          for($a=0;$a<count($_SESSION['arreglo']);$a++)
                          {
                            if(isset($_SESSION['arreglo'][$a]))
                              echo "<input type='hidden' name='pto_venta".$a."' value='".$_SESSION['arreglo'][$a]."'>";
                          }



                        ?>
                        <input type="hidden" name="centro_dib" value="<?php echo $mostrar[$num]?>">
                        <input type="submit" class="btn btn-secondary" value="Crear Ruta" > Para el camion N° <?php echo $mostrar['NumeroIdentificador'] ?>
                        
                        </td>
                        
                      </form>
                    </tr>
                    <?php
                }
              
                ?>

                  <br><br>
                          
            </tbody>
        </table>
    
    </div>
    <div class="container">
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <table class="table table-striped table-bordered bg-white table-sm"> <caption> </caption>
            <thead>

                  <tr>
                    <th id="puntos">Puntos de venta.</th>
                    <th id="identificador">NumeroIdentificador</th>

                   </tr>
                  <?php
                    $sql2 ="SELECT * from datoslocales where TipoLocal='P'";
                    $result=mysqli_query($conexion,$sql2);
                    while($mostrar2=mysqli_fetch_array($result)){
                      $num_camion=1;

                    ?>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $mostrar2['TipoLocal']?></td>
                        <td><?php

                        
                        echo $mostrar2['NumeroIdentificador'];

                       
                  
                        ?></td>
                    </tr>
                    <?php
                    }

                  ?>


            </tbody>
          </table>
        </div>
        <div class="col-4"></div>
      </div>
    </div>
</body>