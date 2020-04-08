<main class="container">
  <!-- Рекламный блок 1 -->
  <div class="">
    <!-- <?php $this->load->view('elements/banner_top'); ?> -->
    <?php $this->load->view('elements/breadcrumbs'); ?>
  </div>
  <!-- Конец рекламного блока 1 -->
  <div class="row">
    <!-- Контент -->
    <div class="col-lg-9 mb-4">
      <h1>Категории обзоров</h1>
      <div class="mt-4">
        <div class="d-flex flex-wrap">
          <?php foreach ($query as $category) : ?>
            <div class="col-lg-6">
              <p>
                <a href="/reviews/<?= $category->alias ?>"><b><?= $category->name ?></b></a>
              </p>
              <p>
                <?php foreach ($category->sub as $subcategory) : ?>
                  <a href="/reviews/<?= $subcategory->alias ?>"><?= $subcategory->name ?></a>
                <?php endforeach; ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
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