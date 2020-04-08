<main class="container">
  <!-- Рекламный блок 1 -->
  <div class="mb-4">
    <!-- <?php $this->load->view('elements/banner_top'); ?> -->
  </div>
  <!-- Конец рекламного блока 1 -->
  <div class="row">
    <!-- Контент -->
    <div class="col-lg-9 mb-4">
      <div class="mb-4">
        <div class="card px-4 py-4">
          <h1 class="display-5">Привет!</h1>
          <p>У нас представлены авторские обзоры на самые популярные товары с различных интернет-магазинов со всего мира. На сегодняшний день интернет-магазины предлагают товары самого разного качества и ценовых диапазонов. Сайт был создан для того, чтобы предупредить людей о качественном или некачественном продукте, соответствует ли он своей цене, не обманывает ли продавец, сколько занимает доставка и т.д.</p>
          <p><a href="https://aliblog.ru/reviews"><b>Каталог обзоров</b></a> представляет собой простой и интуитивно понятный инструмент для поиска необходимых продуктов, разделенных по категориям и магазинам.</p>
          <p>Раздел <a href="https://aliblog.ru/shops"><b>Магазины</b></a> представляет собой простой и интуитивно понятный инструмент для поиска необходимых продуктов, разделенных по категориям и магазинам.</p>
          <p>На странице <a href="https://aliblog.ru/goods"><b>Товары месяца</b></a> вы найдете простой и интуитивно понятный инструмент для поиска необходимых продуктов, разделенных по категориям и магазинам.</p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Каталог обзоров</a>
          </p>
        </div>
      </div>  
      <div class="d-flex justify-content-between mb-4">
        <div>
          <h1>Последние обзоры</h1>
        </div>
        <div>
          <a href="/reviews">Все обзоры</a>
        </div>
      </div>
      <div class="container">
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
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- <div class="row row-cols-1 row-cols-md-2">
          <div class="col mb-4">
            <div class="card">
              <div class="card-block px-2 mt-2">
                <h6 class="card-title"><a href="#">Компактная "4K" WiFi камера U21 с питанием по USB</a></h6>
                <div class="card-subtitle mb-2 text-muted"><small>AliExpress</small></div>
              </div>
              <div class="w-100"></div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card">
              <div class="card-block px-2 mt-2">
                <h6 class="card-title"><a href="#">Компактная "4K" WiFi камера U21 с питанием по USB</a></h6>
                <div class="card-subtitle mb-2 text-muted"><small>AliExpress</small></div>
              </div>
              <div class="w-100"></div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card">
              <div class="card-block px-2 mt-2">
                <h6 class="card-title"><a href="#">Компактная "4K" WiFi камера U21 с питанием по USB</a></h6>
                <div class="card-subtitle mb-2 text-muted"><small>AliExpress</small></div>
              </div>
              <div class="w-100"></div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card">
              <div class="card-block px-2 mt-2">
                <h6 class="card-title"><a href="#">Компактная "4K" WiFi камера U21 с питанием по USB</a></h6>
                <div class="card-subtitle mb-2 text-muted"><small>AliExpress</small></div>
              </div>
              <div class="w-100"></div>
            </div>
          </div>

        </div> -->
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