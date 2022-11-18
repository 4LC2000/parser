<ul>
    <?php foreach($newsList as $news) { ?>
    <li>
        <a href="/?route=post&postId=<?php echo $news['id'] ?>"><?php echo $news['title'] ?></a>
    </li>
    <?php } ?>
</ul>
