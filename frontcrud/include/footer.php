		<!-- ================== BEGIN BASE JS ================== -->
		<script src="../assets/js/app.min.js"></script>
		<script src="../assets/js/theme/default.min.js"></script>
        <!-- ================== END BASE JS ================== -->
        
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
        <script src="../assets/plugins/d3/d3.min.js"></script>
        <script src="../assets/plugins/nvd3/build/nv.d3.min.js"></script>
        <script src="../assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
        <script src="../assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.pie.js"></script>
        <script src="../assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
        <script src="../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
        <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <link href="http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json" />

        <script src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="../assets/plugins/datatables.net-scroller-bs4/js/scroller.bootstrap4.min.js"></script>





        <script src="../assets/js/demo/table-manage-scroller.demo.js"></script>
        <script src="../assets/plugins/parsleyjs/dist/parsley.js"></script>
        <script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
	    <script src="../assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
        <script src="../assets/plugins/gritter/js/jquery.gritter.js"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->

		<!-- ================== BEGIN TOASTR JS ================== -->
		<script src="../assets/plugins/toastr/build/toastr.min.js"></script>
        <!-- ================== END TOASTR JS ================== -->

<?php
    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
        $msgRest        = '';
    }
    
    if ($codeRest == 200) {
?>
        <script>
            $(function() {
                toastr.success('<?php echo $msgRest; ?>', 'Correcto!');
            });

            localStorage.clear();
        </script>
<?php
    }

    if (($codeRest == 204) || ($codeRest == 400) || ($codeRest == 401)) {
?>
        <script>
            $(function() {
                toastr.error('<?php echo $msgRest; ?>', 'Error!');
            });
        </script>
<?php
    }
?>