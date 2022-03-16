<div class="col-lg-12 col-md-12 col-sm-12">
    <ul class="pagination pull-left mrgt-0">
        <li><a href="<?=$paginator->getPrevUrl()?>">&laquo;</a></li>
        <?php foreach ($paginator->getPages() as $page): ?>

         <?php   if($page['isCurrent']): ?>
            <li class="active">
         <?php else: ?>
            <li>
         <?php endif;?>
            <a href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
        </li>
        <?php endforeach; ?>
        <li><a href="<?=$paginator->getNextUrl()?>">&raquo;</a></li>
    </ul>
</div>

