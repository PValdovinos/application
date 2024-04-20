<?php

// Pedro Valdovinos Reyes, 4/19/2024, php to instantiate F3 and go through Application pages

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the Fat-Free Framework
require_once ('vendor/autoload.php');

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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];

        // Store data in F3 hive for access in template
        $f3->set('firstName', $firstName);
        $f3->set('lastName', $lastName);
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('phone', $phone);

        // Redirect to confirmation page
        $f3->reroute('/confirmation');
    } else {
        // If form is not submitted, render personal information page
        echo '<h1>Personal Information Page</h1>';
        // Render a view page
        $view = new Template();
        echo $view->render('views/personal-information.html');
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

// Run Fat-Free
$f3->run();

?>