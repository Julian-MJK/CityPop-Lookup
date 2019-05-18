<?php
/**
 * Created by IntelliJ IDEA.
 * User: be14120001
 * Date: 13.05.2019
 * Time: 10:56
 */

require "connection.php";



echo "<br> <br> The user wants to add these to '$table': <br> <br>";



require "_getUserInputs.php";



/*
 * USER REQUESTED COLUMNS AND INPUT NOW GATHERED
 * TIME TO ADD THE DATA INTO THEIR COLUMNS
 */





// INSERTING USER INPUTS INTO APPROPRIATE HEADERS
$sql = 'INSERT INTO ' . $table . ' (' . $headerString . ') VALUES (' . $inputString . ')';

// EXECUTING QUERY
($conn->query($sql) === TRUE) ? $msg = 'New record created successfully' : $msg = 'Error: ' . $conn->error;





// If genres were given (I.E. it's an album)
if (isset($_genres)) {
    $album_id = $conn->query("SELECT album_id FROM album WHERE title=".$_POST['title']."\"");
    for ($j = 0; $j < $_genres_count; $j++) {
        $_sql = 'INSERT INTO album_genre (album_id, genre) VALUES ("' . $album_id . '",  "'  . $_genres[$j] . '")';
        echo ($conn->query($_sql) === TRUE) ? 'genre ' . $_genres[$j] . ' added successfully' : '<script> alert("Error, klarte ikke legge til sjanger: ' . $conn->error . '") </script>';
    }
}


// INFORMING USER OF RESULT
echo '<script> alert("' . $msg . '") </script>';



// jeg vet jeg kan bruke "header("Location: $URL"), men window.location.replace med javascript fjerner siden fra
// browsing historikken, slik at brukeren ikke havner tilbake på denne siden når de trykker på "tilbake" knappen
// på nettleseren deres.

//echo '<script> window.location.replace("../home/") </script>';
// TODO IMPORTANT - remove //


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












