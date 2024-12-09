<?php


class User_account {
    public $id;
    public $username;
    public $user_email_address;
    public $user_display_name;
    public $user_password;
    public $user_salt;
    public $user_date_registered;

    private $connDb;

    function __construct($connDb) {
        $this->connDb = $connDb;
    }

    function save() {
        try {
            if (empty($this->id)) {
                $sql = "INSERT INTO user_accounts (username, user_email_address, user_display_name, user_password, user_salt) 
                        VALUES ('".$this->username."', '".$this->user_email_address."', '".$this->user_display_name."', '".$this->user_password."', '".$this->user_salt."')";
            } else {
                $sql = "UPDATE user_accounts SET username='".$this->username."', user_email_address='".$this->user_email_address."', 
                        user_display_name='".$this->user_display_name."', user_password='".$this->user_password."', user_salt='".$this->user_salt."' 
                        WHERE id='".$this->id."'";
            }
            mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
        } catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function checkEmail($email) {
        try {
            $sql = "SELECT count(id) FROM user_accounts WHERE user_email_address = '".$email."'";
            $result = mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
            $row = mysqli_fetch_row($result);

            return $row[0];
        } catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getAll() {
        try {
            $sql = "SELECT * FROM user_accounts";
            $result = mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
            $users = [];
            while ($row = mysqli_fetch_object($result)) {
                $users[] = $row;
            }
            return $users;
        } catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getSingle($id) {
        try {
            $sql = "SELECT * FROM user_accounts WHERE id = '".$id."'";
            $result = mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
            return mysqli_fetch_object($result);
        } catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function delete($id) {
        try {
            $sql = "DELETE FROM user_accounts WHERE id = '".$id."'";
            mysqli_query($this->connDb, $sql) or die (mysqli_error($this->connDb));
        } catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function validateUser($username, $password) {
        try {
            $return = false;

            // Check for username and get the salt value
            $sql_set = "SELECT * FROM user_accounts WHERE username = '".$username."'";
            $qry_set = mysqli_query($this->connDb, $sql_set) or die (mysqli_error($this->connDb));
            $row_set = mysqli_fetch_object($qry_set);

            if (!empty($row_set)) {
                // Check for username and password
                $hashed_password = md5($row_set->user_salt . "." . $password);
                $sql_username = "SELECT * FROM user_accounts WHERE username = '".$username."' AND user_password = '".$hashed_password."'";
                $qry_username = mysqli_query($this->connDb, $sql_username) or die (mysqli_error($this->connDb));
                $row_username = mysqli_fetch_object($qry_username);

                if ($qry_username && $row_username) {
                    session_start();
                    $_SESSION['id'] = $row_username->id;
                    $_SESSION['username'] = $row_username->username;
                    $_SESSION['user_display_name'] = $row_username->user_display_name;

                    $return = true;
                }
            }

            return $return;
        } catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

