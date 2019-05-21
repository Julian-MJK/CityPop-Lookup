<?php

    require '../_PHP/connection.php';
    include '../_PHP/generic_functions.php';


    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];


    $ratings = new stdClass();
    $ratings->albums = new stdClass();
    $ratings->artists = new stdClass();

    // ARTIST RATINGS
    $ratings->artists->table = $conn->query('SELECT * FROM userRating_artist WHERE user_id=' . $user_id . ' ORDER BY rating DESC');
    $ratings->artists->count = 0;
    while ($row = $ratings->artists->table->fetch_assoc()) {
        $rating = $row['rating'];
        $artist_id = $row['artist_id'];
        $artist = $conn->query('SELECT firstName, lastName FROM artist WHERE artist_id=' . $artist_id)->fetch_assoc();
        $artistName = $artist['firstName'] . ' ' . $artist['lastName'];
        $ratings->artists->all[$ratings->artists->count] = ['artist_id' => $artist_id, 'artistName' => $artistName, 'rating' => $rating];
        $ratings->artists->count++;
    }


    // ALBUM RATINGS
    $ratings->albums->table = $conn->query('SELECT * FROM userRating_album WHERE user_id=' . $user_id . ' ORDER BY rating DESC');
    $ratings->albums->count = 0;
    while ($row = $ratings->albums->table->fetch_assoc()) {
        $rating = $row['rating'];
        $album_id = $row['album_id'];
        $albumTitle = $conn->query('SELECT title FROM album WHERE album_id=' . $album_id)->fetch_assoc()['title'];
        $ratings->albums->all[$ratings->albums->count] = ['album_id' => $album_id, 'title' => $albumTitle, 'rating' => $rating];
        $ratings->albums->count++;
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $username ?> | City Pop Lookup </title>
    <link rel="icon" href="../resources/img/textures/vinyl32.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <!--|Montserrat|Open+Sans|Raleway|Roboto-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
    <script src="../_JS/jquery-3.4.0.js"></script>
    <script src="../_JS/fitty.min.js"></script>

    <script src="../_JS/universal_menu.js"></script>
    <link href="../_CSS/universal_menu.css" rel="stylesheet">

    <script src="../_JS/oddUtilities.js"></script>
    <link href="../_CSS/classes.css" rel="stylesheet">

    <link href="../_CSS/universal_generic.css" rel="stylesheet">
    <link href="../_CSS/universal_theme.css" rel="stylesheet">

    <link href="../_CSS/subpages.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet">



</head>
<body>


<!-- header -->
<?php include '../_HTML/UI_header.html' ?>


<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 125px">


    <!-- stuff overlapping the header (the header box uses clip-path, which also cuts child elements, therefore this is outside of the main header container.) -->
    <?php include '../_HTML/UI_onHeader.html' ?>

    <span><br></span>


    <!-- OPTIONAL MESSAGE BAR -->
    <?php include '../_HTML/UI_msg.php' ?>


    <!-- ARTIST CONTAINER -->
    <div id="artistContainer" class="primary">

        <div class="secondary" id="artistTitleDiv">
            <h1 class="title anim_text-expand" id="editable1" style="font-size: 35pt">
                <?php echo ucwords($username) ?>'s ratings</h1>
        </div>

        <!-- RATINGS -->
        <div class="container row">

            <div id="artistRatings" style="max-width: 33vw" class="secondary">
                <h1 id="editable2" class="fancyFont"> Artists </h1>
                <hr>
                <table class="container">
                    <tr class="container">
                        <th style="border: none">Artist</th>
                        <th style="border: none">Rating</th>
                    </tr>
                    <?php
                        foreach ($ratings->artists->all as $i => $artist) {
                            echo '<tr class="container" style="background-color: transparent !important"><td>';
                            echo '<button class="minimalistButton noPadding" style="color: black; font-size: 12pt;" onclick="window.location.href=\'../artist/?a=' . $artist['artist_id'] . '\'">';
                            echo '<div class="container row" style="justify-items: center; align-items: center; justify-content: center; align-content"> ' . $artist['artistName'];
                            echo '</td><td class="table_rating">';
                            echo '<p style="color: black; margin-left: 1em">' . floor($artist['rating']) . ' / 5</p></div></button>';
                            echo '</td></tr>';
                        }
                    ?>
                </table>
            </div>
            <div id="albumRatings" style="max-width: 35vw" class="secondary">
                <h1 id="editable2" class="fancyFont"> Albums </h1>
                <hr>
                <table class="container">
                    <tr class="container">
                        <th style="border: none">Artist</th>
                        <th style="border: none">Rating</th>
                    </tr>
                    <?php
                        foreach ($ratings->albums->all as $i => $album) {
                            echo '<tr class="container" style="background-color: transparent !important"><td>';
                            echo '<button class="minimalistButton noPadding" style="color: black; font-size: 12pt;" onclick="window.location.href=\'../artist/?a=' . $album['album_id'] . '\'">';
                            echo '<div class="container row" style="justify-items: center; align-items: center; justify-content: center; align-content"> ' . $album['title'];
                            echo '</td><td class="table_rating">';
                            echo '<p style="color: black; margin-left: 1em">' . floor($album['rating']) . ' / 5</p></div></button>';
                            echo '</td></tr>';
                        }
                    ?>
                </table>
            </div>
        </div>

    </div>







    <!-- footer
    <?php include '../_HTML/UI_footer.html' ?>
    -->



</div> <!-- end of document wrapper -->
</body>
</html>
