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
    /**
     * getUserInputs.php creates:
     *
     * string $table
     *      - the requested table
     * (indexed array) $fieldNames
     *      - all field-names for the requested table
     * number $fieldCount
     *      - number of fields in the requested table
     * (indexed array) $input_fieldNames
     *      - the field-names for all values the user has input
     * (indexed array) $input_data
     *      - all values the user has input
     * number $input_fieldCount
     *      - number of fields user has given an input for
     *
     */


    // ==== ALBUM ====
    if ($table === 'album') {
        foreach ($input_data as $i => $datum) {
            if ($datum === 'firstName') $firstName = $datum;
            if ($datum === 'lastName') $lastName = $datum;
        }
        // aborts and sends user to the home menu with a message, if no input with name=firstName&lastName/name, was found.
        if (!isset($firstName) && !isset($lastName)) passTo('../../home', ['msg'], ["Couldn't add album, artist name not found."]);

        if (!$artist_id = $conn->query('SELECT artist_id FROM artist WHERE firstName="' . $firstName . '" AND lastName="' . $lastName . '"')->fetch_assoc()['artist_id']) passTo('../../home', ['msg'], ["Couldn't add album, artist not found."]);

        echo '<li> [artist_id] - ' . $artist_id . '</li>';


        // removing the passed "firstName" and "lastName" fields
        if (in_array('firstName', $input_fieldNames, true)) {
            $index_firstName = array_search('firstName', $input_fieldNames, true);
            $index_lastName = array_search('lastName', $input_fieldNames, true);

            // un-setting "firstName" and "lastNAme"
            unset($input_fieldNames[$index_firstName], $input_fieldNames[$index_lastName], $input_data[$index_firstName], $input_data[$index_lastName]);

            // re-applying indexes (as unset leaves indexes unchanged).
            $input_fieldNames = array_values($input_fieldNames);
            $input_data = array_values($input_data);
        }


        // inserting the artist id with fieldname 'artist_id'
        $input_data[] = $artist_id;
        $input_fieldNames[] = 'artist_id';

    }

    // ==== SONG ====
    if ($table === 'song') {

    }




    // GATHERING THE INPUTS AND HEADERS INTO ONE QUERY
    $inputString = "'" . $input_data[0] . "'";
    $headerString = $input_fieldNames[0];
    $input_fieldCount = count($input_data);
    for ($i = 1; $i < $input_fieldCount; $i++) {
        $inputString .= ", '" . $input_data[$i] . "'";
        $headerString .= ', ' . $input_fieldNames[$i];
    }

    // INSERTING USER INPUTS INTO APPROPRIATE HEADERS
    $sql = 'INSERT INTO ' . $table . ' (' . $headerString . ') VALUES (' . $inputString . ')';
    ($conn->query($sql) === TRUE) ? $msg = 'New record created successfully' : $msg = 'Error: ' . $conn->error;
    echo '<br><h2>' . $msg . '</h2><br>';






    // ==== ARTIST ====
    if ($table === 'artist') {
        $artist_id = $conn->query('SELECT artist_id FROM artist ORDER BY artist_id DESC LIMIT 1')->fetch_assoc()['artist_id'];
        header('Location: ../../artist?a=' . $artist_id);
    }


    // ==== GENRES ====
    if (isset($_POST['genre']) && !empty(trim(isset($_POST['genre'])))) {
        // fetching the most recently inserted album's id.
        $album_id = $conn->query('SELECT album_id FROM album ORDER BY album_id DESC LIMIT 1')->fetch_assoc()['album_id'];
        $genres = explode(',', $_POST['genre']);
        foreach ($genres as $i => $genre) {
            $genres[$i] = strtolower(trim($genre));
        }

        addgenres($album_id, $genres);

        if ($table === 'album') header('Location: ../../artist/?a=' . $artist_id);
    }






    // hvis ingen annen redirection gitt
    header('Location: ../../home/');






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












