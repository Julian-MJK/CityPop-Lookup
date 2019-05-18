<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 18.05.2019
     * Time: 02:52 AM
     */

    // bypassing connection.php session check + redirection.
    session_start();
    $_SESSION['username'] = 'temp';
    require_once '../connection.php';
    $_SESSION['username'] = null;

    require_once '../generic_functions.php';

    $existingUsers = $conn->query('SELECT * FROM user');

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // dette kan gjøres mye lettere og mer fleksibelt med HTML REGEX eller javascript, men for IT1 holder jeg meg til php her. Jeg bruker regex ol. på andre sider.
    // (f.eks. 'pattern="[A-Za-z]{3}"'  og   'required')

    if (empty($username)) {
        $error = 'Please enter a username';
    } else if (strlen($username) > 32) {
        $error = 'Make sure your password is less than 32 characters';
    }

    if (empty($password)) {
        $error = 'Please enter a password';
    } else if (strlen($password) > 32) {
        $error = 'Make sure your password is less than 32 characters';
    }


    if (!isset($error)) { //isset($password, $username)
        //encountered no errors

        if(isset($existingUsers)){
            while ($row = $existingUsers->fetch_assoc()) {
                if ($row['username'] === $username && $row['password'] === $password) {
                    $correctCredentials = true;
                    break 1;
                }
            }
        } else $correctCredentials = true;

        if (isset($correctCredentials)) {
            $_SESSION['username'] = $username;
            header('Location: ../../home/');
        } else {
            $error = 'Incorrect credentials';
        }

    }

    if (isset($error)) {
        passTo('loginPage.php', ['msg'], [addslashes($error)]);
    }

?>



