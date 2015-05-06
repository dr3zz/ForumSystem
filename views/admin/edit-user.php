<div class="register">
    <h1>Edit User</h1>
    <form action="/admin/editUser" method="POST" class="form-horizontal">
        <fieldset>
            <div class="form-group">
                <label for="username" class="col-lg-4 control-label">Username:</label>
                <div class="col-lg-8">
                    <input type="text" name="username" class="form-control" id="username" disabled value="<?= htmlentities($this->user['username']) ?>">
                </div>
            </div>
            <input type="hidden" name="id" value="<?= htmlentities($this->user['id'])?>">

            <div class="form-group">
                <label for="email" class="col-lg-4 control-label">email:</label>
                <div class="col-lg-8">
                    <input type="text" name="email" class="form-control" disabled id="email" value="<?= htmlentities($this->user['email']);?> ">
                </div>
            </div>
            <div class="form-group">
                <label for="firstName" class="col-lg-4 control-label">First Name:</label>
                <div class="col-lg-8">
                    <input type="text" name="firstName" class="form-control" id="firstName" value="<?= htmlentities($this->user['first_name']);?> ">
                </div>
            </div>
            <div class="form-group">
                <label for="lastName" class="col-lg-4 control-label">Last Name:</label>
                <div class="col-lg-8">
                    <input type="text" name="lastName" class="form-control" id="lastName" value="<?= htmlentities($this->user['last_name']);?> ">
                </div>
            </div>
            <div class="form-group">
                <label for="isAdmin" class="col-lg-4 control-label">Last Name:</label>
                <div class="col-lg-8">
                    <input type="checkbox" <?php if($this->user['isAdmin'] == 1): echo 'checked' ?>  <?php endif; ?> name="isAdmin" class="form-control" id="lastName" value="<?= htmlentities($this->user['isAdmin']);?> ">
                </div>
            </div>
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken'] ?>">
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-6">
                    <input type="submit" class="btn btn-primary" value="EDIT">
                    <a href="/admin/edit/users" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </fieldset>
    </form>

</div>
