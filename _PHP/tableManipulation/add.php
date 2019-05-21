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

        // changed from $input_data as $i => $datum
        foreach ($input_fieldNames as $i => $datum) {
            // changed from $xName = $datum
            if ($datum === 'firstName') $firstName = $input_data[$i];
            if ($datum === 'lastName') $lastName = $input_data[$i];
        }

        // aborts and sends user to the home menu with a message, if no input with name=firstName&lastName/name, was found.
        if (!isset($firstName) /*&& !isset($lastName)*/) passTo('../../home/', ['msg'], ['Failed to add album, artist name not defined.']);

        $artist_id = $conn->query("SELECT artist_id FROM artist WHERE firstName='$firstName' AND lastName='$lastName'")->fetch_assoc()['artist_id'];

        // aborts and informs the user if the query was unsuccessful.
        if (!isset($artist_id) || !$artist_id || empty($artist_id)) passTo('../../home/', ['msg'], ['Failed to add album, artist ' . $firstName . ' ' . $lastName . ' not found.']);

        if ($_SESSION['debugMode']) echo '<li> [artist_id] - ' . $artist_id . '</li>';


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

        foreach ($input_fieldNames as $i => $datum) {
            /* user-input is passed as album_id because getUserInputs only looks for $_POST'ed variables with the same name as the field-names.  */
            if ($datum === 'album_id') $albumTitle = $input_data[$i];
            if ($datum === 'title') $title = $input_data[$i];
        }

        $album_id = $conn->query("SELECT album_id FROM album WHERE title='$albumTitle' ORDER BY album_id DESC LIMIT 1")->fetch_assoc()['album_id'];

        if (!$album_id) passTo('../../home/', ['msg'], ['Failed to add song, album ' . $albumTitle . ' not found.']);

        // removing the previously passed "artist_id" field.
        if (in_array('album_id', $input_fieldNames, true)) {

            $index_artist_id = array_search('album_id', $input_fieldNames, true);

            // un-setting "artist_id" field-name and it's respective value.
            unset($input_fieldNames[$index_artist_id], $input_data[$index_artist_id]);

            // re-applying indexes (as unset leaves indexes unchanged).
            $input_fieldNames = array_values($input_fieldNames);
            $input_data = array_values($input_data);
        }

        if ($_SESSION['debugMode']) echo "<li> [album_id] - $album_id </li>";

        $input_data[] = $album_id;
        $input_fieldNames[] = 'album_id';
    }




    // ==== GENRES ====
    // added independently
    if ($table !== 'genre') {

        // fetching the most recently inserted album's id.
        foreach ($input_fieldNames as $i => $datum) {
            if ($datum === 'album_id') $album_id = $input_data[$i];
            if ($datum === 'genre') $genres = $input_data[$i];

        }

        $genres = explode(',', $genres);
        foreach ($genres as $i => $genre) {
            $genres[$i] = strtolower(trim($genre));
        }

        addgenres($album_id, $genres);

        header('Location: ../../album/?a=' . $album_id);
    }




    // ==== INSERTING VALUES INTO TABLE ====

    // GATHERING THE INPUTS AND HEADERS INTO ONE QUERY
    $inputString = "'" . $input_data[0] . "'";
    $headerString = $input_fieldNames[0];
    $input_fieldCount = count($input_data);
    for ($i = 1; $i < $input_fieldCount; $i++) {
        $inputString .= ", '" . $input_data[$i] . "'";
        $headerString .= ', ' . $input_fieldNames[$i];
    }

    // INSERTING USER INPUTS INTO APPROPRIATE HEADERS
    $sql = "INSERT INTO  $table ($headerString) VALUES ($inputString);";
    if ($_SESSION['debugMode']) echo $sql;

    ($conn->query($sql) === TRUE) ? $msg = 'New record created successfully' : $msg = "Error: $conn->error";
    if ($_SESSION['debugMode']) echo '<br><h2>' . $msg . '</h2><br>';




    // ==== GENRES ====
    // added while adding an album
    if (isset($_POST['genre']) && $table !== 'genre' && !empty(trim(isset($_POST['genre'])))) {

        // fetching the most recently inserted album's id.
        $album_id = $conn->query('SELECT album_id FROM album ORDER BY album_id DESC LIMIT 1')->fetch_assoc()['album_id'];

        $genres = explode(',', $_POST['genre']);

        foreach ($genres as $i => $genre) {
            $genres[$i] = strtolower(trim($genre));
        }

        addgenres($album_id, $genres);

    }




    // ==== ARTIST REDIRECTION ====
    if ($table === 'artist') {
        $artist_id = $conn->query('SELECT artist_id FROM artist ORDER BY artist_id DESC LIMIT 1')->fetch_assoc()['artist_id'];
        header('Location: ../../artist?a=' . $artist_id);
    }




    // ==== ALBUM REDIRECTION ====
    if ($table === 'album') {
        // fetching the most recently inserted album's id.
        $album_id = $conn->query('SELECT album_id FROM album ORDER BY album_id DESC LIMIT 1')->fetch_assoc()['album_id'];
        header('Location: ../../album/?a=' . $album_id);
    }




    // ==== SONG REDIRECTION ====
    if ($table === 'song') {
        // fetching the most recently inserted album's id.
        header('Location: ../../album/?a=' . $album_id);
    }




    // hvis ingen annen redirection gitt
    //header('Location: ../../home/');



    // INFORMING USER OF RESULT
    /*
    $result = $conn->query("SELECT * FROM $table");
    if($_SESSION['debugMode']) echo "<table> <tr>";
    for ($i = 0; $i < $count; $i++) if (isset($headers[$i])) if($_SESSION['debugMode']) echo "<th>$headers[$i]</th>";
    if($_SESSION['debugMode']) echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        if($_SESSION['debugMode']) echo "<tr>";
        for ($i = 0; $i < $count; $i++) if($_SESSION['debugMode']) echo '<td>' . $row[$headers[$i]] . '</td>';
        if($_SESSION['debugMode']) echo "</tr>";
    }
    if($_SESSION['debugMode']) echo "</table>";
    */


?>
