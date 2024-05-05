<?php

// Pedro Valdovinos Reyes, 4/19/2024, php to instantiate F3 and go through Application pages

// Start the session
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the Fat-Free Framework
require_once ('vendor/autoload.php');
require_once ('model/validate.php');
var_dump($_SESSION);


// Instantiate base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function(){

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

        // Validation
        if (!validName($firstName)) {
            $errors['firstName'] = 'Invalid first name';
        }
        if (!validName($lastName)) {
            $errors['lastName'] = 'Invalid last name';
        }
        if (!validEmail($email)) {
            $errors['email'] = 'Invalid email address';
        }
        if (!validPhone($phone)) {
            $errors['phone'] = 'Invalid phone number';
        }

        if (!empty($errors)) {
            $f3->set('errors', $errors);
        } else {
            // Store data in session
            $f3->set('SESSION.firstName', $firstName);
            $f3->set('SESSION.lastName', $lastName);
            $f3->set('SESSION.email', $email);
            $f3->set('SESSION.state', $state);
            $f3->set('SESSION.phone', $phone);

            // Redirect to experience page
            $f3->reroute('/experience.html');
        }
    }
    else
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
        $f3->set('SESSION.biography', $biography);
        $f3->set('SESSION.github', $github);
        $f3->set('SESSION.experience', $experience);
        $f3->set('SESSION.relocate', $relocate);

        // Redirect to mailing lists page
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Retrieve form data
        $selectedMailingLists = isset($_POST['mailingLists']) ? $_POST['mailingLists'] : array();
        $mailingLists = implode(", ", $selectedMailingLists);

        // Store data in session
        $f3->set('SESSION.mailingLists', $mailingLists);

        // Redirect to confirmation page
        $f3->reroute('/confirmation');
    }

    // If form is not submitted, render mailing-lists page
    echo '<h1>Mailing Lists Page</h1>';
    // Render a view page
    $view = new Template();
    echo $view->render('views/mailing-lists.html');

});

// Define confirmation route
$f3->route('GET /confirmation', function($f3){

    var_dump($_SESSION);

    // Render confirmation page
    echo '<h1>Confirmation Page</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/confirmation.html');
});

// Run Fat-Free
$f3->run();