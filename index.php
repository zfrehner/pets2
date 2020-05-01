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
        if (empty($_POST['pet'])) {
            //data is invalid
            echo "Please supply a pet type";
        } else {
            $_SESSION['pet'] = $_POST['pet'];
            $_SESSION['pets'] = $_POST['pets'];

            //***Add the color to the session

            //Redirect to the summary route
            $f3->reroute("summary");
        }
    }

    $view = new Template();
    echo $view->render("views/order.html");
});

$f3->route('GET|POST /summary', function(){
    echo "chz";
    echo "<p>" . $_SESSION['pet'] . $_SESSION['pets'] . "</p>";
    $view = new Template();
    echo $view->render('views/summary.html');
});


//run fat free
$f3->run();
