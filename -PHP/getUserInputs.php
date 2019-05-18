<?php

/*
 * inputs <input name="tableName" hidden>, <input name="columnName">
 * outputs indexed arrays: $headers, $userInputs
 */

    require_once "connection.php";

$table = $_POST['table'];
$sql = "SELECT * FROM $table";
$query = $conn->query($sql);
$headers_assoc = $query->fetch_assoc();


$table_fieldNames = array();
$input_data = array();
$input_fieldNames = array();

// GETTING THE COLUMN NAMES
foreach ($headers_assoc as $header) echo $table_fieldNames[] = $header;

$table_headers_length = count($table_fieldNames);

// STORING ALL USER INPUTS
// goes through each column
for ($i = 0; $i<$table_headers_length; $i++){
    echo 'i='.$i . ' ' . $table_fieldNames[$i];
    if (isset($_POST[$table_fieldNames[$i]])){
        $input_fieldNames[] = $table_fieldNames[$i];
        $input_data[] = addslashes($_POST[$table_fieldNames[$i]]);
        echo '<li> [' . $table_fieldNames[$i] . '] - ' . $input_data[$i] . '</li>';
    } else $missedHeaders[] = $table_fieldNames[$i];


    // SEPARATING ARTIST NAME INTO TWO STRINGS (atomærkravet)
    if (isset($input_data[$i])) {
        if ($table_fieldNames[$i] === 'name' || $table_fieldNames[$i] === "artistName") {
            /*$_artistNameArr = explode(' ', $userInputs[$i], 2);
            $_sql = "SELECT * FROM artist WHERE firstName='$_artistNameArr[0]' AND lastName='$_artistNameArr[1]'";
            $_result = $conn->query($_sql);
            $userInputs[$i] = $_result['artist_id'];
            $headers[$i] = 'artist_id';
            *///echo "<h1>".$userInputs[$i]."</h1>" . $_artistNameArr[0] . $_artistNameArr[1];
        } else
            // SEPARATING GENRES INTO MULTIPLE STRINGS
            if ($table_fieldNames[$i] === "genre") {
                $_genres = explode(',', $input_data[$i]);
                $_genres_count = count($_genres);
                // Gjør dem udefinert slik at final query ignorerer dem.
                $table_fieldNames[$i] = null;
                $input_data[$i] = null;
            }
    }
}

foreach ($input_data as $data) {
    echo $data;
}


/*if (isset($missedHeaders)) {
    echo '<br><br> No input given for columns: <br>';
    foreach ($missedHeaders as $missedHeader) {
        echo '<li>' . $missedHeader . '</li>';
    }
}*/


