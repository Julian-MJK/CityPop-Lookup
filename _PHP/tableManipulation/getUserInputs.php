<?php

    /*
     * inputs <input name="tableName" hidden>, <input name="columnName">
     * outputs indexed arrays: $input_fieldNames, $input_data
     */

    require_once '../connection.php';
    require_once '../generic_functions.php';


    $table = $_POST['table'];
    $sql = "SHOW COLUMNS FROM $table";
    $query = $conn->query($sql);

    if($_SESSION['debugMode']) if($_SESSION['debugMode']) echo '<br> table=' . $table . '<br>';

    $fieldNames = array();
    $input_data = array();
    $input_fieldNames = array();

    // GETTING THE COLUMN NAMES
    while ($row = $query->fetch_assoc()) {
        $fieldNames[] = $row['Field'];
    }

    $fieldCount = count($fieldNames);

    // STORING ALL USER INPUTS
    // goes through each column
    for ($i = 0; $i < $fieldCount; $i++) {
        if (isset($_POST[$fieldNames[$i]]) && !empty(trim($_POST[$fieldNames[$i]]))) {
            // if a input's name is equal to a field name

            // FIELD NAME
            $input_fieldNames[] = $fieldNames[$i];

            // USER INPUT
            if (is_string($_POST[$fieldNames[$i]]) && (contains('name', $fieldNames[$i]) || contains('title', $fieldNames[$i]))) {

                // TITLE-CASING (if input is a string, and the header contains 'name' or 'title'.)
                $input_data[] = escape(ucwords(strtolower($_POST[$fieldNames[$i]])));

            } else {

                // PLAIN
                $input_data[] = escape($_POST[$fieldNames[$i]]);

            }
        }
    }


    // SPECIAL CASES
    if (isset($_POST['name']) && !empty(trim(isset($_POST['name'])))) {
        // if a input with the name "name" is passed

        $name = ucwords(trim(str_replace(array('/&nbsp;/gi', '/\s+/g'), '', $_POST['name'])));
        $explodedName = explode(' ', $name, 2);

        $firstName = $explodedName[0];
        $input_fieldNames[] = 'firstName';
        $input_data[] = $firstName;

        if (isset($explodedName[1])) {
            $lastName = $explodedName[1];
            $input_fieldNames[] = 'lastName';
            $input_data[] = $lastName;
        }
    }

    $input_fieldCount = count($input_fieldNames);

    for ($i = 0; $i < $input_fieldCount; $i++) {
        if($_SESSION['debugMode']) echo '<li>[' . $input_fieldNames[$i] . '] - ' . $input_data[$i] . '</li>';
    }

    //(in the "goes through each column" for $fieldCount loop
    /*if (isset($_POST['name'])) {

        }*/
    /*if (isset($input_data[$i])) {
        // SEPARATING ARTIST NAME INTO TWO STRINGS (atomærkravet)
        if ($fieldNames[$i] === 'name' || $fieldNames[$i] === "artistName") {
            $_artistNameArr = explode(' ', $userInputs[$i], 2);
            $_sql = "SELECT * FROM artist WHERE firstName='$_artistNameArr[0]' AND lastName='$_artistNameArr[1]'";
            $_result = $conn->query($_sql);
            $userInputs[$i] = $_result['artist_id'];
            $headers[$i] = 'artist_id';
            //if($_SESSION['debugMode']) echo "<h1>".$userInputs[$i]."</h1>" . $_artistNameArr[0] . $_artistNameArr[1];
        } else if ($fieldNames[$i] === "genre") {
            // SEPARATING GENRES INTO MULTIPLE STRINGS
                $_genres = explode(',', $input_data[$i]);
                $_genres_count = count($_genres);
                // Gjør dem udefinert slik at final query ignorerer dem.
                $fieldNames[$i] = null;
                $input_data[$i] = null;
            }
    }*/
?>