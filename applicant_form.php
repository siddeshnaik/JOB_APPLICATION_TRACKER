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
     
      <form class="row g-3" style="padding-left: 25px;background-color:beige;padding-top: 20px;">

        
        <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputname" class="form-label" style="padding-right:5px">Name:</label>
            <input type="name" class="form-control" id="inputname" placeholder="Enter your name">
          </div>
        
          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputemail" class="form-label"  style="padding-right:5px">Email Id:</label>
              <input type="mail" class="form-control" id="inputemail" name="email" placeholder="Enter your Email">
          </div>

          <div class="col-md-10" style="padding-top:25px;">
            <label for="inputemail" class="form-label"  style="padding-right:5px">Residential Address:</label>
            <textarea id ="Address" input type="text" class="form-control" name="text"></textarea>
        </div>

        <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputnumber" class="form-label" style="padding-right:5px">Contact Number:</label>
            <input type="tel" class="form-control" id="inputnumber" maxlength="10" minlength="1">
          </div>
        
          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputresume" class="form-label"  style="padding-right:5px">Resume:</label></br>
              <input type="file" >
          </div>
        
        <div class="col-md-8" style="padding-top: 25px;">
          <label for="inputperson" class="form-label"  style="padding-right:5px">Person Under Whom You Are Applying:</label>
          <select id="inputperson" class="form-select">
            <option selected disabled>Choose...</option>
            <option>fghijk</option>
            <option>daweyghg</option>
            <option>aesrdfg</option>
            <option>wqwazds</option>
        </select>
        <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save">
        </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputDept" class="form-label"  style="padding-right:5px">Department:</label>
            <select id="inputDept" class="form-select">
              <option selected disabled>Choose...</option>
              <option>fghijk</option>
              <option>daweyghg</option>
              <option>aesrdfg</option>
              <option>wqwazds</option>
          </select>
          <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save">
          </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputposition" class="form-label"  style="padding-right:5px">Position:</label>
            <select id="inputposition" class="form-select">
              <option selected disabled>Choose...</option>
              <option>fghijk</option>
              <option>daweyghg</option>
              <option>aesrdfg</option>
              <option>wqwazds</option>
          </select>
          <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save">
        </div>
          
        </form>
    </br>
         
         <div class="save_cancel" style="float:right;margin-right: 20px;">
            <a style="margin-right:20px; padding: 5px 8px;"></a><input class="btn btn-success btn-md" type="button" value="Send Application">
           <input class="btn btn-danger btn-md" style="padding: 5px 8px;"  type="submit" value="Cancel" onclick="goBack()"></a>
      </div> 


    
    </main>
</body>
</html>