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

            <!-- Adding form -->
            <div class="mt-4">
              <ul class="nav nav-pills">
                <li class="active">
                  <a class="nav-link">Шаг 1 — Описание</a>
                </li>
                <li>
                  <a class="nav-link" href="/keme/reviews/images/<?php echo $user['id']; ?>">Шаг 2 — Изображения</a>
                </li>
              </ul>
              <br>
              <form action="" method="post">
                <div class="form-group">
                  <label>Название обзора *</label>
                  <input type="text" class="form-control" name="name" placeholder="Введите название вашего обзора" value="<?php echo !empty($user['name']) ? $user['name'] : ''; ?>" onKeyUp="translit()" required>
                  <?php echo form_error('name', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                  <input type="hidden" name="alias" value="<?php echo !empty($user['alias']) ? $user['alias'] : ''; ?>" required readonly>
                  <?php echo form_error('alias', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Категория *</label>
                      <select class="form-control" name="category_id" required>
                        <option selected readonly value="">Выберите категорию</option>
                        <?php foreach ($categories as $category) : ?>
                          <option disabled><?php echo $category->name; ?></option>
                          <?php foreach ($category->sub as $subcategory) : ?>
                            <option value="<?php echo $subcategory->id; ?>">&emsp;<?php echo $subcategory->name; ?></option>
                          <?php endforeach; ?>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('link', '<p class="text-danger">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Магазин *</label>
                      <select class="form-control" name="shop_id" required>
                        <option selected disabled value="">Выберите магазин</option>
                        <?php foreach ($shops as $shop) : ?>
                          <option value="<?php echo $shop->id; ?>"><?php echo $shop->name; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('link', '<p class="text-danger">', '</p>'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Стоимость товара *</label>
                      <input type="text" class="form-control" name="price" placeholder="Укажите стоимость" value="<?php echo !empty($user['price']) ? $user['price'] : ''; ?>">
                      <?php echo form_error('price', '<p class="text-danger">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Ссылка на товар *</label>
                      <input type="text" class="form-control" name="link" placeholder="Укажите ссылку" value="<?php echo !empty($user['link']) ? $user['link'] : ''; ?>" required>
                      <?php echo form_error('link', '<p class="text-danger">', '</p>'); ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Описание *</label>
                  <textarea id="short_text" name="short_text"><?php echo !empty($user['short_text']) ? $user['short_text'] : ''; ?></textarea>
                  <?php echo form_error('short_text', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="send-button">
                  <input type="submit" class="btn btn-primary" name="addSubmit" value="Сохранить">
                </div>
              </form>
              <p class="mt-4 text-primary">
                * Поля обязательные к заполнению.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function translit() {
    var str = document.getElementsByName("name")[0].value;
    var space = '-';
    var link = '';
    var transl = {
      'а': 'a',
      'б': 'b',
      'в': 'v',
      'г': 'g',
      'д': 'd',
      'е': 'e',
      'ё': 'e',
      'ж': 'zh',
      'з': 'z',
      'и': 'i',
      'й': 'j',
      'к': 'k',
      'л': 'l',
      'м': 'm',
      'н': 'n',
      'о': 'o',
      'п': 'p',
      'р': 'r',
      'с': 's',
      'т': 't',
      'у': 'u',
      'ф': 'f',
      'х': 'h',
      'ц': 'c',
      'ч': 'ch',
      'ш': 'sh',
      'щ': 'sh',
      'ъ': space,
      'ы': 'y',
      'ь': space,
      'э': 'e',
      'ю': 'yu',
      'я': 'ya'
    }
    if (str != '')
      str = str.toLowerCase();

    for (var i = 0; i < str.length; i++) {
      if (/[а-яё]/.test(str.charAt(i))) { // заменяем символы на русском
        link += transl[str.charAt(i)];
      } else if (/[a-z0-9]/.test(str.charAt(i))) { // символы на анг. оставляем как есть
        link += str.charAt(i);
      } else {
        if (link.slice(-1) !== space) link += space; // прочие символы заменяем на space
      }
    }
    document.getElementsByName("alias")[0].value = link;
    console.log(link);
  }
</script>