<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 18.05.2019
     * Time: 02:52 AM
     */

    echo "<noscript> <a href='loginPage.php'>
        Your browser does not support JavaScript, so if you're not automatically redirected,
        and there's nothing else on this page, click here to be redirected to login.
        </a><br><br></noscript>";

    // bypassing connection.php session check + redirection.
    session_start();
    $_SESSION['username'] = 'temp';
    require_once '../connection.php';
    $_SESSION['username'] = null;

    include '../generic_functions.php';

    $existingUsers = $conn->query('SELECT * FROM user');

    while ($row = $existingUsers->fetch_assoc()) {
        $existingUsernames[] = $row['username'];
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mesteparten av dette kan gjøres mye lettere og mer fleksibelt med HTML REGEX eller javascript, som jeg har brukt andre steder,
    // men for IT1 holder jeg meg til php her.
    // (f.eks. 'pattern="[A-Za-z]{3}"'  og   'required')

    /*if (empty(trim($_POST['username']))) {

        $msg = 'Please enter a username') ;

    } else */


    if (isset($existingUsernames) && in_array($username, $existingUsernames, true)) {
        $error = 'A user with that username already exists';
    } else {
        $username = trim($_POST['username']);
    }


    /*if (empty(trim($_POST['password']))) {
        $msg = 'Please enter a password') ;
    } else */


    if ($_POST['passwordConfirm'] !== $_POST['password']) {
        $error = 'The passwords do not match';
    } else if (strlen($_POST['password']) >= 32 || strlen($_POST['password']) < 6) {
        $error = 'Make sure your password is at least 6 and at most 32 characters' ;
    } else {
        $password = trim($_POST['password']);
    }


    if (!isset($error)) { //isset($password, $username)

        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        $querySuccess = $conn->query($sql) ? true : false;

        if ($querySuccess) {
            $error = 'User ' . $username . ' registered successfully';
            $msgColor = '#028900';
        } else {
            $error = "Something went wrong, couldn't create user $username for query $sql";
        }
    }


    if (isset($error)) {
        passTo('loginPage.php', ['msg', 'msgColor'], [addslashes($error), isset($msgColor)?$msgColor:'var(--red)']);
    }

?>



