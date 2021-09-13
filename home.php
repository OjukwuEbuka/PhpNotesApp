<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"])){
    header("location: index.php");
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
    <link rel="stylesheet" href="style/index.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xnP2tOaCJnzp2d2IqKFcxuOiVCbuessxM6wuiolT9eeEJCyy0Vhcwa4zQvdrZNVqlqaxXhHqsSV1Ww7T2jSCUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>NotesApp</title>
  </head>
  <body>

    <?php   include('includes/navbar.php') ?>
  
    <div class="fullHeightContainer d-flex flex-column justify-content-between">

        <div class="row m-3">
            <div class="col text-center">
                <button type="button" class="btn btn-primary btn-lg" id="newNoteBtn">
                    <i class="bi bi-file-earmark-richtext-fill"></i>
                    New Note
                </button>
            </div>            
        </div>


        
      <div class="modal fade" id="noteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content navbarBg">
            <div class="modal-header">
              <h5 class="modal-title" id="noteModalLabel">Note</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" id="noteForm">
                <div class="errorDiv">
  
                </div>
                <div class="mb-3">
                  <label for="noteTitle" class="form-label">Title</label>
                  <input type="text" class="form-control" id="noteTitle" name="noteTitle">
                </div>
                <div class="mb-3">
                    <label for="noteBody" class="form-label">Body</label>
                    <textarea class="form-control" id="noteBody" name="noteBody" rows="12"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn  btn-outline-dark">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      

      <section class="p-5">
            <h4 class="text-center">My Notes</h4>
            <div class="row row-cols-1 row-cols-md-3 g-4" id="notesList" style="max-width:100%">
                
                <div class="col">
                    <div class="card">
                        <div class="card-body noteItem" data-id="1">
                            <h5 class="card-title noteTitle">Special title treatment</h5>
                            <p class="card-text noteBody">With supporting text below as a natural lead-in to additional content.</p>
                            <button href="#" class="btn btn-primary noteEditBtn">
                                <i class="bi bi-pen"></i>
                                Edit
                            </button>
                            <button href="#" class="btn btn-danger noteDeleteBtn">
                                <i class="bi bi-trash-fill"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        
        <div class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
          <p class="text-center text-muted">&copy; 2021 NotesApp, Inc</p>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="js/note.js"></script>


  </body>
</html>