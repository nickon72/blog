<?php $this->layout('layout') ?>
<!--start wrapper-->
<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Вы здесь:</li>
                            <li><a href="/">Поиск</a></li>
                            <li></li>
                        </ul>
                    </nav>

                    <div class="page_title">
                        <h2>Поиск</h2>
                        <!--<span class="sub_heading">We are here for you 24/7</span>-->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="content blog">
    <div class="container">
    <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <div class="blog_medium">
             <?php echo flash(); ?>
             <hr>
            <?php foreach($posts as $post):?>
                  <h4>
                      <a href="/single_post/<?=$post['slug'];?> " target="_blank"><?=$post['title'];?></a>
                  </h4>
             <hr>
            <?php endforeach;?>
        </div>

    </div>
            <?php include("sidebar.php"); ?>

    </div><!--/.row-->
    </div> <!--/.container-->
    </section>

</section>
<!--end wrapper-->





