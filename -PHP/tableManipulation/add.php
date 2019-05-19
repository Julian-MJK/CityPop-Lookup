<?php
    /**
     * Created by IntelliJ IDEA.
     * User: be14120001
     * Date: 13.05.2019
     * Time: 10:56
     */


    require '../connection.php';
    require '../generic_functions.php';

    require 'getUserInputs.php';


    // entering the first entry (without commas)
    $inputString = "'" . $input_data[0] . "'";
    $headerString = $input_fieldNames[0];

    // entering the rest
    for ($i = 1; $i < $input_fieldCount; $i++) {
        $inputString .= ", '" . $input_data[$i] . "'";
        $headerString .= ', ' . $input_fieldNames[$i];
    }

    // INSERTING USER INPUTS INTO APPROPRIATE HEADERS
    $sql = 'INSERT INTO ' . $table . ' (' . $headerString . ') VALUES (' . $inputString . ')';


    // EXECUTING QUERY
    ($conn->query($sql) === TRUE) ? $msg = 'New record created successfully' : $msg = 'Error: ' . $conn->error;



    // ==== ARTIST ====
    if ($table === 'artist') {
        $artist_id = $conn->query('SELECT artist_id FROM artist ORDER BY artist_id DESC LIMIT 1')->fetch_assoc()['artist_id'];
        header('Location: ../../artist?a=' . $artist_id);
    }

    // ==== ALBUM ====
    if ($table === 'album') {
        $artist_id = $conn->query('SELECT artist_id FROM artist WHERE firstName="' . $firstName . '" AND lastName="' . $lastName . '"')->fetch_assoc()['artist_id'];

    }

    // ==== SONG ====
    if ($table === 'song') {

    }

    // ==== GENRES ====
    if (isset($_POST['genre']) && !empty(trim(isset($_POST['genre'])))) {
        // if input with name 'genre' was passed, and isn't empty.
        // fetching the most recently inserted album's id.
        $album_id = $conn->query('SELECT album_id FROM album ORDER BY album_id DESC LIMIT 1')->fetch_assoc()['album_id'];
        $genres = explode(',', trim($_POST['genre']));
        foreach ($genres as $i => $genre) {
            $genres[$i] = trim($genre);
        }
        addgenres($album_id, $genres);
        //          (all of this is done after inserting in order to fetch the AI album_ID (though i know there are other ways to get the next Auto Increment values.)
    }





























    /*
    if (isset($_genres)) {
        $album_id = $conn->query("SELECT album_id FROM album WHERE title=".$_POST['title']."\"");
        for ($j = 0; $j < $_genres_count; $j++) {
            $_sql = 'INSERT INTO album_genre (album_id, genre) VALUES ("' . $album_id . '",  "'  . $_genres[$j] . '")';
            echo ($conn->query($_sql) === TRUE) ? 'genre ' . $_genres[$j] . ' added successfully' : '<script> alert("Error, klarte ikke legge til sjanger: ' . $conn->error . '") </script>';
            }
    }*/


// INFORMING USER OF RESULT
    //passTo()
    //TODO



















    /*
    $result = $conn->query("SELECT * FROM $table");
    echo "<table> <tr>";
    for ($i = 0; $i < $count; $i++) if (isset($headers[$i])) echo "<th>$headers[$i]</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        for ($i = 0; $i < $count; $i++) echo '<td>' . $row[$headers[$i]] . '</td>';
        echo "</tr>";
    }
    echo "</table>";
    */












