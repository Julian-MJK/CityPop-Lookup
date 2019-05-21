<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 12.05.2019
     * Time: 06:40 PM
     */

    require '../_PHP/connection.php';

    $sortBy_artist = 'firstName';
    $sortBy_album = 'title';

    $sql_artist = 'SELECT * FROM artist ORDER BY ' . $sortBy_artist;
    $sql_album = 'SELECT * FROM album ORDER BY ' . $sortBy_album;
    $sql_song = 'SELECT * FROM song';
    $sql_genre = 'SELECT * FROM album_genre';
    //$sql_genre = "SELECT album_id FROM album-genre WHERE genre LIKE %$query%";

    $query = $_GET["query"];

    echo "<h1> Results for <span class='fancyFont'>\"$query\"</span> </h1>";

    $query = strtolower($query);

    // SEPARATES THE QUERY INTO AN ARRAY, SPLIT AT EACH SPACE CHARACTER
    $queries = explode(' ', $query);
    $queriesN = count($queries);

    // FETCHES TABLES
    $artists = $conn->query($sql_artist);
    $albums = $conn->query($sql_album);
    $songs = $conn->query($sql_song);
    $genres = $conn->query($sql_genre);


    echo "<p class='smallText'> The database contains in total $artists->num_rows artists, $albums->num_rows albums and $songs->num_rows songs. </p> <br>";

    $specificity = ["song" => 100, "album" => 10, "artist" => 1,];


    /*if(strpos($query, ' ') !== false) $words = substr_count($query, ' ');*/
    /*
    $conn->query("DELETE FROM artist WHERE lastName='Iwasaki'");
    $conn->query("INSERT INTO artist (firstName, lastName) VALUES ('Hiromi', 'Iwasaki')");
    $conn->query("INSERT INTO artist (firstName, lastName) VALUES ('Yoshimi', 'Iwasaki')");
    */


    // LOOPS THROUGH THE QUERIES
    for ($i = 0; $i < $queriesN; $i++) {
        $queries[$i] = strtolower($queries[$i]);

        // LOOPS THROUGH THE $artists TABLE AND CHECKS IF ANY VALUES ARE EQUAL TO THE CURRENT QUERY
        while ($row = $artists->fetch_assoc()) {
            if ($queries[$i] === strtolower($row['firstName']) || //Grouping this up with the previous check, I.E. ($queries[$i] || $query) ===, doesn't work.
                $queries[$i] === strtolower($row['lastName']) || $queries[$i] === strtolower($row['birthYear']) || stripos($row['firstName'], $queries[$i]) !== false || stripos($row['lastName'], $queries[$i]) !== false) {
                $result['artist'][] = $row;
            }
        }


        // LOOPS THROUGH THE $artists TABLE AND CHECKS IF ANY VALUES ARE EQUAL TO THE CURRENT QUERY
        while ($row = $albums->fetch_assoc()) {
            if ($queries[$i] === strtolower($row['title']) || $queries[$i] === strtolower($row['releaseYear']) || stripos($row['title'], $queries[$i]) !== false) {
                $result['album'][] = $row;
            }

        }

        while ($row = $songs->fetch_assoc()) {
            if ($queries[$i] === strtolower($row['title']) || stripos($row['title'], $queries[$i]) !== false) {
                $result['song'][] = $row;
            }
        }
        // alternatively bare f.eks.: $sql_Artist = "SELECT * FROM artist WHERE (firstName LIKE '%$queries[$j]%' OR lastName LIKE '%$queries[$j]%') ORDER BY $sortBy"; kan og bruke "LIMIT $limit" og med et offset per page.
        // Jeg gjør det på denne metoden for høyere customizeability (f.eks. vil jeg ikke at alle album med sjangeren "funk" vises når man søker på bokstaven "u"),
        // Men også fordi da måtte jeg ha kjørt en query og bedt serveren om informasjon en gang per søke-ord, per tabell, som har høyere variasjon i effektivitet da det vil kommunisere fram og tilbake med databasen.
        // Lagrer heller hele tabellene i starten og ser gjennom den med php, som jeg gjør nå, for mindre variabel hastighetsforskjell..


        while ($row = $genres->fetch_assoc()) {
            if ($queries[$i] === strtolower($row['genre']) || strtolower($query) === strtolower($row['genre'])/* || stripos($row['genre'], $queries[$i]) !== false*/) {
                $result['genre'][] = $conn->query('SELECT * FROM album WHERE album_id=' . $row['album_id'])->fetch_assoc();
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
            echo '<table class="searchResultTable pop"><tr><th>artist_id</th><th>firstName</th><th>lastName</th><th>birthYear</th></tr>';

            // ADDS A ROW FOR EACH ARTIST FOUND
            for ($i = 0; $i < $count; $i++) {
                $artist_id = $result['artist'][$i]['artist_id'];
                $artist_firstName = $result['artist'][$i]['firstName'];
                $artist_lastName = $result['artist'][$i]['lastName'];
                $artist_birthYear = $result['artist'][$i]['birthYear'];
                if ($artist_birthYear === '2120') $artist_birthYear = '';
                echo "<tr onclick='window.location.href=\"../artist?a=$artist_id\"' class='tr'><td>$artist_id</td><td>$artist_firstName</td><td>$artist_lastName</td><td>$artist_birthYear</td></tr>";
            }
            echo '</table>';
        }


        // IF AN ALBUM IS FOUND
        if (isset($result['album'])) {

            // COUNTS HOW MANY ALBUMS ARE FOUND
            $count = count($result['album']);
            echo '<h1> Found ' . $count . ' album' . (($count > 1) ? 's' : '') . ' </h1>';
            echo '<table class="searchResultTable pop"><tr><th>album_id</th><th>artist_id</th><th>title</th><!--<th>genre</th>--><th>releaseYear</th></tr>';

            // ADDS A ROW FOR EACH ALBUM FOUND
            for ($i = 0; $i < $count; $i++) {
                $album_id = $result['album'][$i]['album_id'];
                $artist_id = $result['album'][$i]['artist_id'];
                $album_title = $result['album'][$i]['title'];
                //$album_genre = $result['album'][$i]['genre'];
                $album_releaseYear = $result['album'][$i]['releaseYear'];
                echo "<tr onclick='window.location.href=\"../album?a=$album_id\"' class='tr'><td>$album_id</td><td>$artist_id</td><td>$album_title</td><td>$album_releaseYear</td></tr>";
            }
            echo '</table>';
        }


        // IF A GENRE IS FOUND
        if (isset($result['genre'])) {

            // COUNTS HOW MANY SONGS ARE FOUND
            $count = count($result['genre']);

            echo '<h1> Found ' . $count . ' genre match' . (($count > 1) ? 'es' : '') . '</h1>';
            echo '<table class="searchResultTable pop"><tr><th>album_id</th><th>title</th><th>artist</th><th>releaseYear</th></tr>';

            // ADDS A ROW FOR EACH GENRE FOUND
            for ($i = 0; $i < $count; $i++) {
                $album_id = $result['genre'][$i]['album_id'];
                $album_title = $result['genre'][$i]['title'];
                $album_artist_id = $result['genre'][$i]['artist_id'];
                $album_artist = $conn->query('SELECT * FROM artist WHERE artist_id=' . $album_artist_id)->fetch_assoc();
                $album_artist_name = $album_artist['firstName'] . ' ' . $album_artist['lastName'];
                $album_releaseYear = $result['genre'][$i]['releaseYear'];
                echo "<tr onclick='window.location.href=\"../album?a=$album_id\"' class='tr'> <td>$album_id</td><td>$album_title</td><td>$album_artist_name</td><td>$album_releaseYear</td></tr>";
            }
            echo '</table>';
        }

        // IF A SONG IS FOUND
        if (isset($result['song'])) {

            // COUNTS HOW MANY SONGS ARE FOUND
            $count = count($result['song']);
            echo '<h1> Found ' . $count . ' song' . (($count > 1) ? 's' : '') . '</h1>';
            echo '<table class="searchResultTable pop"><tr><th>song_id</th><th>album_id</th><th>title</th></tr>';

            // ADDS A ROW FOR EACH SONG FOUND
            for ($i = 0; $i < $count; $i++) {
                $album_id = $result['song'][$i]['album_id'];
                $song_id = $result['song'][$i]['song_id'];
                $song_title = $result['song'][$i]['title'];
                echo "<tr onclick='window.location.href=\"../album?a=$album_id\"' class='tr'><td>$album_id</td><td>$song_id</td><td>$song_title</td></tr>";
            }
            echo '</table>';
        }
    }


?>


