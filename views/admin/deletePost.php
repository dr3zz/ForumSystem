
<div class="new-post">


    <form method="post" action="/admin/deletePost" class="form-horizontal form-color">
        <legend><h1>Confirm delete</h1></legend>

        <fieldset>
            <?php if($this->answersCount > 0) : ?>
            <div class="form-group">
                <p class="col-lg-10 col-lg-offset-2">This question have <?php echo $this->answersCount ?> answers,they will also be deleted</p>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-4">
                    <input type="submit" class="btn btn-danger" value="DELETE">
                    <a href="/admin/posts" class="btn btn-default">Cancel</a>
                </div>
            </div>


        </fieldset>
    </form>
</div>


