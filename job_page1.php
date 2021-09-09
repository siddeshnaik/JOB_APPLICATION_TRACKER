<?php

    $conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

    //check connection
    if(!$conn){
    echo 'connection error: '.mysqli_connect_error();
    }

    $current_login_email_id = '';
    //$current_login_email_id = 'yooshi@thenetninja.co.uk';


    session_start();
    $current_login_email_id = $_SESSION['email'];
    $_SESSION['app_num'] = '';
    
    if ($current_login_email_id=='')
    {
      header('Location: sign_in.php');
    }
    
    
    $sql ="SELECT Title, Publish_on, Until, login_email, Department, Position_identifier FROM job_discription WHERE login_email= '$current_login_email_id' ORDER BY Until DESC";

    $result = mysqli_query($conn,$sql);

    $job_discription_info = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //print_r($job_discription_info);

    mysqli_free_result($result);

    



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
    <link rel="stylesheet" type="text/css" href="style_job_page1.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <!--FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <title>Job Titles</title>
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
                                    <a class="nav-link" href="job_page1.php">Jobs <span class="sr-only">(current)</span></a>
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


          <!-- <div class="search-container">
            <form action="action_page">
              <input type="text" placeholder="Search for a job post" name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div> -->
            
<!--Table consisting of job titles and the applications received -->


            <!-- CHANGES MADE ON 25TH FEB- 1 am  applied css-->
            <table class="table">
              <p style="background-color: white;"> </p> 
              <h1 style="background-color: rgb(37, 175, 218); color: white;font-size: 18px;padding-left: 15px;padding-top:10px;padding-bottom:15px;display:inline-flexbox;"><i class="fa fa-location-arrow" aria-hidden="true"></i>JOB TITLE<a href="job_listing.php"><button type="button" class="btn btn-primary btn-sm" style="float: right;background-color: rgb(103, 60, 182);font-weight: bold;"><i class="fa fa-plus" aria-hidden="true"></i> ADD A JOB POST</button></a></h1>
              <thead>

                 <!--CHANGES MADE ON 25TH FEB- 1 am- div tag added for the header row -->
                <div>
                <tr>
                  <th scope="col">TITLE</th>
                  <th scope="col">Position</th>
                  <th scope="col">Department</th>
                  <th scope="col">Publish</th>
                  <th scope="col">Unpublish</th>
                  <th scope="col">Delete Job Post</th>
                </tr>
                </div>
              </thead>
              <tbody>

                 <!--CHANGES MADE ON 25TH FEB- 1 am -->
                 <?php foreach($job_discription_info as $info){ ?>
                <tr>
                  <th scope="row" style="font-weight: 600;"><a href='Applicants_list.php?Title=<?php $passinfo=$info['Title'].','.$info['Department'] ;echo $passinfo; ?>'  style="color: black;"><?php echo htmlspecialchars($info['Title']) ?></a></th>
                  <!-- <td><pre style="padding-top: 3px;font-weight: 600;">----</pre></td> -->
                  <td style="font-weight: 600;"><?php echo htmlspecialchars($info['Position_identifier'])?></td>
                  <td style="font-weight: 600;"><?php echo htmlspecialchars($info['Department'])?></td>
                  <td style="font-weight: 600;"><?php $newDate1 = date("d-m-Y", strtotime($info['Publish_on'])); echo htmlspecialchars($newDate1); ?></td>
                  <td style="font-weight: 600;"><?php $newDate2 = date("d-m-Y", strtotime($info['Until'])); echo htmlspecialchars($newDate2);?></td>
                   <!--CHANGES MADE ON 25TH FEB- 2 pm edit button removed-->
                  <td><button type="button" class="btn btn-secondary btn-sm"><a href='delete.php?Titleout=<?php $passinfo=$info['Title'].','.$info['Department'].','.$info['Position_identifier'].','.$info['Publish_on'].','.$info['Until'] ;echo $passinfo; ?>'  style="color: white;">Delete</a></button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
       
          

    </main>
</body>

<!-- Optional JavaScript -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


</html>