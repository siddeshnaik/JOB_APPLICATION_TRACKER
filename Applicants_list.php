<?php

  //connecting to data base
  $conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

  if(!$conn)
  {
    echo 'Connection error:' . mysqli_connect_error(); 
  }

  $current_login_email_id = '';
  //$current_login_email_id = 'yooshi@thenetninja.co.uk';


  session_start();
  $current_login_email_id = $_SESSION['email'];
  
  if ($current_login_email_id=='')
  {
    header('Location: sign_in.php');
  }

  if(isset($_GET['Title']))
  {
    //print_r(explode(',',$_GET['Title'])[1]);
    $job_title = mysqli_real_escape_string($conn, explode(',',$_GET['Title'])[0]);
    //echo $job_title.'<br>';

    $job_department = mysqli_real_escape_string($conn, explode(',',$_GET['Title'])[1]);
    //echo $job_department.'<br>';

    $sql="SELECT Department, Applicant_Name, Rating, Current_Status, info_Data, Upcoming_Schedule  FROM  job_applications WHERE Job_Title = '$job_title' AND  login_email= '$current_login_email_id' AND Department= '$job_department'  ";

    $sql2 = "SELECT Title, Position_Identifier, Employment_Status, Department, State_Name, Publish_on, Until FROM job_discription WHERE Title= '$job_title' AND login_email= '$current_login_email_id' AND Department= '$job_department'  ";
  }

  $results = mysqli_query($conn,$sql);

  

  $all_applicant = mysqli_fetch_all($results, MYSQLI_ASSOC);

  mysqli_free_result($results);

  $results2 = mysqli_query($conn,$sql2);
  $description_info = mysqli_fetch_all($results2, MYSQLI_ASSOC);

  //print_r($all_applicant);

  //print_r($description_info);

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
    <link rel="stylesheet" type="text/css" href="Applicant_list.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <!--FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <title>Applicant List</title>
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
                            
                            <!-- CHANGES MADE ON 25TH FEB- 10 pm Calender removed-->

                            <li class="nav-item px-1">
                              <a class="nav-link" href="#"><button class="btn btn-info btn-sm text-white border border-white">Log out</button></a>
                            </li>
                          </ul>
                    </div>
            </div>
        </nav>
            
       </div>
    </div>
    <div style="width:100%;height:208px;border:2px solid #000;margin-block: 30px;font-size: 15px;background-color: rgb(225, 247, 220); font-weight: 700;">
  <!--  <p style="outline-style:solid ; ">
        <h5></h5>
        <p></p>
        <p>Status:</p>
        <p>Department:</p>
        <p>Created:</p>
        <p>Job Location:</p> -->


        <!--CHANGES MADE ON 25TH FEB-4 pm -->
        <?php foreach($description_info as $description_info1) { ?>
      <span></span><br>
      <h5><strong><span>Job Position: </span><span><?php echo htmlspecialchars($description_info1['Title']);?></span></strong></h5>
        <span>Department Type: </span><span><?php echo htmlspecialchars($description_info1['Department']);?></span><br>
        <span>Employment Type: </span><span><?php echo htmlspecialchars($description_info1['Employment_Status']);?></span><br>
        <?php $today_date=date("y-m-d"); $until_date=strtotime($description_info1['Until']); if($today_date > $until_date){ ?>
        <span>Status: </span><span style="background-color: chartreuse;"><?php echo htmlspecialchars('Active');}else{?></span>
        <span>Status: </span><span style="background-color: #FF3131;"><?php echo htmlspecialchars('Closed');}?></span><br>
        <span>Created: </span><span><?php $publish_date = date("d-m-Y", strtotime($description_info1['Publish_on'])); echo htmlspecialchars($publish_date);?></span><br>
        <span>Job Location: </span><span><?php echo htmlspecialchars($description_info1['State_Name']);?></span><br>
        <span style="float:inline-end;">Closes in: </span><span><?php $until_date = date("d-m-Y", strtotime($description_info1['Until'])); echo htmlspecialchars($until_date);?></span>
          <?php } ?>



</div>


<div class="search-container">
  <form action="action_page">
    <input type="text" placeholder="Search for a job post" name="search">
    <button type="submit"><i class="fa fa-search"></i></button>

    <input type="text" placeholder="Search for an employee" name="search">
    <button type="submit"><i class="fa fa-search"></i></button>
  </div>




  <table class="table" style="margin-top: 50px;">
    
    <thead>
      <tr>
        <th scope="col">NAME</th>
        <th scope="col">RATING</th>
        <th scope="col">STATUS</th>
        <th scope="col">INFO</th>
        <th scope="col">UPCOMING SCHEDULE</th>
        
      </tr>
    </thead>
    <tbody>

      <!--CHANGES MADE ON 25TH FEB-4 pm -->

      <?php foreach($all_applicant as $applicant) {?>
      <tr style="font-weight: 600;">  
        <th scope="row"><?php echo htmlspecialchars($applicant['Applicant_Name']); ?></th>
        <td> 
        <!-- <span class = "fa fa-star checked" style="color: rgb(223, 223, 209);"></span>  
          <i class = "fa fa-star checked" style="color: rgb(223, 223, 209);"></i>  
          <i class = "fa fa-star checked" style="color: rgb(223, 223, 209);"></i>  
          <i class = "fa fa-star checked" style="color: rgb(223, 223, 209);"></i>   -->
         
          <!-- To display unchecked star rating icons -->  

          <!-- <i class = "fa fa-star unchecked" style="color: rgb(223, 223, 209);"></i>   --> 
          <?php echo htmlspecialchars($applicant['Rating']); ?>
          </td>
        <td><?php echo htmlspecialchars($applicant['Current_Status']); ?></td>
        <td><i class="fa fa-info-circle fa-lg" aria-hidden="true"  data-toggle="popover"  data-content="<?php foreach(explode(",",$applicant['info_Data']) as $data_info){ echo htmlspecialchars($data_info).'<br>';} ?>"  data-html="true"></i></td>
        <td>
        <?php echo htmlspecialchars($applicant['Upcoming_Schedule']); ?>
      </td>
        
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


    <!--CHANGES MADE ON 25TH FEB-4 pm -->
    <script>

      $(document).ready(function(){
          $('[data-toggle="popover"]').popover();   
      });
      </script>

    
</html>