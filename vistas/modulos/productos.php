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
      Administrar productos
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar productos</li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          Agregar producto
        </button>
        <div class="box-tools pull-right">
          <button class="btn btn-success btnReporteSaldos" style="margin-top:5px">Reporte de Saldos</button>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Unidad</th>
              <th>Stock</th>
              <th>P.compra</th>
              <th>P.de venta</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
        <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
            <div class="form-group  row">
              <div class="col-xs-6">
                <label for="nuevaCategoria">Categoría:</label>
                <div class="input-group input-group-sm mb-3">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                    <option value="">Selecionar categoría</option>
                    <?php
                    $item = null;
                    $valor = null;
                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                    foreach ($categorias as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <!-- ENTRADA PARA EL CÓDIGO -->
              <div class="col-xs-6">
                <label for="nuevoCodigo">Código:</label>
                <div class="input-group input-group-sm mb-3">
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>
                </div>
              </div>
            </div>
            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="form-group">
              <label for="nuevaDescripcion">Descripción:</label>
              <div class="input-group input-group-sm mb-3">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR UNIDAD DE MEDIDA -->
            <div class="form-group">

              <label for="nuevaUnidad">Unidad de Medida:</label>
              <div class="input-group input-group-sm mb-3">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="nuevaUnidad" name="nuevaUnidad" required>
                  <option value="">Selecionar unidad de medida</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);
                  foreach ($unidades as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["unidad"] . '</option>';
                  }
                  ?>
                </select>
              </div>

            </div>

            <div class="form-group">
              <label for="nuevoStock">Stock :</label>
              <div class="input-group input-group-sm mb-3">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" id="nuevoStock" name="nuevoStock" min="0" placeholder="Stock" required>
              </div>
            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->
            <div class="form-group row">
              <div class="col-xs-6">
                <label for="nuevoPrecioCompra">Precio de Compra:</label>
                <div class="input-group input-group-sm mb-3">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>
                </div>
              </div>

              <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-6">
                <label for="nuevoPrecioVenta">Precio de Venta:</label>
                <div class="input-group input-group-sm mb-3">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>
                </div>
                <br>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              <div class="panel">SUBIR IMAGEN</div>
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso máximo de la imagen 2MB</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
        </div>
      </form>
      <?php
      $crearProducto = new ControladorProductos();
      $crearProducto->ctrCrearProducto();
      ?>
    </div>
  </div>
</div>

<!--=====================================
MODAL AJUSTAR PRODUCTO
======================================-->
<div id="modalAjustarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL AJUSTAR PRODUCTO
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ajustar Stock producto</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL AJUSTAR PRODUCTO
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!--=========================================
                ENTRADA PARA EL CÓDIGO
                ========================================-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i> Código: </span>
                <input type="text" class="form-control input-lg" id="ajustarCodigo" name="ajustarCodigo" readonly required>
                <input type="hidden" id="ajustarId" name="ajustarId">
              </div>
            </div>
            <!--=========================================
                ENTRADA PARA FECHA
                ========================================-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i> Fecha:</span>
                <?php
                date_default_timezone_set('America/Guayaquil');
                ?>
                <input size="16" type="text" class="form-control" id="fechaAjuste" name="fechaAjuste" value='<?php echo date(" Y-m-d "); ?>' required>
              </div>
            </div>
            <!--=========================================
                ENTRADA PARA OPERACION
                ========================================-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i> Operación: </span>
                <select class="form-control input-lg" id="ajusteOperacion" name="ajusteOperacion" required>
                  <option value="0">Entrada</option>
                  <option value="1">Salida</option>
                </select>
              </div>
            </div>
            <!--=========================================
                ENTRADA PARA CONCEPTO
                ========================================-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cc"></i> Concepto: </span>
                <input size="16" type="text" class="form-control" id="conceptoAjuste" name="conceptoAjuste" required>
              </div>
            </div>


            <!-- ENTRADA PARA CANTIDAD -->
            <div class="form-group row">
              <div class="col-xs-4">
                <label for="ajusteCantidad">Cantidad:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="number" class="form-control input-lg" id="ajusteCantidad" name="ajusteCantidad" min="0" required>
                  <input type="hidden" name="ajusteStock" id="ajusteStock">
                </div>
              </div>

              <!-- ENTRADA PARA VALOR UNITARIO -->

              <div class="col-xs-4">
                <label for="valorUnitario">Valor Unitario:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="number" class="form-control input-lg" id="ajusteValorUnitario" name="ajusteValorUnitario" step="any" min="0" placeholder="Valor Unitario" required>
                </div>
              </div>
              <!-- ENTRADA PARA VALOR TOTAL -->
              <div class="col-xs-4">
                <label for="valorTotal">Valor Total:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="number" class="form-control input-lg" id="ajusteValorTotal" name="ajusteValorTotal" step="any" min="0" placeholder="Valor Total" readonly required>
                </div>
                <br>
              </div>
            </div>

            <!-- ENTRADA PARA SALDO CANTIDAD -->
            <div class="form-group row">
              <div class="col-xs-4">
                <label for="ajusteSaldoCantidad">Saldo Cantidad:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="number" class="form-control input-lg" id="ajusteSaldoCantidad" name="ajusteSaldoCantidad" min="0" placeholder="Saldo" readonly required>
                </div>
              </div>

              <!-- ENTRADA PARA SALDO VALOR UNITARIO-->
              <div class="col-xs-4">
                <label for="ajusteSaldoValorUnitario">Saldo Valor Unitario:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="number" class="form-control input-lg" id="ajusteSaldoValorUnitario" name="ajusteSaldoValorUnitario" step="any" min="0" placeholder="Saldo" readonly required>
                </div>
              </div>


              <!-- ENTRADA PARA SALDO VALOR TOTAL-->

              <div class="col-xs-4">

                <label for="ajusteCantidadTotal">Saldo Valor Total:</label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-check"></i></span>

                  <input type="number" class="form-control input-lg" id="saldoValorTotal" name="saldoValorTotal" min="0" readonly required>

                </div>

              </div>
            </div>




          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL AJUSTAR PRODUCTO
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar </button>

        </div>

      </form>
      <?php

      $ajustarProducto = new ControladorProductos();
      $ajustarProducto->ctrAjustarProducto();

      ?>

    </div>
  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="editarCategoria" readonly required>

                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                </div>

              </div>

              <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" required>

                </div>

                <br>





              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

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

      </form>

      <?php

      $editarProducto = new ControladorProductos();
      $editarProducto->ctrEditarProducto();

      ?>

    </div>

  </div>

</div>

<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto->ctrEliminarProducto();

?>