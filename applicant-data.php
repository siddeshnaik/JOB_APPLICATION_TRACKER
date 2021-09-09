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

    //echo $current_login_email_id;

    if($current_login_email_id = '')
    {
        header('Location: sign_in.php');
    }

    if(isset($_GET['Title']))
    {   
        //print_r(explode(',', $_GET['Title']));
        // $applicant_name= mysqli_real_escape_string($conn, explode(',',$_GET['Title'])[0]);
        //echo $applicant_name.'<br>';


        // $applicant_department = mysqli_real_escape_string($conn, explode(',',$_GET['Title'])[1]);
        //echo $applicant_department.'<br>';

        // $applicant_status = mysqli_real_escape_string($conn,explode(',', $_GET['Title'])[2]);
        //echo $applicant_status.'<br>';


        // $job_title = mysqli_real_escape_string($conn, explode(',',$_GET['Title'])[3]);
        //echo $job_title.'<br>';

        $application_number =mysqli_real_escape_string($conn, $_GET['Title']); 
        //echo $application_number;


        
        
    

        
    
    }


    

    $sql="SELECT Job_Title, Position_Identifier, Department, Applicant_Name, Rating, Current_Status, Info_Data, Upcoming_Schedule, Stages_Done, Contact_Number,Email, Applicant_Address, Application_Stages,login_email,resume_link, Application_Number FROM job_applications WHERE Application_Number='$application_number' ";
        
        $results = mysqli_query($conn, $sql);

        $applicant_details = mysqli_fetch_assoc($results);

    
    
        //print_r($applicant_details);

        //echo $applicant_details['Application_Number'];
        
    


    //selecting the stage
    // foreach(explode(',',$applicant_details['Application_Stages']) as $stages)
    // {
    //     if (!in_array($stages, explode(',',$applicant_details['Current_Status'])))
    //     {
    //      echo htmlspecialchars($stages);
    //     } 
    // }

    //showing the current status
    //echo htmlspecialchars($applicant_details['Current_Status']);

    //echo htmlspecialchars(explode(',',$applicant_details['Info_Data'])[0]);



    



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
     <link rel="stylesheet" type="text/css" href="applicant-data.css">
     <!-- FONT -->
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
   <!-- FONT Awesome-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <title>Applicant data</title>
</head>

<div class="bgimg">
            <div class="overlay">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark nav-colour">      
                  <div class="container">
                      <a class="navbar-brand font-weight-bold" href="#" >TrackEasy.com</a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span></button>
                      
                          <div class="collapse navbar-collapse text-center" id="navbarText">
                              <ul class="navbar-nav ml-auto">
                                  <li class="nav-item active px-1">
                                    <a class="nav-link" href="job_page1.php">Jobs <span class="sr-only"></span></a>
                                  </li>
                                  <li class="nav-item px-1">
                                    <!-- <a class="nav-link" href="#">Applications</a> -->
                                  </li>
                                  
                                  <!-- CHANGES MADE ON 25TH FEB- 1 am Calender removed-->
                                  <li class="nav-item px-1">
                                    <a class="nav-link" href="log_out.php"><button class="btn btn-info btn-sm text-white border border-white">Log out</button></a>
                                  </li>
                                </ul>
                          </div>
                  </div>
              </nav>
                  
             </div>
          </div>


<body>
   <div class="container" style="margin-top: 100px;">
       <div class="row">
            <div class="col" style="border: 0.5px solid rgb(145, 141, 141);margin-right: 30px; height: auto; width: 100%;background-color: white; border-radius: 5px;">
                <div class="leftside">
                    <div class="box" style="margin-top: 10px;">
                   
                        <h3 style="display: inline-block; color: rgb(50, 125, 211); font-family:'Times New Roman', Times, serif ;"><?php echo htmlspecialchars($applicant_details['Applicant_Name'])?></h3>
                        <!-- <div class="dropdown app-action">
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Application Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <button class="dropdown-item" type="button">Hired</button>
                          <button class="dropdown-item" type="button">Rejected</button>
                          <button class="dropdown-item" type="button">Waiting</button>
                        </div>
                      </div> -->
                    <div>
                        <h9 style="color: rgb(94, 90, 90);">Current Status : <?php echo htmlspecialchars($applicant_details['Current_Status']).'  '.$applicant_details['Upcoming_Schedule'];?></h9>
                    </div>

                    <!-- <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i> -->

                    <h6 style="font-size: smaller;font-style: italic; color: rgb(94, 90, 90);"><?php foreach(explode(',',$applicant_details['Info_Data']) as $stages_done){echo htmlspecialchars($stages_done).'<br>'; }?></h6>
                     <h7>Job Title: <?php echo htmlspecialchars($applicant_details['Job_Title']);?></h7>
                    
                     <h5 style="color: rgb(50, 125, 211);  margin: 0px; padding-bottom: 7px; padding-top:4px;">Post Applied: <?php echo htmlspecialchars($applicant_details['Position_Identifier']); ?></h5>        
                    
                    <h6 style="font-size: 15px; margin: 0px; padding: 0px;">Contact Phone Number:</h6>
                    <p style='font-size: 15px; margin: 0px; padding-top: 2px;'><?php echo htmlspecialchars($applicant_details['Contact_Number']) ?></p>
                    
                    <h6 style="font-size: 15px; margin: 0px; padding-top: 9px;">Email Id:</h6>
                    <p style="font-size: 15px; margin: 0px; padding-top: 2px;"><?php echo htmlspecialchars($applicant_details['Email']) ?></p>
                
                    <h6 style="font-size: 15px; margin: 0px; padding-top: 9px;">Residential Address:</h6>
                    <p style="font-size: 15px; margin: 0px; padding-top: 2px;"><?php echo htmlspecialchars($applicant_details['Applicant_Address']) ?></p>

                    
                    <h6 style="font-size: 15px; margin: 0px; padding-top: 9px;">Resume Link:</h6>
                    <p style="font-size: 15px; margin: 0px; padding-top: 2px;"><a href='<?php echo htmlspecialchars($applicant_details['resume_link']) ?>'><?php echo htmlspecialchars($applicant_details['resume_link']) ?></a></p>

                    <br>
                    
                    </div>
                </div>
            </div>
            
            <div class="col"  style="border: 0.5px solid rgb(145, 141, 141);border-radius:5px; height: 80vh; width: 90%;background-color: white;">
                <div class="rightside">
                    <div class="container" style="margin-top: 10px;">
                        <div class="text-center">
                        <h3 style="font-size: 18px; color: rgb(50, 125, 211);display: inline-block;">Interview</h3>
                                         
                    <!-- <a href="#" class="btn btn-info btn-sm" style="float: right;" data-toggle="modal" data-target="#add_interview">Add Interview<i class="fa fa-plus ml-3" aria-hidden="true"></i></a>
        <div class="modal" id="add_interview">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text center w-100 font-weight-bold">Add Interview</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
                    </div>
                    <p>Name of applicant</p>
                    <p>Name of job post he/she has applied for</p>

                    <div class="modal-body mx-3 text-left">
                        <div class="md-form mb-5">
                            <label class="label control-label">Interview type</label></br>
                            <div class="btn-group text-center">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">select</button>
                                <div class="dropdown-menu">
                                    <h5 class="dropdown-item">applied</h5>
                                    <h5 class="dropdown-item">applied</h5>
                                    <h5 class="dropdown-item">applied</h5>
                                    <h5 class="dropdown-item">applied</h5>
                                    

              



                                </div>
                            </div>
                        </div>
                        <div class="md-form mb-5">
                            <i class="fa fa-calendar prefix grey-text" aria-hidden="true"></i>
                            <label class="label control-label">Interview date</label>
                            <input type="date" class="form-control" name="Startdate" placeholder="Enter date(dd/mm/yy)">
                        </div>

                        <div class="md-form mb-5">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <label class="label control-label">Interview time</label>
                            <input type="time" class="form-control" name="appt" id="appt" placeholder="Enter time(12 hours)">
                        </div>

                        <div class="md-form mb-5">
                            <i class="fa fa-map-marker prefix grey-text" aria-hidden="true"></i>
                             <label class="label control-label">Other details</label>
                            <textarea id ="details" input type="text" class="form-control" name="text" placeholder="Any other details"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-success" type="submit">Save</button>
                    </div>

                    
                    
                    <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-danger" type="submit">Cancel</button>
                    </div>

                    

                </div>
                
            </div>
        </div>
        </br>
    </br>
            <div class="box-info">
                <p>Application &nbsp; &nbsp; &nbsp;Date &nbsp;&nbsp;&nbsp;Time &nbsp;&nbsp;&nbsp;Venue</p>
            </div>

        </div>
 -->


    <form  action='update_interview.php' method='POST'>

                <br>
                <div class="md-form mb-3">
                    
                    <label class="label control-label form-label">Interview Stage:</label></br>
                    <select id="inputposition" class="form-select" name="Interview_stage"> 
                        <option selected disabled>Current Stage: <?php echo htmlspecialchars($applicant_details['Current_Status'])  ?></option>
                            <?php 
                            foreach(explode(',',$applicant_details['Application_Stages']) as $stages)
                            {
                                if (!in_array($stages, explode(',',$applicant_details['Stages_Done'])))
                                 ?>
                                    <option><?php { echo htmlspecialchars($stages); } } ?></option>
                        
                            
                    </select>
                            
                </div>
                    
                <br>
                <div class="md-form mb-3">
                            <i class="fa fa-calendar prefix grey-text" aria-hidden="true"></i>
                            <label class="label control-label">Interview date</label>
                            <input type="date" class="form-control" name="interview_date" placeholder="Enter date(dd/mm/yy)">
                </div>

                <br>
                <div class="md-form mb-3">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <label class="label control-label">Interview time</label>
                            <input type="time" class="form-control" name="interview_time" id="appt" placeholder="Enter time(12 hours)">
                </div>
                
                <br>
                <div>
                    <input type= 'hidden' name='application_id' value="<?php echo $application_number?>" >
                    <input type='submit' name='submit' value='save' class='btn btn-primary z-depth-0'>
                    
                </div>
    </form>
  



                    </div>
                    
             </div>

    
    </div>
   </div> 
</body>
    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>