<?php
include("../includes.php");
$posts = new Posts($connDb);

if (isset($_POST["post"])) {
    if (empty($_POST["post_title"]) || empty($_POST["post_content"])) {
        header('location: ../dashboard.php?msg=required-fields');
        exit();
    } else {
        $posts->id = $_POST["id"];
        $posts->post_type_id = $_POST["post_type_id"];
        $posts->post_status_id = $_POST["post_status_id"];
        $posts->post_title = $_POST["post_title"];
        $posts->post_content = $_POST["post_content"];
        $posts->post_date = date("Y-m-d");
        $posts->post_excerpt = $_POST["post_excerpt"];
        $posts->post_author_id = $_POST["post_author_id"];
        $posts->save();

        header('location: ../dashboard.php?msg=save-successful');
        exit();
    }
}

if ($_GET["action"] == "delete") {
    $posts = new Posts($connDb);
    $posts->delete($_GET["post_id"]);
    header('location: ../dashboard.php?msg=delete-successful');
    exit();
}
