<?php

require '../0PHP/connection.php';

$artist_id = $_GET['a'];
$sql = "SELECT * FROM artist WHERE artist_id='$artist_id'";
$artist = $kobling->query($sql)->fetch_assoc();


$firstName = $artist['firstName'];
if(isset($artist['lastName']))  $lastName   = $artist['lastName'];
if(isset($artist['birthYear'])) $birthYear  = $artist['birthYear'];
if(isset($artist['imgURL']))    $imgURL     = $artist['imgURL'];
if(isset($artist['bio']))       $bio        = $artist['bio'];


$albumTable = $kobling->query("SELECT * FROM album WHERE artist_id='$artist_id'");
$albumCount = 0;
while ($rad = $albumTable->fetch_assoc()) {
    $albumCount++;
    $album_id = $rad['album_id'];
    $album_title = $rad['title'];
    $album_releaseYear = $rad['releaseYear'];
    $albums[$albumCount] = ['album_id' => $album_id, 'title' => $album_title, 'releaseYear' => $album_releaseYear];
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $firstName . " " . $lastName ?> | City Pop Lookup </title>
    <link rel="icon" href="../resources/img/textures/vinyl32.ico">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <!--|Montserrat|Open+Sans|Raleway|Roboto-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
    <script src="../0JS/jquery-3.4.0.js"></script>

    <script src="../0JS/universal_menu.js"></script>
    <link href="../0CSS/universal_menu.css" rel="stylesheet">

    <script src="../0JS/oddUtilities.js"></script>
    <link href="../0CSS/classes.css" rel="stylesheet">

    <link href="../0CSS/universal.css" rel="stylesheet">
    <link href="../0CSS/universal_theme.css" rel="stylesheet">

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

    <!-- HEADER TITLE -->
    <div class="titleDiv shape-bat-top blackText div"
         style="border-radius: 0; min-height: 50px; top: 10px;" onclick="window.location.href='../'"><h1>City Pop Lookup</h1></div>


    <span><br></span>


    <?php include "../search/searchbar.php"; ?>


    <span><br><br></span>


    <div id="artistContainer" class="primary">
        <div class="secondary" id="artistTitleDiv">
            <h1 class="title animation_text-expand"> <?php echo $firstName . ' ' . $lastName ?> </h1>
        </div>
        <div class="white frameShape pop" style="padding: 15px;" id="artistImgContainer">
            <img src="<?php if(isset($imgURL)){echo $imgURL; } else { echo 'https://picsum.photos/800/533'; } ?>" class="frameShape" id="artistImg" title="<?php echo $firstName . ' '; echo (isset($lastName))?$lastName:"";?>">
        </div>

        <div class="row container alignLeft">
            <div class="secondary" id="artistAlbumsDiv">
                <h1 class="fancyFont"> Albums </h1>
                <hr>
                <?php
                for ($j = 1; $j <= $albumCount; $j++) {
                    echo '<div class="album container row cursor_pointer" onclick="window.location.href=\'../album?album=' . $albums[$j]['album_id'] . '\'"> ' .
                        '<h2>' . $albums[$j]['title'] . '</h2>' .
                        '<p> (' . $albums[$j]['releaseYear'] . ')</p> ' .
                        '</div>';
                }
                ?>
            </div>
            <div class="secondary" id="artistBio" style="max-width: 30vw">
                <h1 class="fancyFont"> <?php echo $firstName . ' ' . $lastName ?> </h1>
                <hr>
                <p>
                    <?php
                    if(isset($bio)){
                        echo $bio;
                    } else echo $firstName . ' ' . $lastName . " is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                    not only five centuries, but also the leap into electronic typesetting, remaining essentially
                    unchanged.";
                    ?>
                </p>
            </div>
        </div>


        <div class="error" id="deleteArtistDiv">
            <form action="../0PHP/delete.php" method="post">
                <button type="button" class="container"
                        onclick="if(confirm('Are you sure you want to delete <?php echo $firstName . ' ' . $lastName ?>?')) $('#delArtist_submitBtn').click()">
                    <h2>Delete artist?</h2>
                </button>
                <button type="submit" hidden id="delArtist_submitBtn"></button>
                <input type="text" name="id" hidden value="<?php echo $artist_id ?>">
                <input type="text" name="table" hidden value="artist">
            </form>
        </div>

    </div>



    <span><br><br><br><br></span>


    <div class="container row">
        <!-- all artists -->
        <!--<?php include "../0PHP/allArtists.php" ?>-->
        <span><br><br></span>
        <!-- ADDING -->
        <?php include "../0PHP/adding.php" ?>
    </div>






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
