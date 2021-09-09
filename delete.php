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
    $applicant_num=$_SESSION['app_num'];

    $applicant_number='';

    if(isset($_GET['Titleout']))
  {
    

    //print_r(explode(',',$_GET['Title'])[1]);
    $job_title = mysqli_real_escape_string($conn, explode(',',$_GET['Titleout'])[0]);
    //echo $job_title.'<br>';

    $job_department = mysqli_real_escape_string($conn, explode(',',$_GET['Titleout'])[1]);
    //echo $job_department.'<br>';

    $Position_identifier = mysqli_real_escape_string($conn, explode(',',$_GET['Titleout'])[2]);

    $Publish_on = mysqli_real_escape_string($conn, explode(',',$_GET['Titleout'])[3]);

    $Until_date = mysqli_real_escape_string($conn, explode(',',$_GET['Titleout'])[4]);
    //echo $Until_date;

    $sql1="DELETE FROM job_discription WHERE login_email='$current_login_email_id' AND Title='$job_title' AND Position_Identifier='$Position_identifier' AND Department='$job_department' AND Publish_on='$Publish_on' AND Until = '$Until_date' ";

    $sql2 = "DELETE FROM job_applications WHERE login_email='$current_login_email_id' AND Job_Title='$job_title' AND Position_Identifier='$Position_identifier' AND Department='$job_department'  ";
    
    $job_des = '';
    $job_app = '';
    if(mysqli_query($conn,$sql1))
    {
        //success
        $job_des = 'SUCCESS';

    }
    else
    {
        echo 'query error '. mysqli_error($conn);
    }

    if(mysqli_query($conn, $sql2))
    {
        $job_app = 'SUCCESS';
    }
    else
    {
        echo 'query error '. mysqli_error($conn);
    }

    if($job_des==$job_app)
    {
        header('Location: job_page1.php');
    }


    }



    
  

//   $all_applicant = mysqli_fetch_all($results, MYSQLI_ASSOC);

//   mysqli_free_result($results);

//   $results2 = mysqli_query($conn,$sql2);
//   $description_info = mysqli_fetch_all($results2, MYSQLI_ASSOC);


?>
