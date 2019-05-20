<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 14.05.2019
     * Time: 11:44 PM
     */


    require_once '../connection.php';

    $table = $_POST['table'];
    $table_id = $table . '_id';
    $id = $_POST[$table_id];

    if (isset($_POST['firstName'])) $firstName = addslashes($_POST['firstName']);
    if (isset($_POST['lastName'])) $lastName = addslashes($_POST['lastName']);
    if (isset($_POST['name'])) {
        $name = trim(str_replace(array('/&nbsp;/gi', '/\s+/g'), '', $_POST['name']));
        $explodedName = explode(' ', $name, 2);
        $firstName = $explodedName[0];
        if (isset($explodedName[1])) $lastName = $explodedName[1];
        echo 'firstname=' . $firstName . '<br>';
        echo 'lastname=' . $lastName . '<br>';
    }


    if (isset($_POST['bio'])) $bio = addslashes($_POST['bio']);
    if (isset($_POST['imgURL'])) $imgURL = $_POST['imgURL'];
    if (isset($_POST['birthYear'])) $birthYear = $_POST['birthYear'];


    include '../generic_functions.php';

    if (isset($firstName)) edit($table, $id, 'firstName', $firstName);
    if (isset($lastName)) edit($table, $id, 'lastName', $lastName);
    if (isset($bio)) edit($table, $id, 'bio', $bio);
    if (isset($imgURL)) edit($table, $id, 'imgURL', $imgURL);
    if (isset($birthYear)) edit($table, $id, 'birthYear', $birthYear);


    header('Location: ../../artist/?a=' . $id);

    //echo "<script type='text/javascript'> self.close(); </script>";

    /*
    $inputs = ['firstName'=>$firstName, 'lastName'=>$lastName, 'bio'=>$bio, 'imgURL'=>$imgURL, 'birthYear'=>$birthYear];
    $keys = array_keys($inputs);
    foreach ($inputs as $input => $i){
        if(isset($input)) $inputString .= $inputs[$i] . '=' . $input;
    }*/


    /*
    $inputsArr = array([isset($firstName) ? $firstName : '', isset($lastName) ? $lastName : '', isset($birthYear) ? $bio : '', isset($imgURL) ? $imgURL : '', isset($birthYear) ? $birthYear : '']);

    foreach ($inputsArr as $item => $i) {
        echo 'item ' . $i . ' = ' . $item;
    }
    die;

    /**
     * @param $assoc_arr
     * @return string
     */
    /*
    function toUpdateInputString($assoc_arr) {
        $inputString = '';
        foreach ($assoc_arr as $item => $i) {
            if (isset($item)) $inputString .= ($i === 0 ? '' : ', ') . key($item) . ' = ' . $item;
        }
        return $inputString;
    }*/

    /*
    // the string needs a guaranteed initial value, as all other values start with ",". There are other ways of doing this, but this is the least complicated, keeping it readable.
        $inputString = $table_id . '=' . $id;
        if (isset($firstName)) $inputString .= ', firstName = "' . $firstName.'"';
        if (isset($lastName)) $inputString .= ', lastName = "' . $lastName.'"';
        if (isset($bio)) $inputString .= ', bio = "' . $bio.'"';
        if (isset($imgURL)) $inputString .= ', imgURL = "' . $imgURL.'"';
        if (isset($birthYear)) $inputString .= ', birthYear = "' . $birthYear .'"';
        echo $inputString;


    // INSERTING USER INPUTS INTO APPROPRIATE HEADERS
        $sql = 'UPDATE ' . $table . ' SET ' . $inputString . ' WHERE ' . $table_id . '=' . $id;

        echo '<br>';
        echo $sql;

    // EXECUTING QUERY
        ($conn->query($sql) === TRUE) ? $msg = 'Record updated successfully' : $msg = 'Error: ' . $conn->msg;

        echo "<br> <script> alert(\"" . addslashes($msg) . "\"); window.location.replace('../../artist?a=" . $id . ") </script> <br>";
        */

