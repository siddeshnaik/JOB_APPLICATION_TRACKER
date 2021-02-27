<?php

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
    // mysqli_close($conn);



    $fullName=$email=$password=$repassword='';
    $errors=array('fullName'=>'', 'email'=>'', 'password'=>'', 'repassword'=>'');
    if(isset($_POST['submit'])){

        // check name
        if(empty($_POST['fullName'])){
            $errors['fullName'] = 'Your Name is required <br>';
        }
        else{
            $fullName=$_POST['fullName'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $fullName)){
                $errors['fullName'] = 'Name must contain atleast one letter';
            }
        }

        // Check email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br>';
        }
        else{
            $email=$_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email']='Email must be a valid email address';
            }
            else
            {
                foreach($login_data as $checking)
                {
                    if($checking['email_id']==$email)
                    {
                        $errors['email']='This email already exists';
                        break;
                    }
                }
            }
        }
        
        // check password
        if(empty($_POST['password'])){
            $errors['password'] = 'A password is required <br>';
        }
        else{
            $password=$_POST['password'];
            if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)){
                $errors['password'] = 'Minimum eight characters, at least one letter and one number';
            }
        }

        // check repassword
        if(empty($_POST['repassword'])){
            $errors['repassword'] = 'Password needs to be typed again <br>';
        }
        else{
            $repassword=$_POST['repassword'];
            if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $repassword)){
                $errors['repassword'] = 'Minimum eight characters, at least one letter and one number';
            }

            elseif($_POST['password']!=$_POST['repassword']){
                $errors['repassword'] = 'Password and Retyped password do not match';
            }

        }

        if(array_filter($errors)){
            //echo 'errors in the form';
        }

        else{
            //echo 'form is valid';
    
            // escape sql chars
            $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			// create sql
			$sql = "INSERT INTO login_data(full_name,email_id,password_info) VALUES('$fullName','$email','$password')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
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
    <link rel="stylesheet" type="text/css" href="sign_up.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    
    
    <title>Sign Up</title>
</head>
<body>
    
    <!-- <div class="bgimg">
        <div class="overlay"> -->
          <nav class="navbar navbar-expand-md navbar-dark bg-dark px-1 py-1">
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
                   <div class="row bg-decor" style="margin-top: 100px; box-shadow: 1px 1px 50px 10px black;">
                       <div class="col-md-6 bg-color">
                        
                    <form class="form-container" action="sign_up.php" method="POST">
                    <h4>Sign Up</h4>
                    <h6>Don't have an account?</h6>
                        
                    <div class="form-group">
                    <label class="label control-label">Full Name</label>
                    <input type="text" class="form-control" name="fullName" placeholder="Enter your full name" value='<?php echo htmlspecialchars($fullName)?>'>
                    <div style="color: red; font-size: 10px;"><?php echo $errors['fullName']; ?></div>
                    </div>
                    
                    <div class="form-group">
                    <label class="label control-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter your Email" value='<?php echo htmlspecialchars($email)?>'>
                    <div style="color: red; font-size: 10px;"><?php echo $errors['email']; ?></div>
                    </div>

                    <div class="form-group">
                    <label class="label control-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" value='<?php echo htmlspecialchars($password)?>'>
                    <div style="color: red; font-size: 10px;"><?php echo $errors['password']; ?></div>
                    </div>

                    <div class="form-group">
                    <label class="label control-label">Repeat password</label>
                    <input type="password" class="form-control" name="repassword" placeholder="Enter your password again" value='<?php echo htmlspecialchars($repassword)?>'>
                    <div style="color: red; font-size: 10px;"><?php echo $errors['repassword']; ?></div>
                    </div>

                    <!-- <button class="btn btn-info btn-block text-white" style="font-family:sans-serif;" type='submit' value="submit"><a href="#" style="color: white ; font-size: 15px;">Sign up</a></button> -->

                    <div class="left">
                        <input type="submit" name='submit' value="signup" class='btn btn-info btn-block text-white' style="font-family:sans-serif;" >
                    </div>
                    
                    <h5 class="text-center" style="font-size: 10px; font-weight: 800; padding-top: 20px; padding-bottom: 0;">Already have an account?<a href="#">&nbsp; Click here!</h5>
                </form>
                    
               </div>
               <div class="col-md-2"></div>
           </div>
        
    </div>
    
</body>
<!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>