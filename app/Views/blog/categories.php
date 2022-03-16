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
                        <li><a href="/blog">Блог</a>--<a href="/blog/<?=$slug;?>"><?=getCategoryTitle($category['id']);?></a></li>
                        <li></li>
                    </ul>
                </nav>

                <div class="page_title">
                    <h2></h2>
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

        <?php foreach($posts as $post): ?>
            <?php if($post['image']!= null):?>
                <article class="post">
                    <div class="post_date">
                        <span class="day"><?=getDay($post['date']);?></span>
                        <span class="month"><?=getMonth($post['date']);?></span>
                    </div>
                    <figure class="post_img">
                        <a href="/single_post/<?=$post['slug'];?>">
                            <img src="<?=getImage($post['image']);?>" alt="blog post">
                        </a>
                    </figure>
                    <div class="post_content">
                        <div class="post_meta">
                            <h2>
                                <a href="/single_post/<?=$post['slug'];?>"><?=$post['title'];?></a>
                            </h2>
                            <div class="metaInfo">
                                <span><i class="fa fa-user"></i><a href="/blog/author/<?=getUserName($post['user_id'],'1');?>"><?=getUserName($post['user_id'],'2');?></a> </span>
                                <span><i class="fa fa-comments"></i><?=Comments_count($post['id']);?></span>
                            </div>
                        </div>
                        <p><?=$post['description'];?></p>
                        <a class="btn btn-small btn-default" href="/single_post/<?=$post['slug'];?>">Читать далее... </a>

                    </div>
                </article>
            <?php else: ?>
                <article class="post no_images">
                    <div class="post_date">
                        <span class="day"><?=getDay($post['date']);?></span>
                        <span class="month"><?=getMonth($post['date']);?></span>
                    </div>
                    <div class="post_content">
                        <div class="post_meta">
                            <h2>
                                <a href="/single_post/<?=$post['slug'];?>"><?=$post['title'];?></a>
                            </h2>
                            <div class="metaInfo">
                                <span><i class="fa fa-user"></i><a href="/blog/author/<?=getUserName($post['user_id'],'1');?>"><?=getUserName($post['user_id'],'2');?></a> </span>
                                <span><i class="fa fa-comments"></i><?=Comments_count($post['id']);?></span>
                            </div>
                        </div>
                        <p><?=$post['description'];?></p>
                        <a class="btn btn-small btn-default" href="/single_post/<?=$post['slug'];?>">Читать далее...</a>

                    </div>
                </article>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
    <?= paginator($paginator); ?>


</div>
   <?php include("sidebar.php"); ?>


</div><!--/.row-->
</div> <!--/.container-->
</section>

</section>
<!--end wrapper-->



