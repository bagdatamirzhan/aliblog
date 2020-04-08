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
      <h1 class="page-header">Настройки</h1>
      <p></p>
    </div>
  </div>
  <!--/.row-->

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body tabs">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#">Пользователи</a></li>
            <li><a href="#">Материалы</a></li>
            <li><a href="#">Комментарии</a></li>
          </ul>
          <div class="row tab-content">
            <div class="form-group col-md-4">
              <form>
                <div class="form-group">
                  <label>Роли</label>
                  <select name="role" class="form-control">
                    <?php
                    $roleId = 0;
                    if (isset($_GET['role'])) {
                      $roleId = $_GET['role'];
                    }
                    ?>
                    <option value="" <?php echo ($roleId == 0) ? 'selected' : ''; ?>>Все</option>
                    <option value="1" <?php echo ($roleId == 1) ? 'selected' : ''; ?>>Пользователи</option>
                    <option value="2" <?php echo ($roleId == 2) ? 'selected' : ''; ?>>Сотрудники</option>
                    <option value="3" <?php echo ($roleId == 3) ? 'selected' : ''; ?>>Администраторы</option>
                  </select>
                </div>
            </div>
            <div class="form-group col-md-4">
              <div class="form-group">
                <label for="inputCity">E-mail</label>
                <input type="text" name="email" class="form-control" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : ''; ?>">
              </div>
            </div>
            <div class="form-group col-md-4">
              <input type="submit" class="btn btn-primary" value="Искать">
              </form>
            </div>
            <div class="col-md-12">
              Материалов нет.
            </div>
          </div>
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