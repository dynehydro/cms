<?php
include("includes.php");
$post = new Posts($connDb);
?>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="assets/styles.css" />
</head>
<body>
    <div id="wrapper">
        <div class="header">
        </div>
        <div class="wrapper">
            <div class="left-sidebar">
                <div class="login-box">
                    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'invalid-login'): ?>
                        <div class="error">Invalid username or password</div>
                    <?php endif; ?>
                    <form method="post" action="actions/user_accounts_actions.php">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username...">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password...">
                        <input type="submit" value="Login" name="login">
                        <input type="reset" value="Reset">
                    </form>
                    <a href="register.php"></a>
                </div>
            </div>
            <div class="container">
                <h3>Welcome</h3>
                <a href="index.php">Home</a><a href="register.php">Register</a>
                <table border="0" cellpadding="2"  cellspacing="2" width="100%">
                    <tbody>
                        <?php $post->myPosts()?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
