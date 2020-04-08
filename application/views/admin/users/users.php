<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="#">
          <em class="fa fa-home"></em>
        </a></li>
      <li class="active">Dashboard</li>
    </ol>
  </div>
  <!--/.row-->

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Пользователи</h1>
      <p></p>
    </div>
  </div>
  <!--/.row-->

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body tabs">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#">Все пользователи</a></li>
            <li><a href="#">Рейтинг пользователей</a></li>
          </ul>
          <div class="tab-content">
            Материалов нет.
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<!--/.main-->

<script src="<?php echo base_url(); ?>templates/admin/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/chart.min.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/chart-data.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/easypiechart.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/easypiechart-data.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>templates/admin/js/custom.js"></script>
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
</script>

</body>

</html>