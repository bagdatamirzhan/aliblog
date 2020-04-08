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
      <h1><?php echo $item['name']; ?></h1>
      <div class="row mt-4">
        <div class="col-lg-5">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php
              $index = 0;
              $li = '';
              $path = 'images/reviews/' . $item['id']; // задаем путь до сканируемой папки с изображениями
              if (is_dir($path)) { // если папка существует
                $images = scandir($path); // сканируем папку
                if ($images !== false) { // если нет ошибок при сканировании
                  $images = preg_grep("/\.(?:png|gif|jpe?g)$/i", $images); // через регулярку создаем массив только изображений
                  if (is_array($images)) { // если изображения найдены
                    foreach ($images as $image) { // делаем проход по массиву
                      $active = ($index == 0) ? 'active' : '';
                      $li .= '<li data-target="#carouselExampleIndicators" data-slide-to="' . $index . '" class="' . $active . '"></li>';
                      $index++;
                    }
                    echo $li;
                  }
                }
              }
              ?>
            </ol>
            <div class="carousel-inner text-center">
              <?php
              $index = 0;
              $wimage = "";
              $fimg = "";
              if (is_dir($path)) { // если папка существует
                if ($images !== false) { // если нет ошибок при сканировании
                  if (is_array($images)) { // если изображения найдены
                    foreach ($images as $image) { // делаем проход по массиву
                      $active = ($index == 0) ? 'active' : '';
                      $fimg .= '
                    <div class="carousel-item ' . $active . '">
                      <a href="modal-' . $index . '" data-toggle="modal" data-target="#modal-' . $index . '">
                        <img class="image-preview" src="/' . $path . '/' . htmlspecialchars(urlencode($image)) . '" alt="' . $image . '" />
                      </a>
                      <div class="modal fade" id="modal-' . $index . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel-' . $index . '" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalLabel-' . $index . '">Изображение товара</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <img class="image-full" src="/' . $path . '/' . htmlspecialchars(urlencode($image)) . '" alt="' . $image . '" />
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>';
                      $index++;
                    }
                    $wimage .= $fimg;
                  } else { // иначе, если нет изображений
                    $wimage .= "<div style='text-align:center'>Не обнаружено изображений в директории!</div>\n";
                  }
                } else { // иначе, если директория пуста или произошла ошибка
                  $wimage .= "<div style='text-align:center'>Директория пуста или произошла ошибка при сканировании.</div>";
                }
              } else {
                $wimage .= "<div style='text-align:center'>Директории не существует.</div>";
              }
              echo $wimage; // выводим полученный результат
              ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true" style="color:#000"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div class="col-lg-7">
          <p><?php echo $item['short_text']; ?></p>
          <p><span class="text-danger font-weight-bold">Цена: <?php echo preg_replace("/[^0-9]/", '', $item['price']); ?>$</span></p>
          <p>
            <a href="/external.php?link=<?php echo $item['link']; ?>" class="btn btn-primary" target="_blank" role="button" aria-pressed="true"><i class="far fa-external-link"></i> Перейти в магазин</a>
            <a href="#" class="btn btn-info" role="button" aria-pressed="true"><i class="fas fa-share"></i> Поделиться</a>
          </p>
          <p class="text-muted"><small><i class="far fa-calendar-alt"></i> Дата добавления: <?php echo date('d.m.Y', strtotime($item['created_date'])); ?></small></p>
          <p class="text-muted"><small><i class="far fa-shopping-cart"></i> Магазин: Aliexpress</small></p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12">
          <h2>Комментарии</h2>
          <div class="alert alert-warning mt-4" role="alert">
            Для того, чтобы добавить отзыв, <a href="<?php echo base_url('users/login'); ?>">войдите</a> или <a href="<?php echo base_url('users/registration'); ?>">зарегистрируйтесь</a>.
          </div>
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