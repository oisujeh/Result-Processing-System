



<!-- SCRIPTS - REQUIRED START -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Bootstrap core JavaScript -->
<!-- JQuery -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/jquery/jquery-3.1.1.min.js') ?>"></script>
<!-- Popper.js - Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/bootstrap/popper.min.js') ?>"></script>
<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url('assets/backend/assets/js/datetimepicker.js')?>"></script>

<!---->
<!--<script src="--><?php //echo base_url('assets/backend/assets/js/fullcalendar.min.js')?><!--"></script>-->
<!--<script src="--><?php //echo base_url('assets/backend/assets/js/fullcalendar.js')?><!--"></script>-->

<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/bootstrap/bootstrap.min.js') ?>"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/bootstrap/mdb.min.js') ?>"></script>



<!-- Velocity -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/velocity/velocity.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/velocity/velocity.ui.min.js') ?>"></script>
<!-- Custom Scrollbar -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<!-- jQuery Visible -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/jquery_visible/jquery.visible.min.js') ?>"></script>



<!-- SCRIPTS - OPTIONAL START -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/jvmaps/jquery.vmap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/jvmaps/maps/jquery.vmap.usa.js') ?>"></script>
<!-- Image Placeholder -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/misc/holder.min.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/bootstrap-toggle.min.js') ?>"></script>
<!-- SCRIPTS - OPTIONAL END -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/misc/ie10-viewport-bug-workaround.js')?>"></script>
<!-- SCRIPTS - OPTIONAL START -->
<?php if(isset($datatable)) {?>

    <!-- Datatables -->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/datatables/js/dataTables.bootstrap4.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/datatables/js/dataTables.responsive.min.js')?>"></script>
    <!-- <script type="text/javascript" src="assets/plugins/datatables/js/responsive.bootstrap4.min.js"></script> -->

<?php }?>
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') ?>"></script>
<!-- Form Validation -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/plugins/form-validator/jquery.form-validator.min.js') ?>"></script>
<!-- SCRIPTS - OPTIONAL END -->


<!-- QuillPro Scripts -->
<script type="text/javascript" src="<?php echo base_url('assets/backend/assets/js/scripts.js') ?>"></script>


<script src="<?php echo base_url('assets/backend/assets/js/dropzone.js')?>"></script>



<script type="text/javascript">
    jQuery.datetimepicker.setLocale('en');
    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker();
    $('#datetimepicker3').datetimepicker();
    $('#datetimepicker4').datetimepicker();
    $('#datetimepicker5').datetimepicker();
    $('#datetimepicker6').datetimepicker();
    $('#datetimepicker7').datetimepicker();
    $('#datetimepicker8').datetimepicker();
</script>


<script>

    $('#division').change(function () {
        var division_id = this.value;
        var dept_dropdown = $('#department');
        dept_dropdown.empty();
        var url = 'get_department?division_id=' + division_id;
        $.getJSON(url, function(json) {
            $.each(json, function(k, v){
                //console.log(json);
                //console.log(v['name']);
                var option = $('<option />');

                option.attr('value', v['id'])
                    .html(v['title'])
                    .appendTo(dept_dropdown);


            });
        });
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

    <script type="text/javascript">


        $("#no_litres").on("input", function (e) {
            var no_litres = this.value;
            var cost_litre = $("#cost_litre").val();
            var label = $('#amount_hap');

            label.val((no_litres * cost_litre).toFixed(2));
         });

        $("#cost_litre").on("input", function (e) {
            var cost_litre = this.value;
            var no_litres = $("#no_litres").val();
            var label = $('#amount_hap');

            label.val((cost_litre * no_litres).toFixed(2));


        });


    </script>
