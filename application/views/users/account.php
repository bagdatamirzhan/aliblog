<main class="container">
  <!-- Рекламный блок 1 -->
  <div class="mb-4">
    <!-- <?php $this->load->view('elements/banner_top'); ?> -->
    <?php $this->load->view('elements/breadcrumbs'); ?>
  </div>
  <!-- Конец рекламного блока 1 -->
  <div class="row">
    <!-- Контент -->
    <div class="col-lg-9 mb-4">
      <h2>Личный кабинет</h2>
      <div class="mt-4">
        <?php if ($this->session->userdata('userRole') == '2' || $this->session->userdata('userRole') == '3') : ?>
          <a class="btn btn-success" href="<?php echo base_url('keme'); ?>" target="_blank">KEME Panel</a>
        <?php endif; ?>
        <a class="btn btn-danger" href="<?php echo base_url('users/logout'); ?>" role="button">Выйти</a>
      </div>
      <div class="mt-4">Привет, <?php echo $user['username']; ?>! </div>
      <div>Обзоров: 0</div>
      <div>Комментариев: 0</div>
    </div>
    <!-- Конец контента -->
    <!-- Сайдбар -->
    <div class="col-lg-3">
      <?php $this->load->view('elements/sidebar'); ?>
    </div>
    <!-- Конец сайдбара -->
  </div>
  <!-- Рекламный блок 2 -->
  <div class="mb-4">
    <?php $this->load->view('elements/banner_bottom'); ?>
  </div>
  <!-- Конец рекламного блока 2 -->
</main>