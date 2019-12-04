<?php

// for displaying php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); 

//allows people to login
//Global variable that is an array of data
$GLOBALS['config'] = array(
    //setting array
    'mysql' => array(
        'host' => 'localhost', // local host requires dns lookup and takes time loading
        'username' => 'root',
        'password' => '0P3nv13w',
        'db' => 'camagru'
    ),
    //used to remeber users login info
    'remeber'=> array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    //contains session name and token
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )

);

//autoloading classes is a quick way to load classes when required rather than making a list of requires.especially if you change the name of the class
//the below function is used to autoload
//spl = Standard Php Library
//function is run everytime a class is accessed. only need the class name
spl_autoload_register(function($class){
    require_once 'classes/'. $class.'.php'; //same as "require_once ../classes/User.php".
});

require_once 'functions/sanitize.php';

