<?= $this->layout('admin/layout'); ?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Изменить статью
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo flash(); ?>
        <form action="/admin/photos/<?=$post['id'];?>/update" method="post" enctype="multipart/form-data">
        <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Обновляем статью</h3>
            <?php echo flash(); ?>
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="<?=$post['title'];?>" name="title">
            </div>
            
            <div class="form-group">
              <img src="<?= getImage($post['image']); ?>" alt="" class="img-responsive" width="200">
              <label for="exampleInputFile">Лицевая картинка</label>
              <input type="file" id="exampleInputFile" name="image">

              <p class="help-block">Какое-нибудь уведомление о форматах..</p>
            </div>
            <div class="form-group">
              <label>Категория</label>
                <select class="form-control" style="width: 100%;" name="category_id">
                    <?php foreach($categories_blog as $category): ?>
                        <option value="<?= $category['id'];?>"><?= $category['title'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label>Теги</label>
                <select class="form-control select" multiple="multiple" style="width: 100%;" name="tag_id[]">
                    <?php foreach($tags as $tag): ?>
                        <option value="<?= $tag['id'];?>"><?= $tag['title'];?></option>
                        <option selected value="<?=$selectedTags;?>"></option>
                    <?php endforeach;?>
            </div>
            <!-- Date -->
            <div class="form-group">
              <label>Дата:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" value="<?=$post['date'];?>" name="date">
              </div>
              <!-- /.input group -->
            </div>

            <!-- checkbox -->
            <div class="form-group">
              <label>
                  <input type="checkbox" class="minimal" name="is_featured" checked="<?=$post['is_featured'];?>">
              </label>
              <label>
                Рекомендовать
              </label>
            </div>
            <!-- checkbox -->
            <div class="form-group">
              <label>
                  <input type="checkbox" class="minimal" name="status" checked="<?=$post['status'];?>">
              </label>
              <label>
                Черновик
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Описание</label>
              <textarea name="description" id="" cols="30" rows="10" class="form-control" ><?=$post['description'];?></textarea>
          </div>
        </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Полный текст</label>
              <textarea name="content" id="" cols="30" rows="10" class="form-control"><?=$post['content'];?></textarea>
          </div>
        </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
