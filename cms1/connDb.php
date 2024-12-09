<?php
// Create connection to the database
$connDb = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) 
    or die(mysqli_connect_error());
