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

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Текст</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>

              <form action="/admin/comments/toggle" method="post">
                <?php foreach($comments as $comment):?>
                <tr>
                   <td><?= $comment['id'];?></td>
                   <td><?= $comment['text'];?>
                   </td>
                   <td>
                  <?php if($comment['status'] == 0): ?>
                       <a href="/admin/comments/toggle_on/<?=$comment['id']?>" class='fa fa-lock'></a>
                  <?php else: ?>
                       <a href="/admin/comments/toggle_off/<?=$comment['id']?>" class='fa fa-thumbs-o-up'></a>
                  <?php endif; ?>
                       <a href="/admin/comments/<?= $comment['id'];?>/delete" onclick="return confirm('Вы уверены?');">
                           &nbsp;&nbsp;	<i class="fa fa-remove"></i>
                       </a>
                       </td>
                </tr>
                  <?php endforeach;?>
                </form>
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
