<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//require auto load file
require_once("vendor/autoload.php");

//instantiate f3 base class (create an instance of the base class)
$f3 = Base::instance();

//define a default root (what the user sees when they go to index page)
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/pet-home.html');
});

$f3-> route('GET|POST /order', function($f3) {
    //check if the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Validate the data
        var_dump($_POST);

        $color = array('Red', 'Blue', 'Green', 'Yellow');
        if (empty($_POST['pet'] && !in_array($_POST['color'], $color))) {
            //data is invalid
            echo "Please supply a pet type and color.";
        } else {
            $_SESSION['pet'] = $_POST['color'] . " " . $_POST['pet'];


            //***Add the color to the session

            //Redirect to the summary route
            $f3->reroute("summary");
            session_destroy();
        }
    }

    $view = new Template();
    echo $view->render("views/order.html");
});

$f3->route('GET|POST /summary', function() {
    $view = new Template();
    echo $view->render('views/summary.html');
});


//run fat free
$f3->run();
