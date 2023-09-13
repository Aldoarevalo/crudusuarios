<?php
	require '../class/function/curl_api.php';
	require '../class/function/function.php';
	require '../class/session/session_system.php';

	$headerTitle	= 'Lista Usuarios';
	$headerSubTitle = '';
	if ((isset($_GET['nombre']) && $_GET['nombre'] != '') || (isset($_GET['nroDocumento']) && $_GET['nroDocumento'] != '') || (isset($_GET['cmbPerfil']) && $_GET['cmbPerfil'] != '')) 
	{
		$dataJSON       = json_encode(
			array(
				'nombre'   	  => $_GET['nombre'],
				'cmbPerfil'   => $_GET['cmbPerfil'],
				'documento'   => $_GET['nroDocumento']
			));
		$solicitudJSON	= post_curl('operacion/busquedausuarios',$dataJSON);
		$solicitudJSON     = json_decode($solicitudJSON, true);
		$listaRoles = get_curl('operacion/roles');
	}
	else
	{
		$solicitudJSON	= get_curl('operacion/usuarios');
		$listaRoles = get_curl('operacion/roles');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
			include '../include/header.php';
		?>

	</head>

	<body>
		<!-- begin #page-loader -->
		<div id="page-loader" class="fade show">
			<span class="spinner"></span>
		</div>
		<!-- end #page-loader -->
		
		<!-- begin #page-container -->
		<div id="page-container" class="fade page-sidebar-minified page-sidebar-fixed page-header-fixed">
			<?php
					include '../include/menu.php';
			?>

			<!-- begin #content -->
			<div id="content" class="content">
		
				<div class="row m-b-20">
					<div class="col-xl-2 col-lg-3">
					</div>
					<div class="col-xl-8 col-lg-6">
						<div class="panel panel-inverse">
							<div class="panel-heading">
								<h4 class="panel-title">Parámetros de Búsqueda</h4>
							</div>
							<div class="panel-heading-btn">
								<form action="" method="get">
								<br>
								<div class="row">
									<div class="col-xl-1">
										
									</div>
									<div class="col-xl-3">
										<input type="text" id="nombre" name="nombre"  class="form-control form-control-xl inverse-mode" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : '' ?>" placeholder="Ingrese nombre del usuario"/>
									</div>

									<div class="col-xl-2">
										<input type="text" id="nroDocumento" name="nroDocumento"  class="form-control form-control-xl inverse-mode" value="<?php echo isset($_GET['nroDocumento']) ? $_GET['nroDocumento'] : '' ?>" maxlenght="10" placeholder="Documento"/>
									</div>

									<div class="col-xl-3">
										<select class="form-control form-control-xl inverse-mode" name="cmbPerfil" id="cmbPerfil" style="width: 100%;">
											<option value="0" <?php if(isset($_GET['cmbPerfil'])){ if($_GET['cmbPerfil']==0){ echo 'selected';}else{ echo '';} } else { echo '';} ?>>--Todos--</option>
											<?php
												foreach ($listaRoles['data'] as $key => $value) {
											?>
												<option value="<?php echo $value['codigo']; ?>" <?php if(isset($_GET['cmbPerfil'])){ if($_GET['cmbPerfil']==$value['codigo']){ echo 'selected';}else{ echo '';} } else { echo '';} ?>  ><?php echo $value['nombre_rol']; ?></option>
											<?php
												}
											?>
										</select>
									</div>

									<div class="col-xl-2">
										<button type="submit" name="btnConsultar" id="btnConsultar" class="btn btn-primary btn-md" style="width: 100%;">Buscar</button>
									</div>
								</div>
								<br>
								</form>
							</div>
						</div>
					</div>
					<div class="col-xl-2 col-lg-3">
					</div>
				</div>

                <div class="row m-b-20">
                    <div class="col-xl-2 col-lg-3">
                    </div>
                    <div class="col-xl-2">

                    </div>
                    <div class="col-xl-2">

                    </div>
                    <div class="col-xl-2">

                    </div>
                    <div class="col-xl-2">
                        <a href="abm_usuarios.php" class="btn btn-primary btn-md" style="width: 100%;">Nuevo Usuario</a>
                    </div>
                </div>


				<!-- begin row -->
				<div class="row m-b-20">

					<div class="col-xl-2 col-lg-3">
					</div>
					<!-- begin col-8 -->
					<div class="col-xl-8 col-lg-6">
						<!-- begin panel -->
						<div class="panel panel-inverse">
							<div class="panel-heading">
								<h4 class="panel-title">Listado de Usuarios </h4>
							</div>
							<div class="panel-heading-btn">
								<div class="table-responsive">
									<table id="tblUsuarios" class="table table-striped table-bordered table-td-valign-middle" cellspacing="0" width="100%;">
										<thead>
											<tr>
												<th class="hidden-sm text-center">#</th>
												<th class="hidden-sm text-center">Nombres</th>
												<th class="hidden-sm text-center">Número Documento</th>
												<th class="hidden-sm text-center">Correo</th>
												<th class="hidden-sm text-center">Celular</th>
												<th class="hidden-sm text-center">Rol</th>
												<th class="hidden-sm text-center">Acción</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($solicitudJSON!=null || $solicitudJSON!=""){
												foreach ($solicitudJSON['data'] as $key => $value) {
													if(isset($value['codigo']))
													{
											?>
											<tr>
												<td class="text-nowrap text-inverse text-center"> <?php echo $value['correlativo']; ?> </td>
												<td class="text-nowrap text-inverse text-center"> <?php echo $value['nombre_usuario']; ?> </td>
												<td class="f-w-600 text-muted text-center"> <?php echo $value['numero_documento']; ?></td>
												<td class="f-w-600 text-muted text-center"> <?php echo $value['correo']; ?></td>
												<td class="f-w-600 text-muted text-center"> <?php echo $value['celular']; ?></td>
												<td class="f-w-600 text-muted text-center"> <?php echo $value['nombre_rol']; ?></td>
												<td class="f-w-600 text-muted text-center">
                                                        <?php if($value['codigo_rol']!="3"){?>
													<a href="../admin/editar_usuario.php?codigo=<?php echo $value['codigo'] ?>" rel="tooltip" title="Editar Usuario">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                        <?php } else{ ?>
                                                    <a href="../admin/abm_usuarios.php?codigo=<?php echo $value['codigo'] ?>" rel="tooltip" title="Editar Datos de Aliado">
                                                        <i class="fa fa-user-edit"></i>
                                                    </a>
                                                        <?php } ?>
												</td>
												
											</tr>
											<?php
													}
												}
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- end panel -->
					</div>
					<!-- end col-8 -->
					<div clas="col-xl-2 col-lg-3">
					</div>

				</div>
				<!-- end row -->

			</div>
			<!-- end #content -->

			<!-- end #floating-action-button -->

<?php
    	include '../include/development.php';
?>

		</div>
		<!-- end page container -->
		
<?php
    	include '../include/footer.php';
?>

		<script src="../js/api.js"></script>

		<script>

		$(document).ready(function () {
			$('#tblUsuarios').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": false,
				"info": true,
				"autoWidth": false,
				"responsive": true,
				"pageLength": 10,
				"dom": 'Bfrtip',
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
				},
			});
			
		});
			var codCliente	= '<?php echo $usu_00; ?>';
			if (localStorage.getItem('lstUsuariosJSON') === 'null' || localStorage.getItem('lstUsuariosJSON') === null ){
				localStorage.removeItem('lstUsuariosJSON');
				localStorage.setItem('lstUsuariosJSON', JSON.stringify(<?php echo json_encode($solicitudJSON); ?>));
			}
			
		</script>
		
	</body>
</html>