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
<div class="login">
    <h1>Leave Comment</h1>
    <form action="/questions/addComment" method="POST" class="form-horizontal">
        <fieldset>
            <div class="form-group">
                <label for="name" class="col-lg-4 control-label">name:</label>
                <div class="col-lg-8">
                    <input type="text" name="name" class="form-control" id="name" placeholder="name...">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-4 control-label">email:</label>
                <div class="col-lg-8">
                    <input type="email" name="email" class="form-control" id="email" placeholder="email">
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-lg-4 control-label">Content:</label>

                <div class="col-lg-8">
                    <textarea rows="10" cols="70" id="content" class="form-control" name="content" "></textarea>
                </div>
            </div>
            <input type="hidden" name="id">
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken'] ?>">
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-6">
                    <input type="submit" class="btn btn-primary" value="Post">
                    <a href="/" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </fieldset>
    </form>
</div>