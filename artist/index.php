<?php

    require '../_PHP/connection.php';
    include '../_PHP/generic_functions.php';

    // Alerting the user if no artist

    isset($_GET['a']) && !empty($_GET['a']) ? $artist_id = $_GET['a'] : passTo('../home/', ['msg', 'msgBGColor', 'msgColor'], ['No artist selected.', 'red', 'white']); //die('No artist selected <a href="../"> click here to go back</a>');

    $sql = "SELECT * FROM artist WHERE artist_id='$artist_id'";
    $artist = $conn->query($sql)->fetch_assoc();

    if (!$artist) passTo('../home/', ['msg', 'msgBGColor', 'msgColor'], ['Artist with ID ' . $artist_id . ' does not exist.', 'red', 'white']); //die('Artist with ' . ((isset($artist_id) && !empty($artist_id)) ? 'ID ' . $artist_id : 'that ID') . ' doesn\'t exists, <a href="../"> click here to go back</a>.');

    $firstName = $artist['firstName'];
    if (isset($artist['lastName'])) $lastName = $artist['lastName'];
    if (isset($artist['birthYear'])) $birthYear = $artist['birthYear'];
    if (isset($artist['imgURL'])) $imgURL = $artist['imgURL'];
    if (isset($artist['bio'])) {
        $bio = $artist['bio'];
    } else {
        // generates lorem ipsum for artist, if no bio is found.
        include '../_PHP/LoremIpsum.php';
        $lipsum = new \joshtronic\LoremIpsum();
        $bio = '';
        for ($i = 0; $i < mt_rand(1, 3); $i++) {
            $bio .= '<h3>'.ucfirst($lipsum->words(mt_rand(1, 5))).'</h3>';
            $bio .= $lipsum->sentences(mt_rand(2,4));
            $bio .= '<br><br>';
        }
    }

    $albums = new stdClass();
    $albums->table = $conn->query("SELECT * FROM album WHERE artist_id='$artist_id' ORDER BY releaseYear ASC");
    $albums->count = 0;
    while ($rad = $albums->table->fetch_assoc()) {
        $albums->count++;
        $_album_id = $rad['album_id'];
        $_album_title = $rad['title'];
        $_album_releaseYear = $rad['releaseYear'];
        $albums->all[$albums->count] = ['album_id' => $_album_id, 'title' => $_album_title, 'releaseYear' => $_album_releaseYear];
    }

    // Used in /_HTML/UI_rating.php.
    $subject = 'artist';
    $subject_id = $artist_id;


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?> | City Pop Lookup </title>
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



</head>
<body>


<!-- header -->
<?php include '../_HTML/UI_header.html' ?>


<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 125px">


    <!-- stuff overlapping the header (the header box uses clip-path, which also cuts child elements, therefore this is outside of the main header container.) -->
    <?php include '../_HTML/UI_onHeader.html' ?>
    <span><br></span>


    <!-- SEARCH BAR -->
    <?php include '../_HTML/UI_searchbar.html'; ?>
    <span><br><br></span>


    <!-- OPTIONAL MESSAGE BAR -->
    <?php include '../_HTML/UI_msg.php' ?>


    <!-- ARTIST CONTAINER -->
    <div id="artistContainer" class="primary">

        <div class="secondary" id="artistTitleDiv">
            <h1 class="title anim_text-expand" id="editable1"> <?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?> </h1>
        </div>

        <div class="white frameShape pop" style="padding: 15px;" id="subjectImgContainer">
            <img src="<?php echo (isset($imgURL) && !empty(trim($imgURL))) ? $imgURL : 'https://picsum.photos/800/533'; ?>" alt="<?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?>"
                 class="frameShape" id="subjectImg" title="<?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?>">
            <div id="subjectImgEditPrompt" class="pop" style="display: none;">
                <input type="text" id="subjectImgEditInput" placeholder="new image url">
            </div>
            <!-- input type="file" -->
            <!--<button class="minimalistButton" onclick=""> submit image </button>-->
            <!-- kan alternativt bruke en DIV med background image && background-size:cover && background-repeat:no-repeat, og så en fast størrelse/en visibility:hidden <img> element i den. -->
        </div>


        <!-- INFORMATION CONTAINER -->
        <div class="row container alignLeft">
            <div class="container column" id="info_leftColumn">

                <!-- ARTIST RATINGS -->
                <?php include '../_HTML/UI_ratings.php' ?>


                <!-- ARTIST ALBUMS -->
                <div id="subjectAlbumsDiv" class="secondary noselect">
                    <h1 class="fancyFont"> <i class="material-icons">album</i>Albums<i class="material-icons">album</i> </h1>
                    <hr>
                    <?php
                        for ($j = 1; $j <= $albums->count; $j++) {
                            echo '<div class="album container row cursor_pointer" onclick="window.location.href=\'../album?a=' . $albums->all[$j]['album_id'] . '\'"> ' . '<h2>' . $albums->all[$j]['title'] . '</h2>' . '<p> (' . $albums->all[$j]['releaseYear'] . ')</p> ' . '</div>';
                        }
                    ?>
                </div>
            </div>

            <!-- ARTIST BIO -->
            <div id="artistBio" style="max-width: 35vw" class="secondary">
                <h1 id="editable2" class="fancyFont"> <?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?> </h1>
                <hr>
                <div id="editable3" class="container">
                    <p>
                        <?php
                            echo $bio;
                        ?>
                    </p>
                </div>
            </div>
        </div>


        <!-- ACTION BUTTONS -->
        <?php include '../_HTML/UI_actionButtons.php' ?>
        <!-- / -->


    </div>



    <span><br><br><br><br></span>




    <div class="container row">

        <!-- ALL ARTISTS -->
        <?php include '../_HTML/UI_allArtists.php' ?>

        <span><br><br></span>

        <!-- ADDING -->
        <?php include '../_HTML/UI_add.html' ?>

    </div>



    <span><br><br><br><br><br><br><br></span>



    <!-- footer -->
    <?php include '../_HTML/UI_footer.html' ?>


</div> <!-- end of document wrapper -->
<?php include '../_HTML/BTS_actionButtonsScript.php' ?>
</body>
</html>
