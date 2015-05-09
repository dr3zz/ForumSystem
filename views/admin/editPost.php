
<div class="new-post">
    <h1>EDIT Question</h1>

    <form method="post" action="/admin/editPost" class="form-horizontal ">

        <fieldset>

            <div class="form-group">
                <label for="title" class="col-lg-4 control-label">Title:</label>

                <div class="col-lg-8">
                    <input type="text"  value="<?php echo htmlentities($this->post['title']); ?>" name="title" class="form-control" id="title" placeholder="Title...">
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-lg-4 control-label">Content:</label>

                <div class="col-lg-8">
                    <textarea rows="10" cols="70" id="content" class="form-control" name="content" "><?php echo htmlentities($this->post['content']); ?></textarea>
                </div>
            </div>
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken'] ?>">
            <input type="hidden" name="postId" value="<?php echo $this->post['id']; ?>" >

            <div class="form-group">
                <label for="category" class="col-lg-4 control-label">Category</label>

                <div class="col-lg-8">
                    <select class="form-control" name="category" id="category">

                        <?php foreach ($this->categories as $category) : ?>
                            <option <?php if($category['id'] == $this->post['category_id']) : ?>
                                selected = "<?php echo $category['id'];  endif; ?>"
                                value="<?php echo $category['id'] ?>"><?php echo htmlentities($category['name']) ?></option>
                        <?php endforeach; ?>1
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-6">
                    <input type="submit" class="btn btn-warning" value="EDIT">
                    <a href="/admin/posts" class="btn btn-default">Cancel</a>
                </div>
            </div>

        </fieldset>
    </form>
</div>

