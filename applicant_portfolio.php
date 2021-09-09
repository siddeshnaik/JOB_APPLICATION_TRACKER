<?php

// connecting to data base
$conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

//check connection
if(!$conn){
    echo 'connection error'.mysqli_connect_error();
}

$current_login_email_id = '';

session_start();
$current_login_email_id = $_SESSION['email'];

if($current_login_email_id = '')
{
    header('Location: sign_in.php');
}




?>
