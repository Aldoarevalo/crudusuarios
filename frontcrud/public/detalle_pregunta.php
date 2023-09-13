<?php
require '../class/function/curl_api.php';
require '../class/function/function.php';
require '../class/session/session_system.php';


$headerSubTitle = '';
if(isset($_GET['codigo'])){

    $codigo = $_GET['codigo'];
    $preguntaJSON = get_curl('operacion/obtenerpreguntasfrecuentes/'.$codigo);
    foreach ($preguntaJSON['data']  as $key => $pregunta);


}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    include '../include/header.php';
    ?>
    <style>
        .colorExtra{
            border:1px solid #6820c6;

        }
        img {
            max-height: 200px;
        }
    </style>
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

        <!-- bloque principal -->

        <div class="row">
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-3">

                <div class="card colorExtra">
                    <div class="card-body">
                        
                        <h3 class="card-title"><?php echo $pregunta['titulo'];?></h3>
                        <?php if($pregunta['descripcion']!=""){ ?><p class="card-text"><?php  echo $pregunta['descripcion'];?></p><?php } ?>
                        <p class="card-text"><i class="fa fa-envelope"></i> &nbsp; Correo:  &nbsp;&nbsp;<?php  echo strtoupper($pregunta['direccion'])?></p>
                        <p class="card-text"><i class="fa fa-user"></i> &nbsp; Contacto: &nbsp;&nbsp;<?php  echo strtoupper($pregunta['contacto'])?></p>

                        <?php $msg= "Quiero mas informacion sobre: ".strtoupper($pregunta['titulo']);?>
                    </div>
                    <div class="card-footer"><p align="right"><a href="solicitarinformacion.php?msg=<?php echo $msg?>">Solicitar más información</a></p></div>
                </div>

            </div>
            <div class="col-sm-5">&nbsp;</div>

        </div>



        <!-- end row -->

    </div>
    <!-- end #content -->

    <!-- begin #floating-action-button -->
    <a href="https://web.whatsapp.com/send?phone=<?php echo $usu_24; ?>&text=<?php echo $usu_25; ?>" target="_blank" class="float" style="background-color:#1ebea5 !important; color:#ffffff !important;" title="Consulta whatsapp">
        <i class="fab fa-whatsapp fa-2x custom-float"></i>
    </a>

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



</script>

</body>
</html>


