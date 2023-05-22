<?php
if ($_SESSION["perfil"] == "Vendedor") {
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar Unidades de Medida
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Unidades de Medida</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUnidad">
          Agregar Unidad
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Unidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;
            $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);

            foreach ($unidades as $key => $value) {
              echo ' <tr>
                    <td>' . ($key + 1) . '</td>
                    <td class="text-uppercase">' . $value["unidad"] . '</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarUnidad" idUnidad="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarUnidad"><i class="fa fa-pencil"></i></button>';
              if ($_SESSION["perfil"] == "Administrador") {
                echo '<button class="btn btn-danger btnEliminarUnidad" idUnidad="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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
MODAL AGREGAR UNIDAD
======================================-->

<div id="modalAgregarUnidad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Unidad</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaUnidad" placeholder="Ingresar unidad" required>
              </div>
            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar unidad</button>
        </div>
        <?php
        $crearUnidad = new ControladorUnidades();
        $crearUnidad->ctrCrearUnidad();
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR UNIDAD
======================================-->

<div id="modalEditarUnidad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar unidad</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarUnidad" id="editarUnidad" required>
                <input type="hidden" name="idUnidad" id="idUnidad" required>
              </div>
            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
        <?php
        $editarUnidad = new ControladorUnidades();
        $editarUnidad->ctrEditarUnidades();
        ?>
      </form>
    </div>
  </div>
</div>
<?php

$borrarUnidad = new ControladorUnidades();
$borrarUnidad->ctrBorrarUnidad();
?>