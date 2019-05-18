<?php

    if(!isset($_SESSION) || session_status() !== PHP_SESSION_ACTIVE) {
        // Session isn't started
        session_start();
    }

    $server_servant = 'localhost';
    $server_username = 'root';
    $server_password = '';
    $server_database = 'CityPop_Database';

    $conn = new mysqli($server_servant, $server_username, $server_password, $server_database);

    $GLOBALS['conn'] = $conn;

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $conn->set_charset('utf8');

    // boots user to login page if not logged in
    if (!isset($_SESSION['username'])) {
        header('location: ../-PHP/user/loginPage.php');
        exit;
    }

?>