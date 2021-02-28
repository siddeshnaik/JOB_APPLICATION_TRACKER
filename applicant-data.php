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
<body>
   <div class="container" style="margin-top: 100px;">
       <div class="row">
            <div class="col" style="border: 0.5px solid rgb(145, 141, 141);margin-right: 30px; height: auto; width: 100%;background-color: white; border-radius: 5px;">
                <div class="leftside">
                    <div class="box" style="margin-top: 10px;">
                   
                        <h3 style="display: inline-block; color: rgb(50, 125, 211); font-family:'Times New Roman', Times, serif ;">Applicant name</h3>
                        <div class="dropdown app-action">
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Application Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <button class="dropdown-item" type="button">Hired</button>
                          <button class="dropdown-item" type="button">Rejected</button>
                          <button class="dropdown-item" type="button">Waiting</button>
                        </div>
                      </div>
                    </br>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <h6 style="font-size: smaller;font-style: italic; color: rgb(94, 90, 90);">Applied:&nbsp;&nbsp; days ago</h6>
                     </br>
                    <h5 style="color: rgb(50, 125, 211);">Post Applied</h5>
                    <p style="color: black;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam sed nesciunt voluptatibus voluptates neque earum vero, molestiae explicabo esse perferendis! Culpa tempore impedit cum deleniti rem. Vitae, iste! Eaque, saepe.</p>
                    </br>
                     </br>
                    <h5 style="font-size: 15px;">Contact Phone Number</h5>
                    <input type="text" class="form-control" name="text" id="text">
                    </br>
                    <h5 style="font-size: 15px;">Email Id</h5>
                    <input type="email" class="form-control" name="email">
                    </br>
                    <h5 style="font-size: 15px;">Residential Address</h5>
                    <textarea id ="details" input type="text" class="form-control" name="text"></textarea>
                    </br>
                    <h5 style="font-size: 15px;">Attachments</h5>

                    </div>
                </div>
            </div>
            
            <div class="col"  style="border: 0.5px solid rgb(145, 141, 141);border-radius:5px; height: 20vh; width: 90%;background-color: white;">
                <div class="rightside">
                    <div class="container" style="margin-top: 10px;">
                        <div class="text-center">
                        <h3 style="font-size: 18px; color: rgb(50, 125, 211);display: inline-block;">Interview</h3>
                                         
                    <a href="#" class="btn btn-info btn-sm" style="float: right;" data-toggle="modal" data-target="#add_interview">Add Interview<i class="fa fa-plus ml-3" aria-hidden="true"></i></a>
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