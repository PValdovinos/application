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

    }
}