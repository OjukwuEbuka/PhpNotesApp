<?php

    $fullName = "";
    $isLoggedIn = false;

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        
        $fullName = $_SESSION["fullName"];
        $isLoggedIn = $_SESSION["loggedin"];
    }
    else
    {
        $isLoggedIn = false;
    }

    $loginButtons = "<button type='button' class='btn btn-outline-dark me-2' data-bs-toggle='modal' data-bs-target='#registerModal'>Register</button>
    <button class='btn btn-outline-dark' type='button' data-bs-toggle='modal' data-bs-target='#loginModal'>Login</button>
    ";

    $userInfo = "<span class='me-2 align-self-end'>Welcome ".$fullName."</span> <a href='routes/logout.php' class='btn btn-outline-dark' type='button'>Logout</a>";
    $infoToDisplay = $isLoggedIn ? $userInfo : $loginButtons;

    // print_r($_SESSION);

    echo "
        <nav class='navbar navbar-light navbarBg'>
        <div class='container-fluid'>
        <a class='navbar-brand'>NotesApp</a>
        <form class='d-flex'>".  
                $infoToDisplay
            ."
        </form>
        </div>
        </nav>
    ";