<?php

/*
 * inputs <input name="tableName" hidden>, <input name="columnName">
 * outputs indexed arrays: $headers, $userInputs
 */

require "connection.php";

$table = $_POST['table'];

$sql = "SELECT * FROM $table";

$query = $conn->query($sql);

$headers_associative = $query->fetch_assoc();

$headers = array();
$userInputs = array();

$count = 0;


// GETTING THE COLUMN NAMES
foreach ($headers_associative as $header) {
    $headers[] = $header;
    $count++;
}


// STORING ALL USER INPUTS
for ($i = 0; $i < $count; $i++) {
    if (isset($_POST[$headers[$i]])) $userInputs[$i] = addslashes($_POST[$headers[$i]]);
    if (isset($userInputs[$i])) echo '<li> [' . $headers[$i] . '] - ' . $userInputs[$i] . '</li>';
    if (!isset($userInputs[$i])) $missedHeaders[] = $headers[$i];

    // SEPARATING ARTIST NAME INTO TWO STRINGS (atomærkravet)
    if (isset($userInputs[$i])) {
        if ($headers[$i] === 'name' || $headers[$i] === "artistName") {
            /*$_artistNameArr = explode(' ', $userInputs[$i], 2);
            $_sql = "SELECT * FROM artist WHERE firstName='$_artistNameArr[0]' AND lastName='$_artistNameArr[1]'";
            $_result = $conn->query($_sql);
            $userInputs[$i] = $_result['artist_id'];
            $headers[$i] = 'artist_id';
            *///echo "<h1>".$userInputs[$i]."</h1>" . $_artistNameArr[0] . $_artistNameArr[1];
        } else
            // SEPARATING GENRES INTO MULTIPLE STRINGS
            if ($headers[$i] === "genre") {
                $_genres = explode(',', $userInputs[$i]);
                $_genres_count = count($_genres);
                // Gjør dem udefinert slik at final query ignorerer dem.
                $headers[$i] = null;
                $userInputs[$i] = null;
            }
    }
}

if (isset($missedHeaders)) {
    echo '<br><br> No input given for columns: <br>';
    foreach ($missedHeaders as $missedHeader) {
        echo '<li>' . $missedHeader . '</li>';
    }
}


