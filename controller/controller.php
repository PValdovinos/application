<?php

class Controller
{
    private $_f3; //Fat-Free Router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //Render a view page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function apply()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);

            // Retrieve form data
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $state = $_POST['state'];
            $phone = $_POST['phone'];

            // Validation
            if (!validName($firstName)) {
                $this->_f3->set('errors["firstName"]', 'Invalid first name');
            }
            if (!validName($lastName)) {
                $this->_f3->set('errors["lastName"]', 'Invalid last name');
            }
            if (!validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email');
            }
            if (!validPhone($phone)) {
                $this->_f3->set('errors["phone"]', 'Invalid phone number');
            }

            // TO DO: Fix if(errors)
            //if (empty($f3->get('errors')))
            if (true) {
                // Store data in session
                $this->_f3->set('SESSION.firstName', $firstName);
                $this->_f3->set('SESSION.lastName', $lastName);
                $this->_f3->set('SESSION.email', $email);
                $this->_f3->set('SESSION.state', $state);
                $this->_f3->set('SESSION.phone', $phone);

                // Redirect to experience page
                $this->_f3->reroute('experience');
            }
            else
            {
                // If form is not submitted, render personal information page
                echo '<h1>Personal Information Page</h1>';
                // Render a view page
                $view = new Template();
                echo $view->render('views/personal-information.html');
            }
        }
    }

    function experience()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            // Retrieve form data
            $biography = $_POST['biography'];
            $github = $_POST['github'];
            $experience = $_POST['experience'];
            $relocate = $_POST['relocate'];


            // Validate form data
            if (!validGithub($github)) {
                $this->_f3->set('errors["github"]', 'Invalid GitHub username');
            }
            if (!validExperience($experience)) {
                $this->_f3->set('errors["experience"]', 'Invalid experience');
            }

            // TO DO: Fix if(errors)
            //if (empty($f3->get('errors')))
            if(true)
            {
                // Store data in session
                $this->_f3->set('SESSION.biography', $biography);
                $this->_f3->set('SESSION.github', $github);
                $this->_f3->set('SESSION.experience', $experience);
                $this->_f3->set('SESSION.relocate', $relocate);

                // Redirect to mailing lists page
                $this->_f3->reroute('mailing-lists');
            }

        }
    }

    function mailingLists()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Retrieve form data
            $selectedMailingLists = isset($_POST['mailingLists']) ? $_POST['mailingLists'] : array();
            $mailingLists = implode(", ", $selectedMailingLists);

            if(empty($selectedMailingLists))
            {
                $this->_f3->set('errors["mailingLists"]', 'Please select at least one mailing list');
            }

            // TO DO: Fix if(errors)
            //if (empty($f3->get('errors')))
            if(true)
            {
                // Store data in session
                $this->_f3->set('SESSION.mailingLists', $mailingLists);

                // Redirect to confirmation page
                $this->_f3->reroute('confirmation');
            }
        }
    }

    function confirmation()
    {
        echo '<h1>Confirmation Page</h1>';

        // Render a view page
        $view = new Template();
        echo $view->render('views/confirmation.html');
    }
}
