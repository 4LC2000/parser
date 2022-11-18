<link rel='stylesheet' href='/resources/css/style.css'>
<form id="post-update" action="/?route=update&postId=<?php echo $_GET['postId'] ?>" method="POST">
    <br><br>
    <label for="title">Title</label>
    <input id="title" value="<?php echo $post['title'] ?>" name="title">
    <br><br>
    <label for="full_text">Full text</label>
    <textarea name="full_text" id="full_text" cols="80" rows="20">
        <?php echo $post['full_text'] ?>
    </textarea>
    <br><br>
    <p>
        Source:
        <?php echo $post['source'] ?>
    </p>
    <br><br>
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="80" rows="20">
        <?php echo $post['description'] ?>
    </textarea>
    <br><br>
    <label for="link">Link</label>
    <input id="link" value="<?php echo $post['link'] ?>" name="link">
    <br><br>
    <label for="category">Category</label>
    <input id="category" value="<?php echo $post['category'] ?>" name="category">
    <br><br>
    <p>
        Pub Date:
    <?php echo $post['pub_date'] ?>
    </p>
    <button form="post-update">Save</button>
</form>