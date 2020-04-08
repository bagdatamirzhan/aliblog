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
      <h1>Магазины</h1>
      <div class="mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Магазин</th>
              <th scope="col">Обзоры</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($query as $shop) : ?>
              <tr>
                <th scope="row"><?php echo $shop->id; ?></th>
                <td><a href="/shops/<?php echo $shop->alias; ?>"><?php echo $shop->name; ?></a></td>
                <td>NaN</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
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