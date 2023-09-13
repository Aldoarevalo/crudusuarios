<?php
require '../class/function/curl_api.php';
require '../class/function/function.php';
require '../class/session/session_system.php';


$headerSubTitle = '';
if(isset($_GET['codigo'])){
    $codigo = $_GET['codigo'];
    $headerTitle	= 'Editar Usuario';
    $solicitudJSON = get_curl('operacion/obtenerUsuario/'.$codigo);
    foreach ($solicitudJSON['data'] as $key => $value);

} else {
    $headerTitle	= 'Agregar Nuevo Usuario';
}
$listaRoles = get_curl('operacion/roles');
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
                        <h4 class="panel-title"><?php echo $headerTitle;?></h4>
                    </div>
                    <div class="panel-heading-btn">
                        <form action="../class/crud/abm_usuarios.php" method="POST">
                            <input type="hidden" id="accion" name="accion" value="<?php if(isset($_GET['codigo'])) echo "update"; else echo "insert";?>"/>
                            <input type="hidden" id="codigo" name="codigo" value="<?php if(isset($_GET['codigo'])) echo $_GET['codigo'];?>"/>

                                        <br>
                                        <div class="row">
                                            <div class="col-xl-1">

                                            </div>
                                            <div class="col-xl-3">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" id="nombre" name="nombre"  class="form-control form-control-xl inverse-mode" value="<?php if(isset($_GET['codigo'])) echo $value['nombre']; ?>" placeholder="Nombre del usuario"/>

                                            </div>

                                            <div class="col-xl-3">
                                                <label for="apellido">Apellidos</label>
                                                <input type="text" id="apellido" name="apellido"  class="form-control form-control-xl inverse-mode" value="<?php if(isset($_GET['codigo'])) echo $value['apellido']; ?>" placeholder="Apellido del usuario"/>
                                            </div>

                                            <div class="col-xl-3">
                                                <label for="documento">Documento</label>
                                                <input type="text" id="documento" name="documento"  class="form-control form-control-xl inverse-mode" value="<?php if(isset($_GET['codigo'])) echo $value['nro_documento']; ?>" placeholder="Número Documento"/>
                                            </div>

                                            <div class="col-xl-2">

                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">

                                            <div class="col-xl-1">
                                            </div>
                                            <div class="col-xl-3">
                                                <label for="correo">Correo Electrónico</label>
                                                <input type="text" id="correo" name="correo"  class="form-control form-control-xl inverse-mode" value="<?php if(isset($_GET['codigo'])) echo $value['correo']; ?>" placeholder="Correo Electrónico"/>
                                            </div>

                                            <div class="col-xl-3">
                                                <label for="celular">Contraseña</label>
                                                <input type="password" id="contrasena" name="contrasena"  class="form-control form-control-xl inverse-mode"  placeholder="Contraseña"/>
                                            </div>

                                            <div class="col-xl-3">
                                                <label for="celular">Fecha Nacimiento</label>
                                                <?php if(isset($_GET['codigo'])){ ?>
                                                    <input type="text" id="nacimiento" name="nacimiento"  class="form-control form-control-xl inverse-mode"  value="<?php echo $value['nacimiento']?>"/>
                                                <?php }else { ?>
                                                    <input type="date" id="nacimiento" name="nacimiento"  class="form-control form-control-xl inverse-mode"  placeholder="Fecha Nacimiento"/>
                                                <?php  } ?>
                                            </div>

                                            <div class="col-xl-2">

                                            </div>
                                        </div>

                                        <br/>
                                        <div class="row">

                                <div class="col-xl-1">
                                </div>


                                <div class="col-xl-3">
                                    <label for="celular">Celular</label>
                                    <input type="text" id="celular" name="celular"  class="form-control form-control-xl inverse-mode" value="<?php if(isset($_GET['codigo'])) echo $value['celular']; ?>" placeholder="Celular"/>
                                </div>

                                <div class="col-xl-3">
                                    <label for="cmbPerfil">Rol</label>
                                    <select class="form-control " name="rol" id="rol" >
                                        <?php
                                        foreach ($listaRoles['data'] as $key => $value2) {
                                            ?>
                                            <option value="<?php echo $value2['codigo']; ?>" <?php if(isset($_GET['codigo'])) {if($value2['codigo']==$value['rol']){ echo 'selected';}else{ echo '';}}  ?>><?php echo $value2['nombre_rol']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-xl-2">

                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-xl-1">
                                </div>
                                <div class="col-xl-2">
                                    <button type="submit" name="btnRegistrar" id="btnRegistrar" class="btn btn-primary btn-md" style="width: 100%;">Registrar</button>
                                </div>
                                <div class="col-xl-2">
                                    <a href="../admin/lista_usuarios.php" class="btn btn-default btn-md" style="width: 100%;">Cancelar</a>
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

    </div>
    <!-- end #content -->

    <!-- begin #floating-action-button -->
   
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
