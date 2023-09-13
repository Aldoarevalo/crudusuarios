<?php
require '../class/function/curl_api.php';
require '../class/function/function.php';
require '../class/session/session_system.php';

$headerTitle	= 'Preguntas Frecuentes';
$headerSubTitle = '';


  $dataJSON       = json_encode(
    array(
        'codigo'   	  => '0'
    ));

  $preguntasJSON	= post_curl('operacion/listarpreguntasfrecuentes', $dataJSON);
    $preguntasJSON     = json_decode($preguntasJSON, true);

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

        <form action="" method="get">
            <div class="card colorExtra ">

                <div class="card-body">
                        <h4>Preguntas Frecuentes</h4>
                        <hr/>
                        <div class="row">
                            <ul>
                                    <?php foreach ($preguntasJSON['data']  as $key => $preguntas){
                                        $dataJSON2       = json_encode(
                                            array(
                                                'codigo'   	  => $preguntas['codigo']
                                            ));

                                        $preguntasJSON2	= post_curl('operacion/listarpreguntasfrecuentes', $dataJSON2);
                                        $preguntasJSON2     = json_decode($preguntasJSON2, true);

                                        ?>
                                            <li class="card-text"><span style="font-size:18px"><a href="detalle_pregunta.php?codigo=<?php echo $preguntas['codigo']?>"><?php echo htmlentities($preguntas['titulo']);?></a></span></li>
                                                <ul>
                                              <?php
                                             // if($preguntasJSON2!=null || $preguntasJSON2!=""){
                                              foreach ($preguntasJSON2['data']  as $key => $preguntas2){
                                                  if(isset($preguntas2['codigo'])){
                                                  ?>
                                                  <li><span style="font-size:18px"><a href="detalle_pregunta.php?codigo=<?php echo $preguntas2['codigo']?>"><?php echo htmlentities($preguntas2['titulo']);?></a></span></li>
                                                    <?php } }?>
                                                </ul>
                                    <?php } ?>
                                </ul>
                                </div>



                     </div>


                </div>




        </form>

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

 torage.setItem('lstUsuariosJSON', JSON.stringify(<?php echo json_encode($aliadosJSON); ?>));
    }

</script>

</body>
</html>

