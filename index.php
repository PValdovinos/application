<?php

// Pedro Valdovinos Reyes, 4/19/2024, php to instantiate F3 and go through Application pages

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the Fat-Free Framework
require_once ('vendor/autoload.php');

// Start the session
session_start();

// Instantiate base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function($f3){

    // Render the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define apply route
$f3->route('GET|POST /apply', function($f3){

    // If form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        // Retrieve form data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];

        // Store data in session
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['state'] = $state;
        $_SESSION['phone'] = $phone;

        // Redirect to experience page
        $f3->reroute('/experience.html');
    } else
    {

        // If form is not submitted, render personal information page
        echo '<h1>Personal Information Page</h1>';
        // Render a view page
        $view = new Template();
        echo $view->render('views/personal-information.html');
    }
});

// Define experience route
$f3->route('GET|POST /experience', function($f3){

    // If form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        // Retrieve form data
        $biography = $_POST['biography'];
        $github = $_POST['github'];
        $experience = $_POST['experience'];
        $relocate = $_POST['relocate'];

        // Store data in session
        $_SESSION['biography'] = $biography;
        $_SESSION['github'] = $github;
        $_SESSION['experience'] = $experience;
        $_SESSION['relocate'] = $relocate;

        // Redirect to confirmation page
        $f3->reroute('/mailing-lists.html');
    } else
    {

        // If form is not submitted, render experience page
        echo '<h1>Experience Page</h1>';
        // Render a view page
        $view = new Template();
        echo $view->render('views/experience.html');
    }
});

// Define mailing lists route
$f3->route('GET|POST /mailing-lists', function($f3){

    // If form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Retrieve selected mailing lists
        $selectedLists = isset($_POST['mailingLists']) ? $_POST['mailingLists'] : [];

        // Store selected lists in session
        $_SESSION['mailingLists'] = $selectedLists;

        // Redirect to confirmation page
        $f3->reroute('/confirmation.html');
    }
    else
    {
        // If form is not submitted, render mailing lists page
        echo '<h1>Mailing Lists Page</h1>';

        // Render a view page
        $view = new Template();
        echo $view->render('views/mailing-lists.html');
    }
});

// Define confirmation route
$f3->route('GET /confirmation', function($f3){

    // Render confirmation page
    echo '<h1>Confirmation Page</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/confirmation.html');
});


// implode to kinda 'stringbuild'
// $sdev = implode(", ", $_POST['sdev]);

// Run Fat-Free
$f3->run();


