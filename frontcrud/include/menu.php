<!-- begin #header -->
<div id="header" class="header navbar-default">


	<!-- begin navbar-header -->
	<div class="navbar-header">


		<?php if ($_SESSION['rol_usuario'] != "3") { ?>
			<a href="../public/dashboard_v1.php" class="navbar-brand">
			<?php } else { ?>
				<a href="../public/dashboard_aliado.php" class="navbar-brand">
				<?php } ?>


				<img src="../assets/img/logo/icono.png" alt="Home" class="light-logo">
				</a>


			




				<div class="navbar-toggle">
					<button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
				</div>

	</div>
	
		
	
	<?php
	if ($_SESSION['rol_usuario'] != "3") { ?> <div id="navigation" class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto">

				<li class="nav-item"><a href="" class="nav nav-link"><span style="color:#6820c6; font-size:18px">Dominios</span></a></li>
				<li class="dropdown-submenu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="color:#6820c6 ; font-size:18px">Otro Movimiento</span><span style="color:#D740A1 ; font-size:18px"> MOV</span></a>
					<ul class="dropdown-menu">
						<li><span style="font-size:16px"><a href="">Movimiento1</a></span></li>
						<li><span style="font-size:16px"><a href="">Movimiento 2</a></span></li>
						<li><span style="font-size:16px"><a type="submit" id="submit" name="submit" href=" " class="submit">Movimiento2</a></span></li>

					</ul>
				</li>
				<li class=" dropdown-submenu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="color:#6820c6 ; font-size:18px">Cambiar </span><span style="color:#D740A1 ; font-size:18px">DNS</span></a>
					<ul class="dropdown-menu">
						<li><span style="font-size:16px"><a href="">DNS</a></span></li>

						<li><span style="font-size:16px"><a href="">Ayuda</a></span></li>

					</ul>
				</li>

			</ul>

		</div>
	<?php  } ?>

	<!-- end navbar-header -->


	<!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="../assets/img/logo/favicon.png" alt="<?php echo $usu_02 . ' ' . $usu_03; ?>" />
				<span class="d-none d-md-inline"><?php echo $usu_02 . ' ' . $usu_03; ?></span></b>
			</a>

			<?php
			if ($_SESSION['rol_usuario'] != "3") {
			?>
				<div class="dropdown-menu dropdown-menu-right">

					<a href="javascript:;" class="dropdown-item">Documento <?php echo $usu_04; ?></a>
					<a href="javascript:;" class="dropdown-item">Cuenta <?php echo $usu_02; ?></a>
					<a href="../public/servidoresdns.php" class="dropdown-item">Servidores DNS</a> <!-- -->
					
					<!-- Opción Administración Usuarios -->
					<?php

					if ($_SESSION['rol_usuario'] != "0") {
					?>
						<a href="../admin/lista_usuarios.php" class="dropdown-item">Mantenimiento Usuarios</a> <!-- -->
						
					<?php
					}
					?>
					<a href="../public/cambiar_contrasena.php" class="dropdown-item">Cambiar Contraseña</a> <!-- -->
					<a href="../class/session/session_logout.php" class="dropdown-item">Cerrar Sesión</a>
				</div>
			<?php } else { ?>
				<div class="dropdown-menu dropdown-menu-right">
					<a href="" class="dropdown-item">Otro Movimiento</a> <!-- -->
					<a href="" class="dropdown-item">Reporte</a> <!-- -->

					<!-- Opción Administración Usuarios -->

					<a href="../public/cambiar_contrasena.php" class="dropdown-item">Cambiar Contraseña</a> <!-- -->
					<a href="../class/session/session_logout.php" class="dropdown-item">Cerrar Sesi&oacute;n</a>
				</div>
			<?php } ?>


		</li>
	</ul>
	<!-- end header-nav -->
</div>
<!-- end #header -->
<!--
			<-- begin #sidebar
			<div id="sidebar" class="sidebar">
				<!-- begin sidebar scrollbar
				<div data-scrollbar="true" data-height="100%">
					<!-- begin sidebar nav
					<ul class="nav"><li class="nav-header">Navigation</li>
						<li class="has-sub active">
							<a href="javascript:;">
								<b class="caret"></b>
								<i class="fa fa-th-large"></i>
								<span>Dashboard</span>
							</a>
							<ul class="sub-menu">
								<li class="active"><a href="../public/dashboard_v1.php">Dashboard v1</a></li>
							</ul>
						</li>
					</ul>
					<!-- end sidebar nav
				</div>
				<!-- end sidebar scrollbar
			</div>

			<div class="sidebar-bg"></div>
            <!-- end #sidebar
-->