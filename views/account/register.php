<div class="register">
    <h1>Register</h1>
    <form action="/account/register" method="POST" class="form-horizontal">
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
            <div class="form-group">
                <label for="email" class="col-lg-4 control-label">email:</label>
                <div class="col-lg-8">
                    <input type="text" name="email" class="form-control" id="email" placeholder="email...">
                </div>
            </div>
            <div class="form-group">
                <label for="firstName" class="col-lg-4 control-label">First Name:</label>
                <div class="col-lg-8">
                    <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name...">
                </div>
            </div>
            <div class="form-group">
                <label for="lastName" class="col-lg-4 control-label">Last Name:</label>
                <div class="col-lg-8">
                    <input type="text" name="firstName" class="form-control" id="lastName" placeholder="Last Name...">
                </div>
            </div>
            <input type="hidden" name="formToken" value="<?php echo $_SESSION['formToken'] ?>">
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-6">
                    <input type="submit" class="btn btn-primary" value="Register">
                    <a href="/account/login" class="btn btn-default">Go Login</a>
                </div>
            </div>
        </fieldset>
    </form>

</div>
