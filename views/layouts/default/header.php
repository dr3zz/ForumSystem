<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($this->title); ?></title>
    <link rel="stylesheet" type="text/css" href="/content/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/content/css/app.css">

    <link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/content/styles.css">
    <script type="text/javascript" src='/content/js/main.js'></script>


    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
</head>
<body>
<div id="wrapper">
    <header>
        <!-- Header -->
        <header id="header">
            <div class="upper_header">
                <img src="/content/images/slide.jpg" alt="Image" title="Image">
            </div>
            <div class="lower_header">
                <!-- Logo -->
                <a href="/" title="Company logo" class="logo">
                    <img src="/content/images/logo.jpg" alt="Company logo" title="Company logo"/>
                </a>
                <!-- /Logo -->
                <div class="btns">
                    <?php if ($this->isLoggedIn) : ?>
                    <div class="post">
                        <?php if ($this->isAdmin) : ?>
                       <a class="btn btn-primary" href="/admin/controlPanel" >Admin Panel</a>
                         <?php endif; ?>
                        <a class="btn btn-primary" href="/questions/create" >Add Question</a>
                        <div id="logged-in-info">
                            <span class="username"
                                  style="margin-right: 10px;">Hello,  <?php echo $_SESSION['user']['username'] ?></span>

                            <form action="/account/logout" method="POST"><input style="margin-right: 10px;"
                                                                                class="btn btn-default" type="submit"
                                                                                value="logout"></form>
                        </div>
                            </div>
                    <?php else : ?>
                        <div id="logged-in-info">
                            <a href="/account/login" class="btn btn-default">Login</a>
                            <a href="/account/register" class="btn btn-default">Register</a>
                        </div>

                    <?php endif; ?>
                </div>

            </div>
        </header>
        <!-- /Header -->
    </header>

    <?php include('messages.php'); ?>

