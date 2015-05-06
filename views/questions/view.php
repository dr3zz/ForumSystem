<h1>VIEW</h1>
<?php  var_dump($this->question); ?>

<div class="post">
    <div class="wrap-ut pull-left">
        <div class="userinfo pull-left">
            <div class="avatar">
                <img src="/content/images/avatar.jpg" alt="">

                <div class="status green"><a href="#">admin</a></div>
            </div>
        </div>
        <div class="posttext pull-left">
            <h2><?= htmlentities($this->question['title']) ?></h2>
            <p><?= htmlentities($this->question['content']) ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="postinfo pull-left">
        <div class="time"><i class="fa fa-clock-o"></i><?php echo htmlentities(date("F d, Y",strtotime($this->question['created_at']))); ?></div>
    </div>
    <div class="clearfix"></div>
</div>