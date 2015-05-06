<div class="login">
    <h1>Login</h1>
    <form action="/account/login" method="POST" class="form-horizontal">
        <fieldset>
            <div class="form-group">
                <label for="username" class="col-lg-4 control-label">Username:</label>
                <div class="col-lg-8">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username...">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-4 control-label">Password:</label>
                <div class="col-lg-8">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password...">
                </div>
            </div>
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken'] ?>">
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-6">
                    <input type="submit" class="btn btn-primary" value="Login">
                    <a href="/account/register" class="btn btn-default">Go Register</a>
                </div>
            </div>
        </fieldset>
    </form>
</div>