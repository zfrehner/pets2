<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require auto load file
require_once("vendor/autoload.php");

//instantiate f3 base class (create an instance of the base class)
$f3 = Base::instance();

//define a default root (what the user sees when they go to index page)
$f3->route('GET /', function() {
    echo "<h1>My Pets</h1>";
    echo "<a href='order'>Order a Pet</a>";
    /*$view = new Template();
    echo $view->render('views/home.html');*/

});

//run fat free
$f3->run();
