<h2 class="centered"><?= htmlentities($this->question['title']) ?></h2>
<div class="post">
    <div class="wrap-ut pull-left">
        <div class="userinfo pull-left">
            <div class="avatar">
                <img src="/content/images/registerd-user.jpg" alt="">

                <div class="status green"><a href="#"><?php echo htmlentities($this->question['username']) ?></a></div>
            </div>
        </div>
        <div class="posttext pull-left">


            <p><?= htmlentities($this->question['content']) ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="postinfo pull-left">
        <div class="time"><i
                class="fa fa-clock-o"></i><?php echo htmlentities(date("F d, Y", strtotime($this->question['created_at']))); ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php if (!empty($this->answers)) : ?>
    <?php foreach ($this->answers as $answer) : ?>

        <div class="comment">
            <div class="wrap-ut pull-left">
                <div class="userinfo pull-left">
                    <div class="status green"><a href="#"><?php echo htmlentities($answer['name']) ?></a></div>
                    <div class="avatar">
                        <?php if ($answer['is_registered'] == 0) : ?>
                            <img src="/content/images/default_avatar_visitor.gif" alt="visitor">
                        <?php else : ?>
                            <img src="/content/images/registerd-user.jpg" alt="">
                        <?php endif; ?>

                    </div>
                </div>
                <div class="posttext pull-left">


                    <p><?= htmlentities($answer['comment']) ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="postinfo pull-left">
                <div class="time"><i
                        class="fa fa-clock-o"></i><?php echo htmlentities(date("F d, Y", strtotime($this->question['created_at']))); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<div class="answer-form">
    <h1>Leave Comment</h1>

    <form action="/questions/addAnswer" method="POST" class="form-horizontal">
        <fieldset>
            <?php if (!$this->isLoggedIn) : ?>
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
            <?php endif; ?>
            <div class="form-group">
                <label for="content" class="col-lg-4 control-label">Comment:</label>

                <div class="col-lg-8">
                    <textarea rows="10" cols="70" id="content" class="form-control" name="comment" "></textarea>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo htmlentities($this->question['id']);
            $_SESSION['questionId'] = $this->question['id'] ?>">
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