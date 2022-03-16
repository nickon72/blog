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
                  <a href="/admin/subs/create" class="btn btn-success btn-lg">Добавить</a> <br> <br>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Email</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($subs as $subscriber): ?>
                <tr>
                  <td><?=$subscriber['id']; ?></td>
                  <td><?=$subscriber['email'];?>
                  </td>
                  <td>
                      <a href="/admin/subs/<?= $subscriber['id'];?>/delete" class="btn btn-danger" onclick="return confirm('Вы уверены?');">
                          <i class="fa fa-remove"></i>
                      </a>
                   </td>
                </tr>
                <?php endforeach; ?>
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