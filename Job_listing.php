<?php



  $Title=$Job_Description=$Position_Identifier=$Employment_status=$Department=$City=$State_Name=$Country=$Publish_On=$Until="";
  
  //$errors=array('Title'=>'', 'Job_Description'=>'', 'Position_Identifier'=>'', 'Employment_status'=>'',, 'Department'=>'', 'City'=>'', 'State_Name'=>'', 'Country'=>'', 'Publish_On'=>'', 'Until'=>'');


    // connecting to the data base
    $conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

    //check connection
    if(!$conn){
        echo 'connection error: '.mysqli_connect_error();
    }

    // writing a query to fecth data
    // $sql = 'SELECT * FROM job_discription' // all the data
    $sql = 'SELECT Title, Job_Description, Position_Identifier, Employment_status, Department, City, State_Name, Country, Publish_On, Until  FROM job_discription ORDER BY Publish_On' ;

    // making query and getting result
    $result = mysqli_query($conn, $sql);

    // fetching the resulting rows as an array
    $my_data_trail = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //print_r($my_data_trail);

    // freeing reslut from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    

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
    <link rel="stylesheet" type="text/css" href="style_job_listing.css">
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
                            <li class="nav-item px-1">
                              <a class="nav-link" href="#">Calendar</a>
                            </li>
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
     
    
      <form class="row g-3" style="padding-left: 25px;background-color:beige;padding-top: 20px;">
        <div class="col-md-10">
          <label for="inputTitle" class="form-label">Title:</label>
          <input type="tex t" class="form-control" id="inputTitle" name='Title' placeholder="Enter Title" value='<?php echo htmlspecialchars($Title)?>'>
        </div>
        <div class="col-md-10">
          <label for="inputJob_Description" class="form-label">Job Description:</label>
          <input type="Job_Description" class="form-control" id="inputJob_Description" style="height:200px;font-size:14pt;" name='Job_Description' placeholder="Enter Discription" value='<?php echo htmlspecialchars($Job_Description)?>'>
        </div>
        <div class="col-md-8">
          <label for="inputPosId" class="form-label" style="padding-top: 20px;padding-right:5px">Position Identifier:</label>
          <select id="inputPosId" class="form-select" name='Position_Identifier' placeholder="Enter Position" value='<?php echo htmlspecialchars($Position_Identifier)?>'>
            <option selected>Choose...</option>
            <option>Hero</option>
            <option>Zero</option>
            <option>Hello</option>
            <option>.....</option>
          </select>
        </div>
        

        <div class="col-md-8" style="padding-top: 25px;">
          <label for="inputEmpStat" class="form-label"  style="padding-right:5px">Employment Status:</label>
          <select id="inputEmpStat" class="form-select" name='Employment_status' value='<?php echo htmlspecialchars($Employment_status)?>'>
            <option selected>Choose...</option>
            <option>Part-time</option>
            <option>Full-time</option>
            <option>......</option>
          </select>
        </div>

        <div class="col-md-8" style="padding-top: 25px;">
          <label for="inputDept" class="form-label" style="padding-right:5px">Department:</label>
          <select id="inputDept" class="form-select" name='Department' value='<?php echo htmlspecialchars($Department)?>'>
            <option selected>Choose...</option>
            <option>Plane</option>
            <option>Jet Plane</option>
            <option>Helicopter</option>
            <option>....</option>
          </select>
        </div>
      

        <div class="col-md-8" style="padding-top:25px;">
            <label for="inputCity" class="form-label"  style="padding-right:5px">City:</label>
            <select id="inputCity" class="form-select" name='City' value='<?php echo htmlspecialchars($City)?>'>
              <option selected>Choose...</option>
              <option>vasco</option>
              <option>Panjim</option>
              <option>Margoa</option>
              <option>italy</option>
              <option>...</option>
            </select>
        </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputState" class="form-label"  style="padding-right:5px">State:</label>
            <select id="inputState" class="form-select" name='State_Name' value='<?php echo htmlspecialchars($State_Name)?>'>
              <option selected>Choose...</option>
              <option>Goa</option>
              <option>Maharastra</option>
              <option>Karnataka</option>
              <option>Kerela</option>
              <option>...</option>
            </select>
          </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputCountry" class="form-label"  style="padding-right:5px">Country:</label>
            <select id="inputCountry" class="form-select" name='Country' value='<?php echo htmlspecialchars($Country)?>'>
              <option selected>Choose...</option>
              <option>India</option>
              <option>China</option>
              <option>USA</option>
              <option>Uk</option>
              <option>....</option>
            </select>
          </div>
         

          <div class="input-group mb-3"  style="padding-top: 25px;padding-left: 15px;">
            <label for="pubdate" style="padding-right:5px">Publish On:</label>
            <input type="date" id="pubdate" name='Publish_On' value='<?php echo htmlspecialchars($Publish_On)?>' >
          </div>

          <div class="input-group mb-3" style="padding-top: 25px;padding-left: 15px;padding-bottom: 100px;">
            <label for="duedate" style="padding-right:5px">Until:</label>
            <input type="date" id="duedate" name='Until' value='<?php echo htmlspecialchars($Until)?>'>

          </div>
          
          
          
          
          
          <a style="padding-left:15px;"></a>
          <input class="btn btn-primary" type="submit" value="Save" name='Save'>
          <input class="btn btn-primary"  type="submit" value="Cancel" name='Cancel'>
         
         
         

          
          
         </form>
         


      </main>

        
         

</body>

<!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</html>