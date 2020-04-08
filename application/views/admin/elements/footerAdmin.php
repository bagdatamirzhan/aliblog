<script src="<?php echo base_url(); ?>templates/admin/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/chart.min.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/chart-data.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/easypiechart.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/easypiechart-data.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script>
  window.onload = function() {
    var chart1 = document.getElementById("line-chart").getContext("2d");
    window.myLine = new Chart(chart1).Line(lineChartData, {
      responsive: true,
      scaleLineColor: "rgba(0,0,0,.2)",
      scaleGridLineColor: "rgba(0,0,0,.05)",
      scaleFontColor: "#c5c7cc"
    });
  };

  $(document).ready(function() {
    $('#short_text').summernote({
      height: 200, // set editor height
      minHeight: null,
      maxHeight: null,
      toolbar: [
        ['font', ['bold', 'underline', 'clear']],
        ['para', ['ul']]
      ],
      callbacks: {
        onPaste: function(e) {
          var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
          e.preventDefault();
          document.execCommand('insertText', false, bufferText);
        }
      }
    });
  });
</script>

</body>

</html>