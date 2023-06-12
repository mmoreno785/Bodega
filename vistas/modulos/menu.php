<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<?php
			if ($_SESSION["perfil"] == "Administrador") {
				echo '<li class="active">
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>
			<li>
				<a href="usuarios">
					<i class="fa fa-user"></i>
					<span>Usuarios</span>
				</a>
			</li>';
			}
			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") {
				echo '<li>
				<a href="categorias">
					<i class="fa fa-th"></i>
					<span>Categorías</span>
				</a>
			</li>
			<li>

				<a href="unidades">

					<i class="fa fa-cube"></i>
					<span>Unidades de medida</span>

				</a>

			</li>

			<li>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>';
			}

			


			/*************************************************************
			 **********************Vehiculos******************************
			 *************************************************************/


			

				



			/*************************************************************
			 **********************Solicitud******************************
			 *************************************************************/

			if ($_SESSION["perfil"] == "Administrador") {
				echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Sol. de materiales</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar solicitudes</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear Solicitud</span>

						</a>

					</li>';

				if ($_SESSION["perfil"] == "Administrador") {

					echo '<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reportes</span>

						</a>

					</li>';
				}



				echo '</ul>

			</li>';
			}

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-shopping-cart"></i>
					
					<span>Compras</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="compras">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar compras</span>

						</a>

					</li>

					<li>

						<a href="crear-compra">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear compra</span>

						</a>

					</li>';

			if ($_SESSION["perfil"] == "Administrador") {

				echo '<li>

						<a href="proveedores">
							
							<i class="fa fa-circle-o"></i>
							<span>Proveedores</span>

						</a>

					</li>';
			}



			echo '</ul>

			</li>';








			/*************************************************************
			 **********************Inventario******************************
			 *************************************************************/

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {

				echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-briefcase"></i>
					
					<span>Inventario</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ajustes">
							
							<i class="fa fa-circle-o"></i>
							<span>Ajustes</span>

						</a>

					</li>

					<li>

						<a href="kardex">
							
							<i class="fa fa-circle-o"></i>
							<span>Kardex</span>

						</a>

					</li>';

				if ($_SESSION["perfil"] == "Administrador") {

					echo '<li>

						<a href="reportes-kardex">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de kardex</span>

						</a>

					</li>';
				}



				echo '</ul>

			</li>';
			}





			?>

		</ul>

	</section>

</aside>