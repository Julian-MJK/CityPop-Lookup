<?php

require '../0PHP/connection.php';

$artist_id = $_GET['a'];
$sql = "SELECT * FROM artist WHERE artist_id='$artist_id'";
$artist = $kobling->query($sql)->fetch_assoc();


$firstName = $artist['firstName'];
$lastName = $artist['lastName'];
$birthYear = $artist['birthYear'];
$imgFile = "https://aramajapan.com/wp-content/uploads/2017/07/aramajapan.com-tatsuroreborn-promo.jpg";


$albumTable = $kobling->query("SELECT * FROM album WHERE artist_id='$artist_id'");
$i = 0;
while($rad = $albumTable->fetch_assoc()){
    $i++;
    $album_id = $rad['album_id'];
    $album_title = $rad['title'];
    $album_genre = $rad['genre'];
    $album_releaseYear = $rad['releaseYear'];
    $albums[$i] = ['album_id'=>$album_id, 'title'=>$album_title, 'genre'=>$album_genre, 'releaseYear'=>$album_releaseYear];
}

$albumCount = count($albums);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> City Pop Lookup | Home </title>
    <link rel="icon" href="../resources/img/textures/vinyl32.ico">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <!--|Montserrat|Open+Sans|Raleway|Roboto-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
    <script src="../0JS/jquery-3.4.0.js"></script>

    <script src="../0JS/oddUtilities.js"></script>
    <link href="../0CSS/classes.css" rel="stylesheet">
    <link href="../0CSS/universal.css" rel="stylesheet">
    <link href="../0CSS/universal_theme.css" rel="stylesheet">

    <link rel="stylesheet" href="../0CSS/universal_menu.css">
    <script src="../0JS/universal_menu.js"></script>

    <script src="index-scrolling-and-toolbar.js"></script>

    <link href="top10.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet">


</head>
<body>

<!-- HEADER -->
<span id="headerSpan" class="clipPathShadow">
    <header style="position: fixed; z-index: 5;" class="clipPathShadow">
        <div class="column container div clipPathShadow"></div>
    </header>
</span>
<!-- END OF HEADER -->




<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 125px">
    <!-- HEADER ELEMENTS -->
    <img id="headerSymbol" src="../resources/img/textures/vinyl250.png" draggable="false">
    <div class="titleDiv shape-bat-top blackText div" style="border-radius: 0; min-height: 50px; top: 10px;" onclick="window.location.href='../home'"><h1>City
            Pop Archives</h1></div>
    <!-- END OF HEADER ELEMENTS -->

    <span><br></span>

    <?php include "../search/searchbar.php"; ?>

    <span><br><br></span>



    <div id="artistContainer" class="primary">
        <div class="secondary">
            <h1 class="title animation_text-expand"> <?php echo $firstName . ' ' . $lastName ?> </h1>
        </div>
        <div class="white frameShape pop" style="padding: 15px;">
            <img src="<?php echo $imgFile ?>" class="frameShape">
        </div>

        <div class="secondary">
            <h1> Albums </h1>
            <hr>
        <?php
            for($j=1; $j<=$albumCount; $j++){
                echo'<div class="albumDiv container row cursor_pointer" onclick="window.location.href=\'../album?album=' . $albums[$j]['album_id'] . '\'"> '.
                    '<h2>'. $albums[$j]['title'] .'</h2>'.
                    '<p> ('. $albums[$j]['releaseYear'] . ', ' . $albums[$j]['genre'] .')</p> </div>';
            }
        ?>
        </div>

        <div class="error" id="deleteArtistDiv">
            <form action="../0PHP/delete.php" method="post">
                <button type="button" class="container" onclick="if(confirm('Are you sure you want to delete <?php echo $firstName . ' ' . $lastName ?>?')) $('#delArtist_submitBtn').click()">
                    <h2>Delete artist?</h2>
                </button>
                <button type="submit" hidden id="delArtist_submitBtn"></button>
                <input type="text" name="id" hidden value="<?php echo $artist_id?>">
                <input type="text" name="table" hidden value="artist">
            </form>
        </div>

    </div>



    <span><br><br><br><br></span>



    <div id="allArtists" class="primary">
        <h1 style="margin: 15px;""> ALL ARTISTS </h1>
        <?php $artists = $kobling->query("SELECT * FROM artist ORDER BY firstName");
        while ($row = $artists->fetch_assoc()) {
            $artist_id = $row['artist_id'];
            $artist_firstName = $row['firstName'];
            $artist_lastName = $row['lastName'];
            echo "<h3 style='width: 100%; text-align: left; margin-left: 7%;'> " .
                "<a href='../artist?a=$artist_id'> $artist_firstName $artist_lastName </a> </h3>";
        } ?>
    </div>



    <span><br><br></span>



    <!-- ADDING -->
    <?php include "../0PHP/adding.php" ?>



    <span><br><br><br><br><br><br><br></span>




    <!-- footer -->
    <div id="footer">
        <div class="lowBound"><p></p>
            <p></p></div>
        <div class="column square secondaryVariant">

            <p contenteditable="true"> This is a footer! Isn't it neat? </p>
            <p style="font-family: 'MS PMincho',serif; font-size: 18pt;"> ロイヤルーカジノ</p>

        </div>
        <div class="lowBound"><p></p>
            <p></p></div>
    </div>

</div> <!-- end of document wrapper -->
<script>




</script>
</body>
</html>
