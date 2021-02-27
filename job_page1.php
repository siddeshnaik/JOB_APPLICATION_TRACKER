<?php

$Output="";
// connecting to the data base
$conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

//check connection
if(!$conn){
    echo 'connection error: '.mysqli_connect_error();
}

// writing a query to fecth data
// $sql = 'SELECT * FROM job_discription' // all the data
$sql = 'SELECT Title, Publish_On, Until  FROM job_discription ORDER BY Publish_On' ;

// making query and getting result
$result = mysqli_query($conn, $sql);

// fetching the resulting rows as an array
$my_data_trail = mysqli_fetch_all($result, MYSQLI_ASSOC);

//print_r($my_data_trail);

// freeing reslut from memory
mysqli_free_result($result);




// to get the count of number of application
// $value = count($my_data_trail );
// echo $value;

if (isset($_POST['Search_Bar'])){

  $searchq=$_POST['Search_Bar'];
  $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

  //$query=mysqli_query(,$searchq) ;
  $query=mysqli_query($conn,"SELECT * FROM job_discription WHERE Title LIKE '%$searchq%'") or die("Could not Search");
  $count = mysqli_num_rows($query);

  

  if ($count==0){

    $Output="There was no search result";

  }else{

    while($row=mysqli_fetch_array($query)){
      $fname=$row['Title'];
      $Output = $fname;

    }
  }


}
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


          <div class="search-container">
            <form action="job_page1.php" method='POST'>
              <input type="text" placeholder="Search for a job post" name="Search_Bar">
              <input type="submit" value="Search" class="fa fa-search" style="font-family:sans-serif;"/>
            </div>
            </form>

          <?php echo $Output ?>

<!--Table consisting of job titles and the applications received -->



            <table class="table">
              <p style="background-color: white;"> </p> 
              <h1 style="background-color: rgb(37, 175, 218); color: white;font-size: 18px;padding-left: 15px;padding-top:10px;padding-bottom:15px;display:inline-flexbox;"><i class="fa fa-location-arrow" aria-hidden="true"></i>JOB TITLE<button type="button" class="btn btn-primary btn-sm" style="float: right;background-color: rgb(103, 60, 182);font-weight: bold;"><i class="fa fa-plus" aria-hidden="true"></i> ADD A JOB POST</button></h1>
              <thead>
                <tr>
                  <th scope="col">TITLE</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Publish</th>
                  <th scope="col">Unpublish</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"></th>
                  <div>
                  <?php foreach($my_data_trail as $output_data1){?>
                  <div>
                  <p> <?php echo htmlspecialchars($output_data1['Title']) ?> </p>
                  <p><?php echo htmlspecialchars($output_data1['Publish_On']) ?></p>
                  <p><?php echo htmlspecialchars($output_data1['Until']) ?></p>
                  </div>
                  <?php } ?>
                  </div>
                  
                

                  
                   <td><input type="number" class="form-control" id="inputNumber" style="block-size: 20px;width:5%;height:25px;float: right;background-color: #9fff51;"></td>
                  <td>Applications</td>
                  <td></td>
                  <td></td>
                  <td><button type="button" class="btn btn-primary btn-sm" style="padding-left: 15px;padding-right: 15px;">Edit</button></td>
                  <td><button type="button" class="btn btn-secondary btn-sm">Delete</button></td>
                </tr>
                
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