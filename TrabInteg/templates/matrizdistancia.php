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
      <center><div class="card card-body contenedor" style='width:500px; height:500px'>
        <?php
          $conexion = mysqli_connect('localhost', 'root', '','trabajointegralglf');
          $C=$_POST['centro_dib'];
          $matriz=array();
          $puntosventas= array();
          $arrayX=array();
          $arrayY=array();
        ?>

        <h2 class="display-4">Ruta más eficiente del camión N°<?php echo $C ?></h2>
        <?php

        
          //echo "CENTRO DE DISTRIBUCION DEL CAMION: ".$C."<br>";

            $sql3= "SELECT X from datoslocales WHERE NumeroIdentificador=$C ";
            $sql4= "SELECT Y from datoslocales WHERE NumeroIdentificador=$C ";

            $result1C=mysqli_query($conexion,$sql3);
            $result2C=mysqli_query($conexion,$sql4);
            
            while($mostrar=mysqli_fetch_array($result1C))
            {
                if($mostrar2=mysqli_fetch_array($result2C))
                {
                    //echo "coordenadas de ".$C.": ".$mostrar['X'].",".$mostrar2['Y'];

                    array_push($arrayX,$mostrar['X']);
                    array_push($arrayY,$mostrar2['Y']);
                }
            }

            array_push($arrayX,0);
            array_push($arrayY,0);
           



            $sql="SELECT NumeroIdentificador FROM PuntosVentas$C";
            $result=mysqli_query($conexion,$sql);
            while($mostrar=mysqli_fetch_array($result))
            {
                array_push($puntosventas,$mostrar['NumeroIdentificador']);
            }


            $cant_PV=count($puntosventas) + 2;
            /*echo "cantidad de puntos de venta: ".$cant_PV."<br>";
            
          
            echo "<br>";
            echo "EMPRESA: D <br>";
            echo "PUNTOS DE VENTAS: <br>";*/
            for($a=0;$a<count($puntosventas);$a++)
            {   
                $num=$puntosventas[$a];
                
                $sql1= "SELECT X from datoslocales WHERE NumeroIdentificador=$num ";
                $sql2= "SELECT Y from datoslocales WHERE NumeroIdentificador=$num ";

                $Xp=mysqli_query($conexion,$sql1);
                $Yp=mysqli_query($conexion,$sql2);


                while($mostrar3=mysqli_fetch_array($Xp))
                {
                    if($mostrar4=mysqli_fetch_array($Yp))
                    {
                        //echo "coordenadas de ".$num.": ".$mostrar3['X'].",".$mostrar4['Y'];
                        array_push($arrayX,$mostrar3['X']);
                        array_push($arrayY,$mostrar4['Y']);
                    }
                }
            
                
            }

            /*echo "<br>";
            echo "Coordenadas X: ";
            for($a=0;$a<count($arrayX);$a++)
            {
                echo $arrayX[$a]." ";
            }

            echo "<br>";
            echo "Coordenadas Y: ";

            for($a=0;$a<count($arrayY);$a++)
            {
                echo $arrayY[$a]." ";
                
            }
            
            echo "<br>";*/
           
          
            for($a=0;$a<$cant_PV;$a++)
            {
                for($b=0;$b<$cant_PV;$b++)
                {
                    if($a==$b)
                    {
                        $matriz[$a][$b]= 0 ;
                    }
                    else
                    {
                        //array= [C,D,2,3,8,10]
                        //arrayX=[X1,X2,X3,X4,X5,X6]
                        //arrayY=[Y1,Y2,Y3,Y4,Y5,Y6]

                        $var= distancia($arrayX[$a],$arrayY[$a],$arrayX[$b],$arrayY[$b]);
                        $matriz[$a][$b]=$var;
                        
                    }

                
                }
              
            }

          


            //MOSTRAR WEAS
            /*for($a=0;$a<$cant_PV;$a++)
            {
                for($b=0;$b<$cant_PV;$b++)
                {
                    echo $matriz[$a][$b].' ';
                }
                echo"<br>";
            }*/
            
            
            $aux=array ();
            array_push($aux,$C);
            array_push($aux,0);

            for($a=0;$a<count($puntosventas);$a++)
            {
              array_push($aux,$puntosventas[$a]);
            }

          
          
            function distancia($ix,$iy,$fx,$fy)
            {
                $iniciox = $ix;
                $inicioy = $iy;
                $finalx = $fx;
                $finaly = $fy;
                $cuadradox = pow($finalx - $iniciox,2);
                $cuadradoy = pow($finaly - $inicioy,2);
                $distancia = number_format(sqrt($cuadradox+$cuadradoy), 5, '.', ''); // numero con 'x' decimales
                
                return $distancia;
            }

            
            /*Matriz definida de esta forma tomando en cuenta LA fila A como la empresa ,
            B como el centro de distribucion y los demas como puntos de venta.
            la funcion devuelve la ruta mas corta y la distancia total recorrida.
              ["A","B","C","D","E"]
              [0,2,1,10,25]
              [2,0,18,5,5]
              [1,18,0,20,2]
              [10,5,20,0,8]
              [25,5,2,8,0]*/

            
             //$matriz2=array("CentroDistribucion","Empresa","PV1","PV2","PV3");

            for($m=0;$m<count($aux);$m++){
                array_unshift($matriz[$m],$aux[$m]);
            }
            echo "Distancia mínima a recorrer: ";
            echo rutas($matriz)[1];

            echo " [Km]. </br>";
          
  
            function rutas($matriz)
            {
                $dm=99999;
                for($m=1;$m<count($matriz[0]);$m++){
                    if($dm>$matriz[0][$m] && $matriz[0][$m]!=0 && $m!=2){
                        $dm=$matriz[0][$m];
                        $pa=$m;
                    }
                }
                $i=array($matriz[0][0],$matriz[$pa-1][0],$matriz[1][0]);
                $k=$dm+$matriz[1][$pa];
                while(compruebas($matriz,$i)){
                    $dm=99999;
                    for($m=1;$m<count($matriz[$pa-1]);$m++){
                        if($dm>$matriz[$pa-1][$m] && $matriz[$pa-1][$m]!=0 && !in_array($matriz[$m-1][0],$i)){
                            $dm=$matriz[$pa-1][$m];
                            $pa1=$m;
                        }
                    }
                    $pa=$pa1;
                    $coef=9999;
                    for($c=0;$c<count($i);$c++){
                        $coefa=$matriz[buscapos($i[$c],$matriz)][$pa]+
                                $matriz[buscapos($i[$c+1],$matriz)][$pa]-
                                $matriz[buscapos($i[$c],$matriz)][buscapos($i[$c+1],$matriz)+1];
                        if($coef>$coefa){
                            $coef=$coefa;
                            $pos=$c+1;
                        }
                        if($c+2==count($i)){
                            break;
                        }
                    }
                    $k+=$coef;
                    $aux=0;
                    $iaux=array();
                    for($w=0;$w<=count($i);$w++){
                        if($pos==$w){
                            array_push($iaux,$matriz[$pa-1][0]);
                        }
                        else{
                            array_push($iaux,$i[$aux]);
                            $aux++;
                        }
                    }
                    $i=$iaux;
                }
                array_unshift($i,$i[count($i)-1]);
                $k=$k+$matriz[0][2];
                return $algo=array($i,$k);
            }

            function compruebas($matriz,$i){
                for($m=0;$m<count($matriz);$m++){
                    if(!in_array($matriz[$m][0],$i)){
                      return true;
                    }
                }
                return false;
            }
            function buscapos($a,$matriz){
                for($i=0;$i<count($matriz);$i++){
                    if($matriz[$i][0]==$a){
                        return $i;
                    }
                }
            }
        ?> 
        
        <br><table>
          <thead>
            <tr>
              <td class="text-center pl-2 pr-3">Tipo Local</td>
              <td class="text-center pl-2 pr-3">Número Identificador</td>
              <td class="text-center pl-2 pr-3"><center>Acción</center></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><center>D</center></td>
              <td><center>0</center></td>
              <td><center>No olvide llevar los productos</center></td>
            </tr>
            <tr>
              <td><center>C</center></td>
              <td><center><?php echo $C?></center></td>
              <td><center>Se carga con x=<?php echo $_POST['cant_prod']?> productos.</center></td>
            </tr>
            <?php
            $sql2 ="SELECT * from PuntosVentas$C ";
                    $result=mysqli_query($conexion,$sql2);
                    $cont=2;
                    while($mostrar2=mysqli_fetch_array($result)){
                          
                    ?>
                    </thead>
                    <tbody>
                    <tr> 
                        <td><center>P</center></td>
                        <td><center><?php echo rutas($matriz)[0][$cont]?></center></td>
                        <td><center>Se dejan <?php echo $mostrar2['Cant_prod']?> productos.</center></td>
                        
              
                    </tr>
              <?php
                    $cont++;
                    }
              ?>  
              <tr>
                <td><center>D</center></td>
                <td><center>0</center></td>
                <td><center>Se estaciona el camión.</center></td>
              </tr>
        
          </tbody>
        </table>
      </div>
    </center>
    
  </body>