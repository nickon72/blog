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
                            <li><a href="/blog">БЛОГ</a><a href="">---<?=$post['title'];?></a></li>
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
        <div class="blog_single">
            <article class="post">
                <?php if($post['image']!= null):?>
                <figure class="post_img">
                    <a href="">
                        <img src="<?=getImage($post['image']);?>" alt="blog post" width="300">
                    </a>
                </figure>
                <?php endif ?>
                <div class="post_date">
                    <span class="day"><?=getDay($post['date']);?></span>
                    <span class="month"><?=getMonth($post['date']);?></span>
                </div>
                <div class="post_content">
                    <div class="post_meta">
                        <h2>
                            <a href=""><?=$post['title'];?></a>
                        </h2>
                        <div class="metaInfo">
                            <span><i class="fa fa-calendar"></i> <a href="#"><?=getDateSintez($post['date']);?></a> </span>
                            <span><i class="fa fa-user"></i><a href="/blog/author/<?=getUserName($post['user_id'],'1');?>"><?=getUserName($post['user_id'],'2');?></a> </span>
                            <span><i class="fa fa-comments"></i> <a href="#"><?=Comments_count($post['id']);?></a></span>
                        </div>
                    </div>
                     <?=$post['content'];?>
                    </div>

            </article>
        </div>

        <!--News Comments-->
        <div class="news_comments">
            <div class="dividerHeading">
                <h4><span>Комментариев: <?=Comments_count($post['id']);?></span></h4>
            </div>
            <div id="comment">
             <ul>
                <?php foreach($comments as $comment): ?>
                    <li class="comment">
                        <div class="avatar"><img alt="" src="<?=getImage(getUserAvatar($comment['user_id']));?>" class="avatar"></div>
                        <div class="comment-container">
                            <h4 class="comment-author"><a href="/blog/author/<?=getUserName($post['user_id'],'1');?>"><?=getUserName($comment['user_id'],'2');?></a></span></h4>
                            <div class="comment-meta"><a href="" class="comment-date link-style1"><?=$comment['created_at'];?></a><a class="comment-reply-link link-style3" href=""></a></div>
                            <div class="comment-body">
                                <p><?=$comment['text'];?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>

              </ul>
            </div>
            <!-- /#comments -->


         <?php if(auth()->isLoggedIn()): ?>
            <div class="dividerHeading">
                <?php echo flash();?>
                <h4><span>Оставьте комментарий</span></h4>
            </div>
       <form action="/single_post/store" method="post" >
            <div class="comment_form">
              <input type="hidden" name="user_id" value="<?=auth()->getUserId();?>">
              <input type="hidden" name="post_id" value="<?=$post['id'];?>">
            </div>
            <div class="comment-box row">
                <div class="col-sm-12">
                    <p>
                        <textarea name="text" class="form-control" rows="6" cols="40" id="comments" placeholder="Сообщение"></textarea>
                    </p>
                </div>
            </div>
            <button class="btn btn-lg btn-default">Отправить комментарий</button>
          </form>
        <?php else: ?>
          <p> Вы не авторизованы и не можете оставить комментарий</p>
         <?php endif ;?>

        </div>
    </div>

        <?php include("sidebar.php"); ?>

    </div><!--/.row-->
    </div> <!--/.container-->
    </section>
