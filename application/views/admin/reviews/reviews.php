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
        <h1 class="page-header">Материалы</h1>
        <p></p>
      </div>
    </div>
    <!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a href="keme/reviews">Мои материалы</a></li>
              <li><a href="/keme/reviews/add">Добавить материал</a></li>
            </ul>
            <div class="tab-content">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Дата добавления</th>
                    <th scope="col">Редактировать</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($query as $item) : ?>
                    <tr>
                      <th scope="row"><?php echo $item->id; ?></th>
                      <td><a href="/reviews/<?php echo $item->category_alias . '/' . $item->alias; ?>"><?php echo $item->name; ?></a></td>
                      <td><?php echo $item->created_date; ?></td>
                      <td><a href="/keme/reviews/edit/<?php echo $item->id ?>">Изменить</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>