<main class="container">
  <!-- Рекламный блок 1 -->
  <div class="">
    <!-- <?php $this->load->view('elements/banner_top'); ?> -->
    <!-- <?php $this->load->view('elements/breadcrumbs'); ?> -->
  </div>
  <!-- Конец рекламного блока 1 -->
  <div class="row">
    <!-- Контент -->
    <div class="col-lg-9 mb-4">
      <div class="panel mb-4">
        <h1 class="">Обзоры магазина</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis, vitae. Doloribus ullam error voluptatum placeat, totam voluptates quo temporibus corporis necessitatibus itaque fugit consectetur nobis similique est! Facilis, ducimus nostrum!</p>
      </div>
      <div class="row row-cols-1 row-cols-md-3">
        <?php foreach ($query as $item) : ?>
          <div class="col mb-4">
            <div class="card">
              <div class="image-container">
                <?php
                $path = 'images/reviews/' . $item->id; // задаем путь до сканируемой папки с изображениями
                if (is_dir($path)) { // если папка существует
                  $images = scandir($path); // сканируем папку
                  if ($images !== false) { // если нет ошибок при сканировании
                    if (count(glob("$path/*")) != 0) { // если изображения найдены
                      $firstFile = $images[2]; // записываем первое изображение
                      echo '<a href="/reviews/' . $item->category_alias . '/' . $item->alias . '">';
                      echo '<img src="/' . $path . '/' . $firstFile . '" class="card-img-top" alt="...">';
                      echo '</a>';
                    } else { // если изображения не найдены
                      echo '<a href="/reviews/' . $item->category_alias . '/' . $item->alias . '">';
                      echo '<img src="/images/no-photo.jpg" class="card-img-top" alt="No photo" />';
                      echo '</a>';
                    }
                  } else { // если ошибка при сканировании
                    echo '<a href="/reviews/' . $item->category_alias . '/' . $item->alias . '">';
                    echo '<img src="/images/no-photo.jpg" class="card-img-top" alt="No photo" />';
                    echo '</a>';
                  }
                } else { // если отсутствует папка
                  echo '<a href="/reviews/' . $item->category_alias . '/' . $item->alias . '">';
                  echo '<img src="/images/no-photo.jpg" class="card-img-top" alt="No photo" />';
                  echo '</a>';
                }
                ?>
                <div class="price-block"></div>
                <div class="shop-block"><?php echo preg_replace("/[^0-9]/", '', $item->price); ?>$ на <?php echo $item->shop_name; ?></div>
                <div class="title-block">
                  <h2><a href="/reviews/<?php echo $item->category_alias . '/' . $item->alias; ?>"><?php echo $item->name; ?></a></h2>
                </div>
              </div>

              <!-- <div class="card-body">
                <h5 class="card-title"></h5>
                <h6 class="card-subtitle mb-2 text-muted"><small><i class="far fa-shopping-cart"></i> Цена:  на </small></h6>
                <p class="card-text"><?php echo $item->short_text; ?></p>
                <p class="card-text"><small class="text-muted">Добавлено: <?php echo date('d.m.Y', strtotime($item->created_date)); ?></small></p>
                <a href="/reviews/<?php echo $item->category_alias . '/' . $item->alias; ?>" class="btn btn-primary">Подробнее</a>
              </div> -->
            </div>
          </div>
        <?php endforeach; ?>

      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php echo $pagination; ?>
        </ul>
      </nav>
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