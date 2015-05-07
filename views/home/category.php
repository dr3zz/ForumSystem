<div class="content">
    <div class="row">
        <div class="col-sm-8">
            <?php foreach ($this->questions as $question) : ?>

                <!-- POST -->
                <div class="post">
                    <div class="wrap-ut pull-left">
                        <div class="userinfo pull-left">
                            <div class="avatar">
                                <img src="/content/images/avatar.jpg" alt=""/>

                                <div class="status green"><a
                                        href="#"><?php echo htmlentities($question['username']); ?></a></div>
                            </div>


                        </div>
                        <div class="posttext pull-left">
                            <h2>
                                <a href="/questions/view/<?php echo $question['id'] ?> "><?php echo htmlspecialchars($question['title']); ?></a>
                            </h2>

                            <p/><?php echo htmlentities($question['content']); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="postinfo pull-left">
                        <div class="comments">
                            <div class="commentbg">
                                <?php echo htmlentities($question['answersCount']) ?>
                                <div class="mark"></div>
                            </div>
                        </div>
                        <div class="views"><i class="fa fa-eye"></i> <?php echo htmlentities($question['visits']); ?>
                        </div>
                        <div class="time"><i
                                class="fa fa-clock-o"></i><?php echo htmlentities(date("F d, Y", strtotime($question['created_at']))); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php endforeach; ?>
            <?php if (count($this->pagination) > 1) : ?>
                <ul class="pagination">
                    <?php foreach ($this->pagination as $id) : ?>
                        <?php if ($this->pageId == $id): ?>
                            <li class="active"><a href="/home/category/<?= $this->categoryId . '/' ?><?= $id ?>"><?= $id ?></a></li>
                            <?php ?>
                        <?php else: ?>
                            <li><a href="/home/category/<?= $this->categoryId . '/' ?><?= $id ?>"><?= $id ?></a></li>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </ul>
            <?php endif ?>

            <!-- POST -->
        </div>

        <div class="col-sm-4">
            <div class="sidebarblock">
                <h3>Categories</h3>

                <div class="divline"></div>
                <div class="blocktxt">
                    <ul class="cats">
                        <li><a href="/">ALL</li>
                        <?php foreach ($this->categories as $category) : ?>
                            <li>
                                <a href="/home/category/<?php echo $category['id'] ?>"><?php echo htmlentities($category['name']) ?>
                                    <span class="badge pull-right"><?php echo htmlentities($category['count']) ?></span></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
