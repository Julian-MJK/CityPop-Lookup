<?php
/**
 * Created by IntelliJ IDEA.
 * User: ジュリアン
 * Date: 12.05.2019
 * Time: 06:40 PM
 */

require "../0PHP/connection.php";


$sql_artist = "SELECT * FROM artist";
$sql_album = "SELECT * FROM album";
$sql_song = "SELECT * FROM song";

$query = $_GET["query"];

echo "<h1> Results for <span class='fancyFont'>\"$query\"</span> </h1>";

$query = strtolower($query);

// SEPARATES THE QUERY INTO AN ARRAY, SPLIT AT EACH SPACE CHARACTER
$queries = explode(' ', $query);
$queriesN = count($queries);

// FETCHES TABLES
$artists = $kobling->query($sql_artist);
$albums = $kobling->query($sql_album);
$songs = $kobling->query($sql_song);


echo "<p class='smallText'> The database contains in total $artists->num_rows artists, $albums->num_rows albums and $songs->num_rows songs. </p> <br>";

$specificity = [
    "song" => 100,
    "album" => 10,
    "artist" => 1,
];



/*if(strpos($query, ' ') !== false) $words = substr_count($query, ' ');*/
/*
$kobling->query("DELETE FROM artist WHERE lastName='Iwasaki'");
$kobling->query("INSERT INTO artist (firstName, lastName) VALUES ('Hiromi', 'Iwasaki')");
$kobling->query("INSERT INTO artist (firstName, lastName) VALUES ('Yoshimi', 'Iwasaki')");
*/


// LOOPS THROUGH THE QUERIES
for ($i = 0; $i < $queriesN; $i++) {

    // LOOPS THROUGH THE $artists TABLE AND CHECKS IF ANY VALUES ARE EQUAL TO THE CURRENT QUERY
    while ($row = $artists->fetch_assoc()) {
        if (
            $queries[$i] === strtolower($row['firstName'])|| //Grouping this up with the previous check, I.E. ($queries[$i] || $query) ===, doesn't work.
            $queries[$i] === strtolower($row['lastName']) ||
            $queries[$i] === strtolower($row['birthYear'])||
            stripos($row['firstName'], $queries[$i]) !== false ||
            stripos($row['lastName'], $queries[$i]) !== false
        ) {
            $result['artist'][] = $row;
        }
    }

    // LOOPS THROUGH THE $artists TABLE AND CHECKS IF ANY VALUES ARE EQUAL TO THE CURRENT QUERY
    while ($row = $albums->fetch_assoc()) {
        if (
            //$query === strtolower($row['title']) || //checks the entire query as the title and genre can contain multiple words.
            //$query === strtolower($row['genre']) ||
            $queries[$i] === strtolower($row['title']) ||
            $queries[$i] === strtolower($row['genre']) ||
            $queries[$i] === strtolower($row['releaseYear']) ||
            // Checks if the following include the query word in them.
            stripos($row['title'], $queries[$i]) !== false ||
            stripos($row['genre'], $queries[$i]) !== false
        ) {
            $result['album'][] = $row;
        }
    }

    while ($row = $songs->fetch_assoc()) {
        if (
            //$query === strtolower($row['title']) ||
            $queries[$i] === strtolower($row['title']) ||
            stripos($row['title'], $queries[$i]) !== false
        ) {
            $result['song'][] = $row;
        }
    }
}

// IF A RESULT IS FOUND
if (isset($result)) {

    // IF AN ARTIST IS FOUND
    if (isset($result['artist'])) {

        // COUNTS HOW MANY ARTISTS ARE FOUND
        $count = count($result['artist']);
        echo '<h1> Found ' . $count . ' artist' . (($count > 1) ? 's' : '') . ' </h1>';
        echo '<table class="searchResultTable"><tr><th>artist_id</th><th>firstName</th><th>lastName</th><th>birthYear</th></tr>';

        // ADDS A ROW FOR EACH ARTIST FOUND
        for ($i = 0; $i < $count; $i++) {
            $artist_id = $result['artist'][$i]['artist_id'];
            $artist_firstName = $result['artist'][$i]['firstName'];
            $artist_lastName = $result['artist'][$i]['lastName'];
            $artist_birthYear = $result['artist'][$i]['birthYear'];
            echo"<tr onclick='window.location.href=\"../artist?artist=$artist_id\"' class='tr'>" .
                "<td>$artist_id</td>" .
                "<td>$artist_firstName</td>" .
                "<td>$artist_lastName</td>" .
                "<td>$artist_birthYear</td>" .
                "</tr>";
        }
        echo '</table>';
    }


    // IF AN ALBUM IS FOUND
    if (isset($result['album'])) {

        // COUNTS HOW MANY ALBUMS ARE FOUND
        $count = count($result['album']);
        echo '<h1> Found ' . $count . ' album' . (($count > 1) ? 's' : '') . ' </h1>';
        echo '<table><tr><th>album_id</th><th>artist_id</th><th>title</th><th>genre</th><th>releaseYear</th></tr>';

        // ADDS A ROW FOR EACH ALBUM FOUND
        for ($i = 0; $i < $count; $i++) {
            $album_id = $result['album'][$i]['album_id'];
            $artist_id = $result['album'][$i]['artist_id'];
            $album_title = $result['album'][$i]['title'];
            $album_genre = $result['album'][$i]['genre'];
            $album_releaseYear = $result['album'][$i]['releaseYear'];
            echo "<tr>" .
                "<td>$album_id</td>" .
                "<td>$artist_id</td>" .
                "<td>$album_title</td>" .
                "<td>$album_genre</td>" .
                "<td>$album_releaseYear</td>" .
                "</tr>";
        }
        echo '</table>';
    }


    // IF A SONG IS FOUND
    if (isset($result['song'])) {

        // COUNTS HOW MANY SONGS ARE FOUND
        $count = count($result['song']);
        echo '<h1> Found ' . $count . ' song' . (($count > 1) ? 's' : '') . '</h1>';
        echo '<table><tr><th>song_id</th><th>album_id</th><th>title</th></tr>';

        // ADDS A ROW FOR EACH SONG FOUND
        for ($i = 0; $i < $count; $i++) {
            $album_id = $result['song'][$i]['album_id'];
            $song_id = $result['song'][$i]['song_id'];
            $song_title = $result['song'][$i]['title'];
            echo "<tr>" .
                "<td>$album_id</td>" .
                "<td>$song_id</td>" .
                "<td>$song_title</td>" .
                "</tr>";
        }
        echo '</table>';
    }

}

?>


