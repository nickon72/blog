<?= $this->layout('admin/layout'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="/admin/tags/create" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($tags as $tag):?>
                    <tr>
                        <td><?= $tag['id'];?></td>
                        <td><?= $tag['title'];?></td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="/admin/tags/<?= $tag['id'];?>/edit" class="btn btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="/admin/tags/<?= $tag['id'];?>/delete" class="btn btn-danger" onclick="return confirm('Вы уверены?');">
                                <i class="fa fa-remove"></i>
                            </a>
                            </a>

                        </td>
                    </tr>
                <?php endforeach;?>

                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
