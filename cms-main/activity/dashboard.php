<?php
include("includes.php");
$post = new Posts($connDb);
session_start();
if (empty($_SESSION["id"])) {
    header("location: index.php");
    exit();
}
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="assets/styles.css" />
</head>
<body>
    <div id="wrapper">
        <div class="header"> </div>
        <div class="wrapper">
            <div class="left-sidebar">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="new-post.php">New post</a></li>
                    <li><a href="logout.php" on Click="return confirm('Are you sure you want to logout?')">Logout</a></li>
                </ul>
            </div>
            <div class="container">
                <h3>Welcome<u><?php echo $_SESSION["user_display_name"] ?></u></h3>
                <h2>My posts</h2>
                <table border="1" cellpadding="2" cellspacing="2" width="100%">
                    <thead>
                        <tr>
                            <th width="80%" align="left">Post name</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $post->getAll() ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
  </body>
</html>