<h1>POSTS EDIT</h1>
<?php  foreach ($this->questions as $question) : ?>

    <div class="post beforepagination">
        <div class="topwrap">
            <div class="userinfo pull-left">
                <div><?php echo htmlentities($question['username']);?></div>
            </div>
            <div class="posttext pull-left">
                <h2><?php echo htmlentities($question['title']); ?></h2>
                <p><?php echo htmlentities($question['content']); ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="postinfobot">
            <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on : <?php echo htmlentities(date("F d, Y", strtotime($question['created_at'])));?></div>
            <div class="next pull-right">
                <a href="/admin/deletePost/<?php echo htmlentities($question['id']);?>" class="btn btn-danger">DELETE</a>
            </div>
            <div class="next pull-right">
                <a href="/admin/editPost/<?php echo htmlentities($question['id']);?>" class="btn btn-warning">EDIT</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php endforeach; ?>

<?php if (count($this->pagination) > 1) : ?>
    <div class="centered">
        <ul class="pagination">
            <?php if($this->pageId > 1): ?>
                <li class=""><a href="/admin/posts/<?= $this->pageId -1 ?>">&lt;</a></li>
            <?php endif;?>
            <?php foreach ($this->pagination as $id) : ?>

                <?php if ($this->pageId == $id): ?>
                    <li class="active"><span><?= $id ?></span></li>
                    <?php ?>
                <?php else: ?>
                    <li><a href="/admin/posts/<?= $id ?>"><?= $id ?></a></li>
                <?php endif; ?>

            <?php endforeach; ?>
            <?php if($this->pageId < count($this->pagination)): ?>
                <li class=""><a href="/admin/posts/<?= $this->pageId +1 ?>">&gt;</a></li>
            <?php endif;?>
        </ul>
    </div>

<?php endif ?>