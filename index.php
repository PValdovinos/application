<?php

// Pedro Valdovinos Reyes, 4/19/2024, php to instantiate F3 and go through Application pages

ini_set('display_errors', 1);
error_reporting(E_ALL);
// 328/diner/index.php
// This is my CONTROLLER

// Turn on error reporting
require_once ('vendor/autoload.php');

// Instantiate base class
$f3 = Base::instance();

//define a default route
//$f3->route('GET /', function(){
//
//    //this echo is for pets, but this index is for application, use a necessary
//    //echo '<h1>Pet Home</h1>';
//
//    //render a view page
//    $view = new Template();
//    echo $view->render('views/home.html');
//});

// Define order route
$f3->route('GET|POST /apply', function($f3){

    echo '<h1>Personal Information Page</h1>';

    //render a view page
    $view = new Template();
    echo $view->render('views/personal-information.html');
});

// Run Fat-Free
$f3->run();

?>
