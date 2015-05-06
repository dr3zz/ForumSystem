<!--<h1>Submit new Question</h1>-->
<!---->
<!--<form method="post" action="/questions/create">-->
<!--    Title: <input type="text" name="title">-->
<!--    <br/>-->
<!--    Text: <textarea id="" name="content" rows="10" cols="70"></textarea>-->
<!--    <br/>-->
<!--    category:-->
<!--    <select name="category">-->
<!--        <option disabled selected value="0">Select Category</option>-->
<!--        --><?php // foreach($this->categories as $category) : ?>
<!--        <option value="--><?php //echo $category['id'] ?><!--">--><?php //echo htmlentities($category['name']) ?><!--</option>-->
<!--        --><?php //endforeach ;?><!--1-->
<!--    </select>-->
<!--    <br/>-->
<!--    --><?php //foreach($this->tags as $tag) : ?>
<!--        --><?php //echo htmlentities($tag['name']) ?><!--<input name="check_tags[]" type="checkbox" value="--><?php //echo $tag['id'] ?><!--">-->
<!--    --><?php //endforeach ; ?>
<!--    <input type="submit" value="Create">-->
<!--</form>-->
<div class="new-post">
    <h1>Add new Question</h1>
    <form method="post" action="/questions/create" class="form-horizontal ">
        <fieldset>
            <div class="form-group">
                <label for="title" class="col-lg-4 control-label">Title:</label>

                <div class="col-lg-8">
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title...">
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-lg-4 control-label">Content:</label>

                <div class="col-lg-8">
                    <textarea rows="10" cols="70" id="content" class="form-control" name="content" "></textarea>
                </div>
            </div>
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken'] ?>">

            <div class="form-group">
                <label for="category" class="col-lg-4 control-label">Category</label>

                <div class="col-lg-8">
                    <select class="form-control" name="category" id="category">
                        <option disabled selected value="0">Select Category</option>
                        <?php foreach ($this->categories as $category) : ?>
                            <option
                                value="<?php echo $category['id'] ?>"><?php echo htmlentities($category['name']) ?></option>
                        <?php endforeach; ?>1
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="tag" class="col-lg-4 control-label">Tags</label>

                <div class="col-lg-8">
                    <select multiple="" name="check_tags[]" id="tag" class="form-control">
                        <?php foreach ($this->tags as $tag) : ?>
                            <option value="<?php echo $tag['id'] ?>"><?php echo htmlentities($tag['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-6">
                    <input type="submit" class="btn btn-primary" value="Post">
                    <a href="/" class="btn btn-default">Cancel</a>
                </div>
            </div>

        </fieldset>
    </form>
</div>

