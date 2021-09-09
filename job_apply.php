<?php 

 
  // connecting to the data base
    $conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

    //check connection
    if(!$conn){
      echo 'connection error: '.mysqli_connect_error();
    }

    // job descirption table
    $sql_description = 'SELECT Title, Position_Identifier, Employment_Status, Department, login_email FROM job_discription';

    $result_description = mysqli_query($conn, $sql_description);

    $job_info = mysqli_fetch_all($result_description, MYSQLI_ASSOC);

    //print_r($job_info);

    // login data
    $sql_login = 'SELECT full_name, email_id FROM login_data';
    $result_loginData = mysqli_query($conn, $sql_login);
    $login_info = mysqli_fetch_all($result_loginData, MYSQLI_ASSOC);

    //print_r($login_info);
    $count = 0;
    foreach($job_info as $login_email_info)
    {
      foreach($login_info as $compare_email)
      {
        if($login_email_info['login_email'] === $compare_email['email_id'])
        {
          $job_info[$count]['full_name'] = $compare_email['full_name'];
           
        }
      }
      $count = $count+1;
    }
    

    $count=0;
    foreach($job_info as $login_email_info)
    {
      $job_info[$count]['job_option'] = $login_email_info['Position_Identifier'] . '-' . $login_email_info['Department'] . '-' . $login_email_info['Title'] . '-' . $login_email_info['Employment_Status'] . '-' . $login_email_info['full_name']; 
      $count = $count + 1; 
    }

    //print_r($job_info);
    


  $applicant_name=$applicant_email=$applicant_address=$applicant_number=$applicant_resume=$applying_under_person=$applying_job_title=$applicant_rating=$applying_department=$applying_position=$applying_job_type=$person_under_applying_login_email=$applying_position_department_job_title_personUnderApplying=$Info_Data='';
  $Current_Status='APPLIED';
  $errors= array('applicant_name'=>'', 'applicant_email'=>'','applicant_address'=>'' ,'applicant_number'=>'','applicant_resume'=>'','applying_under_person'=>'','applying_job_title'=>'','applying_department'=>'','applying_position'=>'','applying_position_department_job_title_personUnderApplying'=>'');  

  if(isset($_POST['submit']))
  {
    //echo $_POST['applicant_name'].'<br>'.$_POST['applicant_email'].'<br>'.$_POST['applicant_address'].'<br>'.$_POST['applicant_number'].'<br>'.$_POST['applicant_resume'].'<br>'.$_POST['applying_under_person'].'<br>'.$_POST['applying_job_title'].'<br>'.$_POST['applying_department'].'<br>'.$_POST['applying_position'].'<br>';
    

    // check name 
    if(empty($_POST['applicant_name'])){
      $errors['applicant_name'] = 'Your Name is required';
    }
    else{
      $applicant_name=$_POST['applicant_name'];
      if(!preg_match('/^[a-zA-Z\s]+$/',$applicant_name)){
          $errors['applicant_name'] = 'Name must contain atleast one letter';
      }
    }

    // check email
    if(empty($_POST['applicant_email'])){
      $errors['applicant_email'] = 'An email is required';
    }
    else{
      $applicant_email=$_POST['applicant_email'];
        if(!filter_var($applicant_email,FILTER_VALIDATE_EMAIL)){
          $errors['applicant_email']='Email must be a valid email address';
        }
      } 
    // check address
      if(empty($_POST['applicant_address']))
      {
        $errors['applicant_address']='An Address is required';
      }
      else{
        $applicant_address=$_POST['applicant_address'];
      }
    // check number
    if(empty($_POST['applicant_number']))
      {
        $errors['applicant_number']='A contact number is required';
      }
    else {
      $applicant_number=$_POST['applicant_number'];
      if(!preg_match('/^[0-9]{10}+$/',$applicant_number)){
          $errors['applicant_number'] = 'Enter a 10 digit valid mobile number';
      }
    }

    // check resume
    if(empty($_POST['applicant_resume']))
    {
      $errors['applicant_resume']='Resume attachment cannot be empty';
    }
    else{
      $applicant_resume=$_POST['applicant_resume'];
    }

    // check applying_position_department_job_title_personUnderApplying
    if(empty($_POST['applying_position_department_job_title_personUnderApplying']))
    {
      $errors['applying_position_department_job_title_personUnderApplying']='Select the job post you are applying for';
    }
    else{
      $applying_position_department_job_title_personUnderApplying=$_POST['applying_position_department_job_title_personUnderApplying'];
      //echo htmlspecialchars($applying_position_department_job_title_personUnderApplying);
      $applying_position=explode('-',$applying_position_department_job_title_personUnderApplying)[0];
      $applying_department=explode('-',$applying_position_department_job_title_personUnderApplying)[1];
      $applying_job_title=explode('-',$applying_position_department_job_title_personUnderApplying)[2];
      $applying_job_type=explode('-',$applying_position_department_job_title_personUnderApplying)[3];
      $applying_under_person=explode('-',$applying_position_department_job_title_personUnderApplying)[4];
      foreach($job_info as $searching_email)
      {
        if($applying_position_department_job_title_personUnderApplying==$searching_email['job_option'])
        {
          $person_under_applying_login_email=$searching_email['login_email'];
        }
      }



      //echo $applying_position .'<br>'. $applying_department .'<br>'. $applying_job_title .'<br>'. $applying_job_type .'<br>'. $applying_under_person; 
    }

    if(array_filter($errors)){
      //echo 'Errors in the form';
    }
    else{
    
      $applicant_name=mysqli_real_escape_string($conn, $_POST['applicant_name']);
      $applicant_email=mysqli_real_escape_string($conn, $_POST['applicant_email']);
      $applicant_address=mysqli_real_escape_string($conn, $_POST['applicant_address']);
      $applicant_number=mysqli_real_escape_string($conn, $_POST['applicant_number']);
      $applicant_resume=mysqli_real_escape_string($conn, $_POST['applicant_resume']);
      $applying_position=mysqli_real_escape_string($conn, $applying_position);
      $applying_department=mysqli_real_escape_string($conn, $applying_department);
      $applying_job_title=mysqli_real_escape_string($conn, $applying_job_title);
      $applying_job_type=mysqli_real_escape_string($conn, $applying_job_type);
      $applying_under_person=mysqli_real_escape_string($conn, $applying_under_person);
      $person_under_applying_login_email=mysqli_real_escape_string($conn, $person_under_applying_login_email);
      $applicant_rating=0;
      $applicant_rating=mysqli_real_escape_string($conn, $applicant_rating);
      $Current_Status=mysqli_real_escape_string($conn, $Current_Status);
      $today_time = date("d-m-Y G:i:s");
      $Info_Data = "Applied :" .' '.$today_time;
      $Info_Data = mysqli_real_escape_string($conn, $Info_Data);
      $Upcoming_Schedule='';
      $Upcoming_Schedule = mysqli_real_escape_string($conn, $Upcoming_Schedule);
      $Stages_Done = 'Applied';
      $Stages_Done = mysqli_real_escape_string($conn, $Stages_Done);
      //echo $Info_Data;
      $sql_insert_dt = "INSERT INTO job_applications(Job_Title,Position_Identifier,Department,Applicant_Name,Rating,Current_Status,Info_Data,Upcoming_Schedule,Stages_Done,Contact_Number,Email,Applicant_Address,resume_link,login_email) VALUES ('$applying_job_title','$applying_position','$applying_department', '$applicant_name','$applicant_rating', '$Current_Status', '$Info_Data', '$Upcoming_Schedule','$Stages_Done', '$applicant_number', '$applicant_email', '$applicant_address','$applicant_resume','$person_under_applying_login_email')";

      if(mysqli_query($conn, $sql_insert_dt))
      {
        //echo 'form is valid';
        header('Location: thank_you.php');
      }
      else{
        echo 'query error '. mysqli_error($conn);
      }


    }
 
  } // end of post check

  //print_r($errors);


?>

<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="applicant_form.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
  <!-- FONT Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    
    <title>Applicant Form</title>
    
</head>
<body>
    <main>
        <p style="background-color: white;"> </p> 
      <h1 style="background-color: rgb(37, 175, 218); color: white;font-size: 18px;padding-left: 30px;padding-top:5px; padding-bottom:5px; display:inline-flexbox;"><i class="fa fa-location-arrow" aria-hidden="true"></i>Applying For A New Job?</h1>
    <!--  <p style="background-color: white;padding: 4px;"> </p> -->
     
      <form class="row g-3" style="padding-left: 25px;background-color:beige;padding-top: 20px;" action="job_apply.php" method="POST">

        
        <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputname" class="form-label" style="padding-right:5px">Name:</label>
            <input type="text" class="form-control" id="inputname" name="applicant_name" placeholder="Enter your name" value="<?php echo htmlspecialchars($applicant_name);?>">
            <div style="color: red; font-size: 13px;"><?php echo $errors['applicant_name']; ?></div>
          </div>
        
          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputemail" class="form-label"  style="padding-right:5px">Email Id:</label>
              <input type="text" class="form-control" id="inputemail" name="applicant_email" placeholder="Enter your Email" value="<?php echo htmlspecialchars($applicant_email);?>">
              <div style="color: red; font-size: 13px;"><?php echo $errors['applicant_email']; ?></div>
          </div>

          <div class="col-md-10" style="padding-top:25px;">
            <label for="inputemail" class="form-label"  style="padding-right:5px">Residential Address:</label>
            <textarea id ="Address" input type="text" class="form-control" name="applicant_address" placeholder='Enter your Address'  ><?php echo htmlspecialchars($applicant_address);?></textarea>
            <div style="color: red; font-size: 13px;"><?php echo $errors['applicant_address']; ?></div>
        </div>

        <div class="col-md-10" style="padding-top: 25px;">
            <label for="inputnumber" class="form-label" style="padding-right:5px">Contact Number:</label>
            <!-- <input type="text" class="form-control" id="inputnumber" maxlength="10" minlength="1" > -->
            <input type="text" class="form-control" id="inputnumber" name="applicant_number" placeholder="Enter your Contact number" value="<?php echo htmlspecialchars($applicant_number);?>">
            <div style="color: red; font-size: 13px;"><?php echo $errors['applicant_number']; ?></div>
          </div>

          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputemail" class="form-label"  style="padding-right:5px">Resume: (Enter google drive link to your resume)</label>
              <input type="text" class="form-control" id="inputemail" name="applicant_resume" placeholder="Enter your resume file drive link" value="<?php echo htmlspecialchars($applicant_resume);?>">
              <div style="color: red; font-size: 13px;"><?php echo $errors['applicant_resume']; ?></div>
          </div>
        
        

        <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputposition" class="form-label"  style="padding-right:5px">Select the Job you are applying for:</label>
            <!-- Postion- Department - Title - Full Time - Posted by-->
            <select id="inputposition" class="form-select" name="applying_position_department_job_title_personUnderApplying"> 
              <option selected disabled>Choose...</option>
              <?php foreach($job_info as $job_applying){?>
              <option><?php echo htmlspecialchars($job_applying['job_option']); ?></option>
              <?php } ?>
          </select>
          
          <div style="color: red; font-size: 13px;"><?php echo $errors['applying_position_department_job_title_personUnderApplying']; ?></div>
        </div>

        </br>
        <div class="save_cancel" style="float:right;margin-right: 10px;text-align: right;" >
            <!-- <a style="margin-right:20px; padding: 5px 8px;"></a><input class="btn btn-success btn-md" type="button" value="Send Application">
           <input class="btn btn-danger btn-md" style="padding: 5px 8px;"  type="submit" value="Cancel" onclick="goBack()"></a> -->

           <input type="submit" name='submit' value='Send Application' class="btn btn-success btn-md">
      </div>

        </form>
    
         
          


    
    </main>
</body>
</html>