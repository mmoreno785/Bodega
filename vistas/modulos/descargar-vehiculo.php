<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Descarga de Vehículos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Descarga de Vehículos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

          
          Listado de Vehículos cargados

        

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Fecha</th>
           <th>Vehículo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = 'estado';
          $valor = 'cargado';

          $cargas = ControladorCargas::ctrMostrarCargas($item, $valor);

          foreach ($cargas as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["fecha"].'</td>';
                    $item1="id";
                    $valor1=$value["id_vehiculo"];
                    $vehiculos=ControladorVehiculos::ctrMostrarVehiculos($item1, $valor1);

                    //var_dump($vehiculos);

                    echo '<td>'.$vehiculos["placa"].'--'.$vehiculos["marca"].'--'.$vehiculos["modelo"].'--'.$vehiculos["responsable"].'</td>';

         

             echo' <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnDescargar" idCarga="'.$value["id"].'" idVehiculo="'.$value["id_vehiculo"].'" data-toggle="modal" data-target="#modalDescargar">Descargar</button>



                        ';

                        if($_SESSION["perfil"] == "Administrador"){

                          //echo '<button class="btn btn-danger btnEliminarEnvase" idEnvase="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                        }

                      echo '</div>  

                    </td>

                  </tr>';
          }

        ?>


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>



<!--=====================================
MODAL DESCARGAR
======================================-->

<div id="modalDescargar" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" class="formularioDescarga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Descarga de Vehículo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=========================================
                ENTRADA PARA FECHA
                ========================================-->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar-o"></i> Fecha:</span>

                      <?php
                                    date_default_timezone_set('America/Guayaquil');

                                  ?>
                      <input size="16" type="text" class="form-control" id="fechaDescarga" name="fechaDescarga" value='<?php echo date(" Y-m-d ");?>' required>
                      
                    </div>

                  </div>

            <!-- VEHICULO-->
           
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-truck"></i> Vehículo</span> 

                <input type="text" class="form-control input-lg" name="descargarvehiculo" id="descargarVehiculo" required readonly>

                 <input type="hidden"  name="idVehiculo" id="idVehiculo" required>


              </div>
              <div id="productos"></div>
              <input type="hidden" id="listaProductosDescarga" name="listaProductosDescarga">
            </div>
            <?php
              echo "<input type='hidden' id='id_carga' name='id_carga' value='".$value['id']."'>";
              echo "<input type='hidden' id='id_vehiculo' name='id_vehiculo' value='".$value['id_vehiculo']."'>";
            ?>
            <!-- ==================================================
                  ENTRADA PARA EL TOTAL
                  =================================================== -->
                  <div class="col-xs-8 pull-right">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              <input type="text" class="form-control input-lg" name="totalDescarga" id="totalDescarga" placeholder="0000" readonly>
                            </div>
                          </td>
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Descargar Vehículo</button>

        </div>

      

      </form>
      <?php
          $descargarVehiculo = new ControladorDescargas();
          $descargarVehiculo -> ctrCrearDescarga();

      ?>

    </div>

  </div>

</div>




