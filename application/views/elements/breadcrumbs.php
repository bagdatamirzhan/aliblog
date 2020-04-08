<?php
switch ($this->uri->segment(1)) {
  case 'reviews':
    $name_1 = 'Каталог обзоров';
    $slug_1 = $this->uri->segment(1);
    if (!empty($slug_2 = $this->uri->segment(2))) {
      $active_1 = "";
      $name_2 = $this->db->get_where('review_categories', array('alias' => $slug_2))->first_row()->name;
      if (isset($name_2)) {
        if (!empty($slug_3 = $this->uri->segment(3)) && ($this->uri->segment(3) != 'page')) {
          $active_2 = "";
          $name_3 = $this->db->get_where('review_items', array('alias' => $slug_3))->first_row()->name;
          if (isset($name_3)) {
            if (!empty($slug_4 = $this->uri->segment(4))) {
              $active_3 = "";
            } else {
              $active_3 = "active";
            }
          }
        } else {
          $active_2 = "active";
        }
      }
    } else {
      $active_1 = "active";
    }
    break;
  case 'shops':
    $name_1 = 'Магазины';
    $slug_1 = $this->uri->segment(1);
    break;
  case 'goods':
    $name_1 = 'Товары месяца';
    $slug_1 = $this->uri->segment(1);
    break;
  case 'users':
    $name_1 = 'Пользователи';
    $slug_1 = $this->uri->segment(1);
    if (!empty($slug_2 = $this->uri->segment(2))) {
      $active_1 = "";
      switch ($slug_2) {
        case 'login':
          $name_2 = 'Авторизация';
          break;
        case 'registration':
          $name_2 = 'Регистрация';
          break;
        case 'account':
          $name_2 = 'Аккаунт';
          break;
      }
      if (!empty($slug_3 = $this->uri->segment(3))) {
        $active_2 = "";
      } else {
        $active_2 = 'active';
      }
    } else {
      $active_1 = 'active';
    }
    break;
}
?>
<nav aria-label="breadcrumb">
  <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb bg-white">
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
      <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo base_url(); ?>">
        <span itemprop="name">Главная</span>
      </a>
      <meta itemprop="position" content="1" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item <?php echo (!empty($active_1) ? $active_1 : ''); ?>">
      <?php if (!empty($active_1)) : ?>
        <span itemprop="name"><?php echo $name_1; ?></span>
      <?php else : ?>
        <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo base_url() . $slug_1; ?>">
          <span itemprop="name"><?php echo $name_1; ?></span>
        </a>
      <?php endif; ?>
      <meta itemprop="position" content="2" />
    </li>
    <?php if (isset($slug_2)) : ?>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item <?php echo (!empty($active_2) ? $active_2 : ''); ?>">
        <?php if (!empty($active_2)) : ?>
          <span itemprop="name"><?php echo $name_2; ?></span>
        <?php else : ?>
          <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo base_url() . $slug_1 . '/' . $slug_2; ?>">
            <span itemprop="name"><?php echo $name_2; ?></span>
          </a>
        <?php endif; ?>
        <meta itemprop="position" content="3" />
      </li>
    <?php endif; ?>
    <?php if (isset($slug_3)) : ?>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item <?php echo (!empty($active_3) ? $active_3 : ''); ?>">
        <?php if (!empty($active_3)) : ?>
          <span itemprop="name"><?php echo $name_3; ?></span>
        <?php elseif (isset($name_3)) : ?>
          <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo base_url() . $slug_1 . '/' . $slug_2 . '/' . $slug_3; ?>">
            <span itemprop="name"><?php echo $name_3; ?></span>
          </a>
        <?php endif; ?>
        <meta itemprop="position" content="4" />
      </li>
    <?php endif; ?>
  </ol>
</nav>