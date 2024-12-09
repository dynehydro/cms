<?php

include_once '../includes.php';

$user_accounts = new User_account($connDb);

if (@$_POST["register"]) {
    if (
        empty($_POST["username"]) ||
        empty($_POST["user_display_name"]) ||
        empty($_POST["user_email_address"]) ||
        empty($_POST["user_password"])
    ) {
        header("location: ../register.php?msg=required-fields");
        exit();
    } else {
        $count = $user_accounts->checkEmail($_POST["user_email_address"]);
        if ($count > 0) {
            header("location: ../register.php?msg=duplicate-email");
            exit();
        }
        
        $salt = uniqid();
        
        $user_accounts->username = $_POST["username"];
        $user_accounts->user_display_name = $_POST["user_display_name"];
        $user_accounts->user_email_address = $_POST["user_email_address"];
        $user_accounts->user_salt = $salt;
        $user_accounts->user_password = md5($salt . "." . $_POST["user_password"]);
        $user_accounts->save();
        
        header("location: ../register.php?msg=register-successful");
        exit();
    }
} else if (@$_POST["login"]) {
    $validate = $user_accounts->validateUser($_POST["username"], $_POST["password"]);
    if ($validate == true) {
        header("location: ../dashboard.php");
        exit();
    } else {
        header("location: ../index.php?msg=invalid-login");
        exit();
    }
}