<?php
session_start();
if(!empty($_GET['session_destroy'])){
    session_destroy();
    session_start();
}

include ('preDataparseFunctions.php');

// Model
include('spyc.php');
include('dataParse.php');


// Handle request ID
$reqId = false;
if (!empty($_POST['id'])) {
    $reqId = $_POST['id'];
}
if (!empty($_GET['id'])) {
    $reqId = $_GET['id'];
}

//
$GLOBALS["lastUniqueId"] = 1;

// *FAKE* Login/Logout
$loggedIn = false ;
$justLoggedIn = false;

if (!empty($_POST['login'])){
    if(strtolower($_POST['login']) == "fail") {
        $showLoginError = "true";
    } else {

        setcookie("loggedIn", $_POST['login']);
        $loggedIn = trim($_POST['login']);
        $justLoggedIn = true;
    }
}

if (!empty($_COOKIE['loggedIn'])){
    $loggedIn = $_COOKIE['loggedIn'];
}


if($loggedIn){
    $loginWith = $config['loginWith'];
    $userExists = false;
    foreach ($users as $user){
        if($loggedIn == $user[$loginWith]){
            $userExists = $user;
        }
    }

    if(!$userExists) {
        if(!array_key_exists('defaultUser', $config)){
            echo "Error: <b>defaultUser</b> not defined in config.yml<br>";
            echo "Add configuration and <a href='?session_destroy=true'>Renew PHP session</a> ";
            die();
        }

        if(empty($users[$config['defaultUser']])){
            echo "Error: Default user does not exist in YML file!<br>";
            echo "user Key: " . $config['defaultUser'];
            die();
        }

        $activeUser = $users[$config['defaultUser']];

        $username = $activeUser['username'];
        $usermail = $activeUser['email'];
        $userrole = $activeUser ['role'];
        $userpermissions = $roles[$userrole]['permissions'];
    } else {
        $activeUser = $userExists;
        $username = $userExists['username'];
        $usermail = $userExists['email'];
        $userrole = $userExists['role'];
        $userpermissions = $roles[$userrole]['permissions'];
    }
}



if (!empty($_POST['logout']) || !empty($_GET['logout'])){
    setcookie ("loggedIn", "", time() - 3600);
    $loggedIn = false;
    session_destroy();
    header("Location: http://" . $_SERVER["HTTP_HOST"] );
    die;
}

// Generate a unique Id that can be referenced to
// This is handy in constructs like collapsibles, so you dont have to worry about id juggling

function getUniqueId($param = "lastUniqueId"){
    if(empty($GLOBALS[$param])){
        $GLOBALS[$param] = 0;
    }
    return $GLOBALS[$param] = $GLOBALS[$param] + 1;
}

function getlabel($style, $label){
    echo "<span class=\"label label-{$style}\">{$label}</span>";
}


include('dynamic_form.php');
include('commonController.php');