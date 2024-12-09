<?php
include("includes.php");
$post = new Posts($connDb);
error_reporting(0);
session_start();
if (empty($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/styles.css" />
    </head>
    <body>
        <div id="wrapper">
            <div class="header"></div>
            <div class="wrapper">
                <div class="left-sidebar">
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="new-post.php">New post</a></li>
                        <li><a href="logout.php" onClick="return confirm('Are you sure you want to logout?')">Logout</a></li>
                    </ul>
                </div>
                <div class="container">
                    <h3>Welcome <?php echo $_SESSION["user_display_name"]; ?></h3>
                    <h2>
                        <?php echo ($_GET["action"] == "edit") ? "Edit post" : "New post"; ?>
                    </h2>
                    <?php $detail = $post->getSingle($_GET["post_id"]); ?>
                    <form method="post" action="actions/posts_actions.php">
                        <label class="required">Post title</label><br>
                        <input value="<?php echo $detail["post_title"]; ?>" type="text" name="post_title" class="form-control"><br>
                        <label class="required">Content</label><br>
                        <textarea rows="5" name="post_content" class="form-control"><?php echo $detail["post_content"]; ?></textarea><br>
                        <label>Excerpt</label><br>
                        <input value="<?php echo $detail["post_excerpt"]; ?>" type="text" name="post_excerpt" class="form-control"><br>
                        <input type="hidden" name="post_author_id" value="<?php echo $_SESSION["id"]; ?>">
                        <input type="hidden" name="post_status_id" value="1">
                        <input type="hidden" name="post_type_id" value="1">
                        <?php if (!empty($_GET["post_id"])) { ?>
                            <input type="hidden" name="id" value="<?php echo $_GET["post_id"]; ?>">
                        <?php } ?>
                        <input type="submit" value="Save" name="post">
                        <input type="reset" value="Reset">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
