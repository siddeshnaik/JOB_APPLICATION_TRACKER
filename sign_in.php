<?php
  // transfering data from one page to another
  session_start();
  $_SESSION['email'] = '';
  $_SESSION['password'] = '';


  // connecting to the data base
  $conn = mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

    //check connection
    if(!$conn){
        echo 'connection error: '.mysqli_connect_error();
    }

    //write a query for all email and password
    $sql = 'SELECT email_id, password_info FROM login_data';
    
    // make query and get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $login_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    //free result from memory
    mysqli_free_result(($result));

    //close connection
    mysqli_close($conn);

    //print_r($login_data);


  $password = $email = '';
  $errors= array('email'=>'', 'password'=>'');


  
  
  if(isset($_POST['submit']))
  {
    // check email
    if(empty($_POST['email']))
    {
      $errors['email'] = 'An email is required <br>';
    }
    else
    {
      $email=$_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $errors['email'] = 'email must be a valid email address';      
      }
      else
      {
        foreach($login_data as $checking)
        {
          if($checking['email_id']==$email)
          {
            $_SESSION['email']=$email;
            $errors['email']='';
            break;
          }
          else
          {
            $errors['email']='This email doesnt exist';
          }
        }
      }   
      
      } 
    
    // checking password
    if(empty($_POST['password']))
    {
      $errors['password'] = 'An password is required <br>';
    }
    else
    { 
      $password=$_POST['password'];
      foreach($login_data as $checking){
        if((($checking['password_info']==$password) and ($checking['email_id']==$email)))
        {
          $_SESSION['password']=$password;
          $errors['password']='';
          break;
        }
        else
        {
          $errors['password']='Enter the correct password';
        }
      }
  }
  
    if(array_filter($errors))
    {
      //echo 'errors in the form';
    }
    else
    {
      //echo 'form is valid'    
      if(!(($_SESSION['email'] ==="") and ($_SESSION['password'] ===""))){
        header('Location: sign_up.php');  
      }
      
    }
  }
  
  
  

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
    <link rel="stylesheet" type="text/css" href="sign_in.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <!-- FONT Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    
    <title>Sign In</title>
</head>
<body>
    <!-- <div class="bgimg"> -->
        <!-- <div class="overlay"> -->
          <nav class="navbar navbar-expand-md navbar-dark bg-dark px-1 py-1 nav-colour">
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
                                <a class="nav-link" href="#"><button class="btn btn-info btn-sm text-white border border-white">Sign In</button></a>
                              </li>
                            </ul>
                      </div>
              </div>
          </nav>

    <div class="container">
        <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-8">
                   <div class="row bg-decor" style="margin-top: 95px; box-shadow: 1px 1px 50px 10px black;">
                       <div class="col-md-6 bg-color">
                           
                    <form class="form-container" action="sign_in.php" method="POST">
                    <h4>Sign In</h4>
                    <h6>Welcome.We missed you!</h6>
                       
                    <div class="form-group">
                    <label class="label control-label">Your Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter your Email" value="<?php echo htmlspecialchars($email) ?>">
                    <div style="color: red; font-size: 10px;"><?php echo $errors['email']; ?></div>
                    </div>

                    <div class="form-group">
                    <label class="label control-label">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Enter your password" value="<?php echo htmlspecialchars($password) ?>">
                    <div style="color: red; font-size: 10px;"><?php echo $errors['password']; ?></div>
                    </div>

                    <!-- <div class="form-group form-check">
                    <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
                    <label class="form-check-label" for="checkbox"><small>Rememeber me</small></label>
                     </div> -->

                     <!-- <button class="btn btn-warning btn-block text-white" style="font-family:sans-serif;"><a href="#" style="color: white;font-size: 15px;">Sign In</a></button> -->
                      <div>
                        <input type="submit" name="submit" value="Sign in" class="btn btn-warning btn-block text-white" style="font-family:sans-serif;">
                      </div>
<!-- 
                     <h5 class="text-center" style="font-size: 10px; padding-top: 10px; font-weight: bold; ">or continue with</h5>

                     <button class="btn btn-secondary btn-block text-white" style="font-family:sans-serif;"><a href="#" style="color: white;font-size: 15px;">Sign in with Google</a></button> -->

                     <h5 class="text-right" style="font-size: 10px; font-weight: 800; padding-top: 20px; padding-bottom: 0;"><a href="forgot_password.html" style="color:black;text-decoration: none;">Forgot password?</h5>
                    
                    
                        <h5 class="text-center" style="font-size: 10px; font-weight: 800; padding-top: 20px; padding-bottom: 0;">Don't have an account?<a href="sign_up.php">&nbsp; Create one!</h5>
                    </form>

                </div>

               <div class="col-md-2">
                 <div class="col-md-6">
                  <div class="container">
                    <h3>TrackEasy.com</h3>
                    <h6>keep it secure with us ugdgaiisajjkcjgh</h6>
                  </div>
                </div>
               </div>
                 
                        
                        
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