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
      <h1 class="page-header">Редактировать материал</h1>
      <p></p>
    </div>
  </div>
  <!--/.row-->

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body tabs">
          <ul class="nav nav-tabs">
            <li class="active"><a href="/keme/reviews">Мои материалы</a></li>
            <li><a href="/keme/reviews/add">Добавить материал</a></li>
          </ul>
          <div class="tab-content">
            <!-- Status message -->
            <?php
            if (!empty($success_msg)) {
              echo '<p class="status-msg success">' . $success_msg . '</p>';
            } elseif (!empty($error_msg)) {
              echo '<p class="status-msg error">' . $error_msg . '</p>';
            }
            ?>

            <div class="mt-4">
              <ul class="nav nav-pills">
                <li>
                  <a class="nav-link" href="/keme/reviews/edit/<?php echo $this->uri->segment(4); ?>">Шаг 1 — Описание</a>
                </li>
                <li class="active">
                  <a class="nav-link">Шаг 2 — Изображения</a>
                </li>
              </ul>
              <br>
              <?php echo form_open_multipart('keme/reviews/images/' . $this->uri->segment(4), array('class' => 'form-group')); ?>
              <input class="form-control" name="userfile[]" id="userfile" type="file" multiple="" />
              <input class="btn btn-primary" type="submit" value="Загрузить" />
              <?php echo form_close(); ?>

              <div class="mt-4"></div>
              <?php if (!empty($images)) : ?>
                <ul>
                  <?php foreach ($images as $image) : ?>
                    <li>
                      <a href="/images/reviews/<?php echo $this->uri->segment(4) . '/' . $image; ?>" target="_blank"><?php echo $image; ?></a>
                      [ <a href="/">удалить</a> ]
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php else : ?>
                <p>Изображений нет.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>