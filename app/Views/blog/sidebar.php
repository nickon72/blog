<!--Sidebar Widget-->
<div class="col-xs-12 col-md-4 col-lg-4 col-sm-4">
    <div class="sidebar">
        <div class="widget widget_search">
            <div class="site-search-area">
                <form method="get" id="site-searchform" action="/search">
                    <div>
                        <input class="input-text" name="word" id="s" placeholder="Введите ключевые слова для поиска ..." type="text" />
                        <input id="searchsubmit" value="Search" type="submit" />
                    </div>
                </form>
            </div><!-- end site search -->
        </div>

<div class="widget widget_categories">
    <div class="widget_title">
        <h4><span>Категории</span></h4>
    </div>
    <ul class="arrows_list list_style">
        <?php foreach($category_count as $cat_count): ?>
            <li><a href="/blog/<?=$cat_count['slug'];?>"><?=$cat_count['title'];?>(<?=$cat_count['count'];?>)</a></li>
        <?php endforeach; ?>
    </ul>
</div>



        <div class="velocity-tab sidebar-tab">
            <ul  class="nav nav-tabs">
                <li class="active"><a href="#Popular" data-toggle="tab">Популярный</a></li>
                <li class=""><a href="#Recent" data-toggle="tab">Последний</a></li>
                <li class="last-tab"><a href="#Comment" data-toggle="tab"><i class="fa fa-comments-o"></i></a></li>
            </ul>

            <div class="tab-content clearfix">
                <div class="tab-pane fade active in" id="Popular">
                    <ul class="recent_tab_list">
                        <?php foreach($popular_posts as $popular): ?>
                        <li>
                            <span><a href="/single_post/<?=$popular['slug'];?>""><img src="<?=getImage($popular['image']);?>" width="60" alt="" /></a></span>
                            <a href="/single_post/<?=$popular['slug'];?>"><?=$popular['title'];?></a>
                            <i><?=$popular['date'];?></i>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="tab-pane fade" id="Recent">
                    <ul class="recent_tab_list">
                        <?php foreach($recent_posts as $recent): ?>
                        <li>
                            <span><a href="/single_post/<?=$recent['slug'];?>"><img src="<?=getImage($recent['image']);?>" width="60" alt="" /></a></span>
                            <a href="/single_post/<?=$recent['slug'];?>"><?=$recent['title'];?></a>
                            <i><?=$recent['date'];?></i>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="Comment">
                    <ul class="comments">
                        <?php foreach($comment_posts as $comment): ?>
                        <li class="comments_list clearfix">
                            <a class="post-thumbnail" href="/single_post/<?=getPostSlug($comment['post_id']);?>"><img width="60" height="60" src="<?=getImage(getUserAvatar($comment['user_id']));?>" alt="#"></a>
                            <p><strong><a href="/single_post/<?=getPostSlug($comment['post_id']);?>"><?=getUserName($comment['user_id'],'2');?></a> <i>говорит: </i> </strong>
                                <a href="/single_post/<?=getPostSlug($comment['post_id']);?>"> <?=$comment['text']; ?></p></a>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>

        <div class="widget widget_tags">
            <div class="widget_title">
                <h4><span>Tags Widget</span></h4>
            </div>
            <ul class="tags">
                <?php foreach($tags as $tag): ?>
                <li><a href="/blog/tags_post/<?=$tag['slug'];?>"><b><?=$tag['title'];?></b></a></li>
                <?php endforeach; ?>

            </ul>
        </div>




    </div>
</div>
