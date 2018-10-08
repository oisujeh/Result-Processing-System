
   
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('assets/backend/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/backend/vendor/metisMenu/metisMenu.min.js')?>"></script>
    <script src="<?php echo base_url('assets/backend/vendor/bootstrap/js/bootstrap.min.js')?>"></script>



    <script src="<?php echo base_url('assets/backend/vendor/tether/tether.min.js')?>"></script>
    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url('assets/backend/vendor/jquery-easing/jquery.easing.min.js')?>"></script>
    <script src="<?php echo base_url('assets/backend/vendor/chart.js/Chart.min.js')?>"></script>
    <script src="<?php echo base_url('assets/backend/vendor/datatables/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('assets/backend/vendor/datatables/dataTables.bootstrap4.js')?>"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url('assets/backend/js/sb-admin-2.min.js')?>"></script>

    <script>


        $("#amount_usd").on("input", function (e) {
    var amount = this.value;
    var label = $('#ngn_amount');
    $.getJSON('get_exchange_rate', function (json) {
      var total = (amount * json.amount_ngn_buy);
      //alert(total.toFixed(3));
      label.val(total.toFixed(3));
     });
 });

  $("#ngn_amount").on("input", function (e) {
    var amount = this.value;
    var label = $('#amount_usd');
    $.getJSON('get_exchange_rate', function (json) {
      var total = amount/(json.amount_ngn_buy);
      //alert(total.toFixed(3));
      label.val(total.toFixed(3));
     });
  });


        $("#amount_usd1").on("input", function (e) {
    var amount = this.value;
    var label = $('#ngn_amount1');
    $.getJSON('get_exchange_rate', function (json) {
      var total = (amount * json.amount_ngn_sell);
      //alert(total.toFixed(3));
      label.val(total.toFixed(3));
     });
 });

  $("#ngn_amount1").on("input", function (e) {
    var amount = this.value;
    var label = $('#amount_usd1');
    $.getJSON('get_exchange_rate', function (json) {
      var total = amount/(json.amount_ngn_sell);
      //alert(total.toFixed(3));
      label.val(total.toFixed(3));
     });
  });

    </script>
