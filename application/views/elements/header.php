<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title><?php echo (isset($title)) ? $title . ' — ' : ''; ?> Aliblog.ru</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
</head>

<body>
  <header class="container">
    <!-- Шапка -->
    <div class="row mt-3 mb-3">
      <div class="col-lg-4">
        <a href="/">
          <img src="/images/logo.png" height="40" />
        </a>
      </div>
      <div class="col-lg-8 text-right">
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="nav-link text-white bg-danger" href="#">
              Верни 6,5% с AliExpress!
            </a>
          </li>

          <?php if ($this->session->userdata('userId')) : ?>
            <?php if ($this->session->userdata('userRole') == '2' || $this->session->userdata('userRole') == '3') : ?>
              <li class="nav-item">
                  <a class="nav-link text-white bg-success" href="<?php echo base_url('keme'); ?>" target="_blank">KEME Panel</a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <span class="nav-link">
                  <a href="<?php echo base_url('users/account'); ?>">Личный кабинет</a> / <a href="<?php echo base_url('users/logout'); ?>">Выйти</a>
                </span>
              </li>
            <?php endif; ?>
          <?php else : ?>
            <li class="nav-item">
              <span class="nav-link">
                <a href="<?php echo base_url('users/login'); ?>">Войти</a> или <a href="<?php echo base_url('users/registration'); ?>">Зарегистрироваться</a>
              </span>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <!-- Конец шапки -->
    <!-- Меню -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo ($this->uri->segment(1) == null) ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>">
              Главная
            </a>
          </li>
          <li class="nav-item <?php echo ($this->uri->segment(1) == 'reviews') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url('reviews'); ?>">
              Каталог обзоров
            </a>
          </li>
          <li class="nav-item <?php echo ($this->uri->segment(1) == 'shops') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url('shops'); ?>">
              Магазины
            </a>
          </li>
          <li class="nav-item <?php echo ($this->uri->segment(1) == 'goods') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url('goods'); ?>">
              Товары месяца
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              Дополнительно
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Кэшбэк</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Отследить посылку</a>
              <a class="dropdown-item" href="#">Проверить продавца</a>
              <a class="dropdown-item" href="#">Вопросы и ответы</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Реклама на сайте</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Поиск по обзорам" aria-label="Search">
          <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Поиск</button>
        </form>
        <!-- <ul class="navbar-nav">
            <span class="nav-item">
              <a href="#"><i class="fab fa-youtube"></i></a>
              <a href="#"><i class="fab fa-vk"></i></a>
              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-telegram"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </span>
          </ul> -->
      </div>
    </nav>
    <!-- Конец меню -->
  </header>