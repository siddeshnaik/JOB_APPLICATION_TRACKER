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

//echo $application_number; 


//echo $current_login_email_id;

if($current_login_email_id = '')
{
    header("Location: sign_in.php");
}

    $update_error  = array('Interview_stage'=>'','interview_date'=>'','interview_time'=>'');

if(isset($_POST['submit']))
    {

        // echo $_POST['Interview_stage'];
        // echo $_POST['interview_date'];
        // echo $_POST['interview_time'];

        if(empty($_POST['Interview_stage']))
        {
            $update_error['Interview_stage'] = 'A stage has to be selected';

        }
        else
        {
            $interview_stage = $_POST['Interview_stage'];
        }

        if(empty($_POST['interview_date']))
        {
            $update_error['interview_date'] = 'A interview date needs to be selected';

        }
        else
        {
            $interview_date = $_POST['interview_date'];
        }

        if(empty($_POST['interview_time']))
        {
            $update_error['interview_time'] = 'A interview time needs to be selected';

        }
        else
        {
            $interview_time = $_POST['interview_time'];
        }

        $applicant_number = $_POST['application_id'];
        //echo $applicant_number;



        if(array_filter($update_error))
        {
          echo 'errors in the form'.'<br>';
          echo 'The following errors are present in your from please fill the form again'.'<br>';

          echo $update_error['Interview_stage'].'<br>';
          echo $update_error['interview_date'].'<br>';
          echo $update_error['interview_time'].'<br>';


        }
        else
        {
        
          $login_email = mysqli_real_escape_string($conn, $_SESSION['email']);
          $interview_date = mysqli_real_escape_string($conn, $_POST['interview_date']); 
          $interview_time = mysqli_real_escape_string($conn, $_POST['interview_time']);
          $interview_stage = mysqli_real_escape_string($conn, $_POST['Interview_stage']);
          $upcoming_sche = $interview_date.' '.$interview_time;
          $final_upcoming =  mysqli_real_escape_string($conn, $upcoming_sche);

            $sql1 = "SELECT Stages_Done, Info_Data FROM job_applications WHERE Application_Number='$applicant_number' ";

            $results = mysqli_query($conn, $sql1);

            $data_changes = mysqli_fetch_assoc($results);
        
            $stages_done_new = $data_changes['Stages_Done'].','.$interview_stage;

            $Until = $data_changes['Info_Data'].','.$interview_stage.' : '.$interview_date.' '.$interview_time;


          // create sql
          $sql = "UPDATE job_applications SET Upcoming_Schedule='$final_upcoming', Current_Status='$interview_stage', Stages_Done='$stages_done_new', Info_Data='$Until'  WHERE Application_Number='$applicant_number' ";

          // save to db and check
          if(mysqli_query($conn,$sql))
          {

            // sucess
            echo 'form is valid';
            header("Location: applicant-data.php?Title=$applicant_number"); 
          }
          else
          {
            echo 'query error:' . mysqli_error($conn);
          }


        }



    }

?>
