<form>
    <h2><?php echo $post['title'] ?></h2>
    <span><?php echo $post['pub_date'] ?></span>
    <span><?php echo $post['description'] ?></span>
    <textarea cols="80" rows="10" style="border: none;" >
        <?php echo $post['full_text'] ;?>
    </textarea>
</form>