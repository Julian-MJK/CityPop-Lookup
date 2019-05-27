<?php

    if (!isset($_SESSION) || session_status() !== PHP_SESSION_ACTIVE) {
        // Session isn't started
        session_start();
    }


    $server_servant = 'localhost';
    $server_username = 'root';
    $server_password = '';
    $server_database = 'CityPop_Database';


    $conn = new mysqli($server_servant, $server_username, $server_password, $server_database);

    // Making the connection globally accessible from any scope where that may be an issue.
    $GLOBALS['conn'] = $conn;

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $conn->set_charset('utf8');

    // boots user to login page if not logged in
    if (!isset($_SESSION['username'])) {
        header('location: ../_PHP/user/loginPage.php');
        exit;
    }


    // DEBUG MODE
    $_SESSION['debugMode'] = true;
    // when set to true, subsystem php scripts will echo information on screen on php documents.
    //  ( Will stop redirection, as the function header('Location: ') cannot be used after something is echoed onto the page. )
    //   ( https://www.php.net/manual/en/function.header.php )
    //    An alternative is to echo '<script> window.location.replace($url) </script>', however that won't work on no-script browsers and devices,
    //     and the user shouldn't see raw php output either way.


    //echo '<head> <meta charset="UTF-8"> </head>';

