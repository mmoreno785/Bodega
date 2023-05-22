<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Vehículos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar vehículos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVehiculo">
          
          Agregar vehículo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Placa</th>
           <th>Marca</th>
           <th>Modelo</th>
           <th>Año</th>
           <th>Responsable</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $vehiculos = ControladorVehiculos::ctrMostrarVehiculos($item, $valor);

       foreach ($vehiculos as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["placa"].'</td>
                  <td>'.$value["marca"].'</td>
                  <td>'.$value["modelo"].'</td>
                  <td>'.$value["ano"].'</td>
                  <td>'.$value["responsable"].'</td>';

                
                          

                  echo '
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarVehiculo" idVehiculo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarVehiculo"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarVehiculo" idVehiculo="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div>  

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
MODAL AGREGAR VEHICULO
======================================-->

<div id="modalAgregarVehiculo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar vehiculo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA PLACA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-etsy"></i></span> 

                <label for="nuevaPlaca">Placa:</label>

                <input type="text" class="form-control input-lg" name="nuevaPlaca" placeholder="Ingresar placa" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL MARCA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-trademark"></i></span> 

                <label for="nuevaMarca">Marca:</label>

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca" id="nuevaMarca" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-car"></i></span> 

                <label for="nuevoModelo">Modelo:</label>

                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Ingresar Modelo" required>

              </div>

            </div>

            <!-- ENTRADA PARA AÑO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <label for="nuevoModelo">Año:</label>

                <input type="number" class="form-control input-lg" name="nuevoAno" placeholder="Ingresar Año" required>

              </div>

            </div>

            <!-- ENTRADA PARA RESPONSABLE-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-o"></i></span> 

                <label for="nuevoResponsable">Responsable:</label>

                <input type="text" class="form-control input-lg" name="nuevoResponsable" placeholder="Ingresar responsable" required>

              </div>

            </div>

             

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar vehículo</button>

        </div>

        <?php

          $crearVehiculo = new ControladorVehiculos();
          $crearVehiculo -> ctrCrearVehiculo();

        ?>

      </form>
    </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR VEHICULO
======================================-->

<div id="modalEditarVehiculo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar vehiculo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA PLACA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-etsy"></i></span> 

                <label for="editarPlaca">Placa:</label>

                <input type="text" class="form-control input-lg" name="editarPlaca"  id="editarPlaca" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL MARCA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-trademark"></i></span> 

                <label for="editarMarca">Marca:</label>

                <input type="text" class="form-control input-lg" name="editarMarca"  id="editarMarca" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-car"></i></span> 

                <label for="editarModelo">Modelo:</label>

                <input type="text" class="form-control input-lg" name="editarModelo" id="editarModelo" required>

              </div>

            </div>

            <!-- ENTRADA PARA AÑO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <label for="editarAno">Año:</label>

                <input type="number" class="form-control input-lg" name="editarAno" id="editarAno" required>

              </div>

            </div>

            <!-- ENTRADA PARA RESPONSABLE-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <label for="editarResponsable">Responsable:</label>

                <input type="text" class="form-control input-lg" name="editarResponsable" id="editarResponsable" required>

              </div>

            </div>

          </div>  

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar vehiculo</button>

        </div>

     <?php

          $editarVehiculo = new ControladorVehiculos();
          $editarVehiculo -> ctrEditarVehiculo();

        ?> 



      </form>
    </div>

    </div>

  </div>

</div>



<?php

 $borrarVehiculo = new ControladorVehiculos();
 $borrarVehiculo -> ctrBorrarVehiculo();

?> 


