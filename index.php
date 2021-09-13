<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">
    <title>NotesApp</title>
  </head>
  <body>
 
    <?php   include('includes/navbar.php') ?>  

     
      <div id="heroContainer">
        <div id="heroBg">
          <video id="heroVideo" src="media/video/video.mp4" type="video/mp4" autoPlay loop muted playsInline></video>
        </div>
        <div id="heroContent">
          <div id="heroItems">
            <h1 id="heroTitle">NotesApp</h1>
            <p>Fast, easy to use, simply beautiful!</p>
          </div>
        </div>
      </div>

      <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content navbarBg">
            <div class="modal-header">
              <h5 class="modal-title" id="registerModalLabel">New User Registration</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" id="registerForm">
                <div class="mb-3">
                  <label for="userEmailAddress" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="userEmailAddress" name="userEmailAddress">
                </div>
                <div class="mb-3">
                  <label for="fullname" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="fullName" name="fullName">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" >
                </div>
                <div class="mb-3">
                  <label for="confirmPassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" >
                </div>
                <div class="d-flex justify-content-center">
                  <div class="spinner-border visually-hidden" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" id="registerButton" class="btn  btn-outline-dark">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content navbarBg">
            <div class="modal-header">
              <h5 class="modal-title" id="loginModalLabel">User Login</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" id="loginForm">
                <div class="mb-3">
                  <label for="loginEmailAddress" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="loginEmailAddress" name="loginEmailAddress">
                </div>
                <div class="mb-3">
                  <label for="loginPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="loginPassword" name="loginPassword" >
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn  btn-outline-dark">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div id="userReviews" class="container-md">
        <div class="userReviewsTitle">User Reviews</div>
        <div class="card-group">
          <div class="card">
            <img src="media/img/pix1.jpg" class="card-img-top img-fluid" alt="customerphoto">
              <div class="card-body">
                <h5 class="card-title">Cindy Smith</h5>
                <p class="card-text">NotesApp is so amazing. The user experience is superb.</p>
              </div>
          </div>
          <div class="card">
            <img src="media/img/pix2.jpg" class="card-img-top img-fluid" alt="customerphoto">
                <div class="card-body">
                  <h5 class="card-title">Jake Cola</h5>
                  <p class="card-text">NotesApp is so amazing. The user experience is superb.</p>
                </div>
          </div>
          <div class="card">
            <img src="media/img/pix1.jpg" class="card-img-top img-fluid" alt="customerphoto">
            <div class="card-body">
              <h5 class="card-title">Nelly Base</h5>
              <p class="card-text">The best note taking app I have ever used.</p>
            </div>
          </div>
        </div>
      </div>

      
      
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
        <p class="text-center text-muted">&copy; 2021 NotesApp, Inc</p>
      </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="js/user.js"></script>


  </body>
</html>