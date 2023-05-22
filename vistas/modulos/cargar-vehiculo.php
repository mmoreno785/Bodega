<div class="content-wrapper">
	<section class="content-header">
		<h1>Cargar Vehículo</h1>
			<ol class="breadcrumb">
					<li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a>	</li>
					<li class="active">Cargar vehículo</li>
			</ol>

	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-success">
					<div class="box-header with-border"></div>
					<form role="form" method="post" class="formularioCarga">
						<div class="box-body">
							<div class="box">
								<!--=========================================
								ENTRADA PARA FECHA
								========================================-->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>

											<?php
                        						date_default_timezone_set('America/Guayaquil');

                      						?>
											<input size="16" type="text" class="form-control" id="fechaCarga" name="fechaCarga" value='<?php echo date(" Y-m-d ");?>' required>
											
										</div>

									</div>
								<!--=========================================
									SELECCIONAR VEHICULO
									========================================-->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-truck"></i></span>
											<select class="form-control" id="seleccionarVehiculo" name="seleccionarVehiculo" required>
												<option value="">Seleccionar Vehículo</option>
												<?php
												$item=null;
												$valor=null;
												$vehiculos=ControladorVehiculos::ctrMostrarVehiculos($item, $valor);

												foreach ($vehiculos as $key => $value) {
													echo'<option value="'.$value["id"].'">'.$value["placa"].' - '.$value["marca"].' - '.$value["modelo"].' - '.$value["responsable"].'</option>';
												 } 
												 ?>
											</select>
										</div>
									</div>
									<!-- ==================================================
									ENTRADA PARA AGREGAR PRODUCTO
									================================================== -->
									<div class="row" style="padding:0px 0px">
											<div class="col-xs-6" style="padding:0px">
												Producto
											</div>
											<div class="col-xs-1" style="padding:0px">
												Paq.
											</div>
											<div class="col-xs-1" style="padding:0px">
												Uni.
											</div>
											<div class="col-xs-2" style="padding:0px">
												Total
											</div>
											<div class="col-xs-1" style="padding:0px">
												Precio
											</div>
									</div>
										
									<div class="form-group nuevoProducto">
										
									</div>
									<input type="hidden" id="listaProductos" name="listaProductos">
									<input type="hidden" id="nuevaCarga" name="nuevaCarga">

									

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
															<input type="text" class="form-control input-lg" name="totalCarga" id="totalCarga" placeholder="0000" readonly>
														</div>
													</td>
													
												</tr>
											</tbody>
										</table>
									</div>
							</div>

						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Cargar Vehículo</button>
						</div>


					</form>
					<?php
					$cargarVehiculo = new ControladorCargas();
					$cargarVehiculo -> ctrCrearCarga();

					?>
				</div>
			</div>
			<!-- ===========================================
			LA TABLA DE PRODUCTOS
			============================================ -->
			<div class="col-lg-6">
				<div class="box box-warning">
					<div class="box-header with-border"></div>
					<div class="box-body">
						<table class="table table-bordered table-striped dt-responsive tablaCargas">
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th>Imagen</th>
									<th>Código</th>
									<th>Descripción</th>
									<th>Stock</th>
									<th>Acciones</th>
								</tr>
							</thead>
						</table>

					</div>
				</div>
			</div>
		</div>
	</section>

</div>	