<?php
    $title=$job_description=$position_identifier=$employment_status=$department=$city=$state=$country=$pubdate=$duedate='';
    $application_stages='Applied ,First Interview, Second interview ,Final Interview, Job Offer ';
    $errors=array('title'=>'','job_description'=>'','application_stages'=>'','position_identifier'=>'','employment_status'=>'','department'=>'','city'=>'','state'=>'','country'=>'','pubdate'=>'','duedate'=>'');

    session_start();
    $login_email=$_SESSION['email'];
    //echo $login_email;
    
    
    //connecting to data base
    $conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

    if(!$conn)
    {
      echo 'Connection error:' . mysqli_connect_error(); 
    }



    if(isset($_POST['submit']))
    {
        // echo $_POST['title'];
        // echo $job_description=$_POST['job_description'];
        // echo $application_stages = $_POST['application_stages'];
        // echo $position_identifier = $_POST['position_identifier'];
        // echo $employment_status = $_POST['employment_status'];
        // echo $department = $_POST['department'];
        // echo $city = $_POST['city']; 
        // echo $state = $_POST['state'];
        // echo $country = $_POST['country'];
        // echo $pubdate = $_POST['pubdate'];
        // echo $duedate = $_POST['duedate'];

        // title check
        if(empty($_POST['title']))
        {
            $errors['title'] = 'An title is required';

        }
        else
        {
          $title=$_POST['title'];
        //   if(!preg_match('/^[a-zA-Z\s]+$/', $title))
        //   {
        //       echo 'Title must be letters '
        //   }
      
        
        }

        // job description check
        if(empty($_POST['job_description']))
        {
            $errors['job_description'] = 'A job description is required ';
        }
        else
        {
          $job_description=$_POST['job_description'];
        }

        // application stages check
        if(empty($_POST['application_stages']))
        {
            $application_stages='Applied ,First Interview, Second interview ,Final Interview, Job Offer';
        }
        else
        {
          $application_stages = $_POST['application_stages'];
          if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $application_stages))
          {
              $errors['application_stages'] = 'Application stages must be comma seperated';
          }
        }

        // position_identifier
        if(empty($_POST['position_identifier']))
        {
            $errors['position_identifier'] = 'Position info is required';
        }
        else
        {
          $position_identifier = $_POST['position_identifier'];   
        }

        // employment_status
        if(empty($_POST['employment_status']))
        {
            $errors['employment_status'] = 'Employment type is required';
        }
        else
        {
          $employment_status = $_POST['employment_status'];
        }

        // department
        if(empty($_POST['department']))
        {
            $errors['department'] = 'Department info is required';
        }
        else
        {
          $department = $_POST['department'];
        }

        // city 
        if(empty($_POST['city']))
        {
            $errors['city'] = 'City is required';
        }
        else
        {
            $city = $_POST['city'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $city))
            {
              $errors['city'] = 'City must be letters and spaces only';
            }
        }

        // state 
        if(empty($_POST['state']))
        {
            $errors['state'] = 'State is required';
        }
        else
        {
            $state = $_POST['state'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $state))
            {
              $errors['state'] = 'state must be letters and spaces only';
            }
        }

        //country 
        if(empty($_POST['country']))
        {
            $errors['country'] = 'Country is required';
        }
        else
        {
            $country = $_POST['country'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $country))
            {
              $errors['country'] = 'state must be letters and spaces only';
            }
        }

        // pubdate 
        if(empty($_POST['pubdate']))
        {
            $errors['pubdate'] = '  Publish date is required';
        }
        else
        {
            $pubdate = $_POST['pubdate'];
        }

        //duedate
        if(empty($_POST['duedate']))
        {
            $errors['duedate'] = '  Duedate date is required';
        }
        else
        {
            $duedate = $_POST['duedate'];
        }


        if(array_filter($errors))
        {
          //echo 'errors in the form';
        }
        else
        {
        
          $login_email = mysqli_real_escape_string($conn, $_SESSION['email']);
          $title = mysqli_real_escape_string($conn, $_POST['title']); 
          $job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
          $application_stages = mysqli_real_escape_string($conn, $_POST['application_stages']);
          $position_identifier = mysqli_real_escape_string($conn, $_POST['position_identifier']);
          $employment_status = mysqli_real_escape_string($conn, $_POST['employment_status']);
          $department = mysqli_real_escape_string($conn, $_POST['department']);
          $city = mysqli_real_escape_string($conn, $_POST['city']);
          $state = mysqli_real_escape_string($conn, $_POST['state']);
          $country = mysqli_real_escape_string($conn, $_POST['country']);
          $pubdate = mysqli_real_escape_string($conn, $_POST['pubdate']);
          $duedate = mysqli_real_escape_string($conn, $_POST['duedate']);

          // create sql
          $sql = "INSERT INTO job_discription(Title,Job_Description,Application_stages,Position_Identifier,Employment_Status,Department,City,State_Name,Country,Publish_On,Until,login_email) VALUES('$title','$job_description','$application_stages','$position_identifier','$employment_status','$department','$city','$state','$country','$pubdate','$duedate', '$login_email')";

          // save to db and check
          if(mysqli_query($conn,$sql))
          {

            // sucess
            //echo 'form is valid';
            header('Location: job_page1.php'); 
          }
          else
          {
            echo 'query error:' . mysqli_error($conn);
          }


        }
    } 
    
    
    // if user cancels the page
    if(isset($_POST['cancel']))
    {
        header('Location: job_page1.php');
    }


    

    // write query for all data
    

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
    <link rel="stylesheet" type="text/css" href="style_job.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <!--FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <title>Job listing details</title>
</head>
<body>

    <main>
 
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
                              <a class="nav-link" href="#">Jobs <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item px-1">
                              <a class="nav-link" href="#">Applications</a>
                            </li>

                            <!-- CHANGES MADE ON 24TH FEB- 10 pm Calender removed-->
                            <li class="nav-item px-1">
                              <a class="nav-link" href="#"><button class="btn btn-info btn-sm text-white border border-white">Log out</button></a>
                            </li>
                          </ul>
                    </div>
            </div>
        </nav>
            
       </div>
    </div>

   <p style="background-color: white;"> </p> 
      <h1 style="background-color: rgb(37, 175, 218); color: white;font-size: 18px;padding-left: 30px;padding-top:5px;display:inline-flexbox;"><i class="fa fa-location-arrow" aria-hidden="true"></i> Job Listing Details</h1>
    <!--  <p style="background-color: white;padding: 4px;"> </p> -->
     
      <form class="row g-3" style="padding-left: 25px;background-color:beige;padding-top: 20px;" action='Job_listing.php' method='POST'>
        <div class="col-md-10">
          <label for="inputTitle" class="form-label" >Title:</label>
          <input type="text" class="form-control" id="inputTitle" name='title' placeholder="Enter Title" value='<?php echo htmlspecialchars($title)?>'>
          <div style="color: red; font-size: 15px;"><?php echo $errors['title']; ?></div>
        </div>


        <div class="col-md-10">
          <label for="inputJob_Description" class="form-label" style="padding-top: 10px;">Job Description:</label>

        <!--CHANGES MADE ON 24TH FEB-10pm -->
            <input type="text" class="form-control" id="inputJob_Description" style="height:200px;font-size:14pt;" name='job_description' placeholder="Enter Job Description" value='<?php echo htmlspecialchars($job_description)?>'>
            <div style="color: red; font-size: 15px;"><?php echo $errors['job_description']; ?></div>
        </div>


        <!--CHANGES MADE ON 24TH FEB-10 pm -->
        <div class="col-md-10">
          <label for="inputAdd_appstage" class="form-label" style="padding-top: 10px;">Add Application Stages:</label><span style="font-family: monospace ;"> (Separate each stage with a comma) </span>
          <input type="text" class="form-control" id="inputAdd_appstage" style="height:100px;font-size:14pt;" name='application_stages' placeholder="Enter Application stages by default its Applied ,First Interview, Second interview ,Final Interview, Job Offer " value='<?php echo htmlspecialchars($application_stages)?>'>
          <div style="color: red; font-size: 15px;"><?php echo $errors['application_stages']; ?></div>
        </div>

        <!--CHANGES MADE ON 24TH FEB-10 pm -->
        <div class="col-md-6">
          <label for="inputPosId" class="form-label" style="padding-top: 20px;padding-right:5px">Position Identifier:</label>
          <input type="text" class="form-control" id="inputPosId" name='position_identifier' placeholder="Enter job Position here" value='<?php echo htmlspecialchars($position_identifier)?>'>
          <div style="color: red; font-size: 15px;"><?php echo $errors['position_identifier']; ?></div>
        </div>

        <!--CHANGES MADE ON 25tH FEB-10 pm -->
        <div class="col-md-8" style="padding-top: 25px;">
          <label for="inputEmpStat" class="form-label"  style="padding-right:5px">Employment Status:</label>
          <select id="inputEmpStat" class="form-select" name='employment_status' placeholder="Enter job Position here" value='<?php echo htmlspecialchars($employment_status)?>'>
            <option selected>Full-time</option>
            <option>Part-time</option>
          </select>
          <div style="color: red; font-size: 15px;"><?php echo $errors['employment_status']; ?></div>
        </div>

        <!--CHANGES MADE ON 25TH FEB-10 pm -->
        <div class="col-md-6" style="padding-top: 25px;">
          <label for="inputDept" class="form-label" style="padding-right:5px">Department:</label>
          <input type="Dept" class="form-control" id="inputDept" name='department' placeholder="Enter Deparment here" value='<?php echo htmlspecialchars($department)?>'>
          <div style="color: red; font-size: 15px;"><?php echo $errors['department']; ?></div>
        </div>
      
        <!--CHANGES MADE ON 25TH FEB-12.15 am -->
        <div class="col-md-6" style="padding-top:25px;">
            <label for="inputCity" class="form-label"  style="padding-right:5px">City:</label>
            <input type="City" class="form-control" id="inputCity" name='city' placeholder="Enter city here" value='<?php echo htmlspecialchars($city)?>'>
            <div style="color: red; font-size: 15px;"><?php echo $errors['city']; ?></div>
        </div>


          <!--CHANGES MADE ON 25TH FEB-12.15 am-->
          <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputState" class="form-label"  style="padding-right:5px">State:</label>
            <input type="State" class="form-control" id="inputState" name='state' placeholder="Enter state here" value='<?php echo htmlspecialchars($state)?>'>
            <div style="color: red; font-size: 15px;"><?php echo $errors['state']; ?></div>
          </div>

          <!--CHANGES MADE ON 25TH FEB-12.15 am --> 
          <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputCountry" class="form-label"  style="padding-right:5px">Country:</label>
            <input type="Country" class="form-control" id="inputCountry" name='country' placeholder="Enter country here" value='<?php echo htmlspecialchars($country)?>'>
            <div style="color: red; font-size: 15px;"><?php echo $errors['country']; ?></div>
          </div>
         
          
          <div class="input-group mb-3"  style="padding-top: 25px;padding-left: 15px;">
            <label for="pubdate" style="padding-right:5px">Publish On:</label>
            <input type="date" id="pubdate" name="pubdate" value='<?php echo htmlspecialchars($pubdate)?>'>
            <div style="color: red; font-size: 15px;"><?php echo $errors['pubdate']; ?></div>
          </div>

          <div class="input-group mb-3" style="padding-top: 25px;padding-left: 15px;padding-bottom: 100px;">
            <label for="duedate" style="padding-right:5px">Until:</label>
            <input type="date" id="duedate" name="duedate" value='<?php echo htmlspecialchars($duedate)?>'>
            <div style="color: red; font-size: 15px;"><?php echo $errors['duedate']; ?></div>
          </div>
          
          
          
          
          
        <!-- <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save"><input class="btn btn-primary"  type="submit" value="Cancel" onclick="goBack()"></a> -->
        <div>
            <input type='submit' name='submit' value='save' class='btn btn-primary z-depth-0'>
            <input type="submit" name='cancel' value='cancel' class='btn btn-primary z-depth-0' >
        </div>  
         

          
          
         </form>
         
         


      </main>

        
         

</body>

<!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 
    
</html>