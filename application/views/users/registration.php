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
      <h2>Регистрация</h2>

      <!-- Status message -->
      <?php
      if (!empty($success_msg)) {
        echo '<p class="status-msg success">' . $success_msg . '</p>';
      } elseif (!empty($error_msg)) {
        echo '<p class="status-msg error">' . $error_msg . '</p>';
      }
      ?>

      <!-- Registration form -->
      <div class="col-lg-5 mt-4">
        <form action="" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Введите имя" value="<?php echo !empty($user['username']) ? $user['username'] : ''; ?>" required>
            <?php echo form_error('username', '<p class="help-block">', '</p>'); ?>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Введите e-mail" value="<?php echo !empty($user['email']) ? $user['email'] : ''; ?>" required>
            <?php echo form_error('email', '<p class="help-block">', '</p>'); ?>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Введите пароль" required>
            <?php echo form_error('password', '<p class="help-block">', '</p>'); ?>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="conf_password" placeholder="Повторите пароль" required>
            <?php echo form_error('conf_password', '<p class="help-block">', '</p>'); ?>
          </div>
          <div class="send-button">
            <input type="submit" class="btn btn-primary" name="signupSubmit" value="Зарегистрироваться">
          </div>
        </form>
        <p class="mt-4">Уже есть аккаунт? <a href="<?php echo base_url('users/login'); ?>">Войдите</a></p>
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