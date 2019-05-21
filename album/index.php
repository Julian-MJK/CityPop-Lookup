<?php



    require '../_PHP/connection.php';
    include '../_PHP/generic_functions.php';

    // Redirecting and alerting alerting the user if no album was defined.
    isset($_GET['a']) && !empty($_GET['a']) ? $album_id = $_GET['a'] : passTo('../home/', ['msg', 'msgBGColor', 'msgColor'], ['No album selected.', 'red', 'white']); //die('No subject selected <a href="../"> click here to go back</a>');

    $sql = "SELECT * FROM album WHERE album_id='$album_id'";
    $album = $conn->query($sql)->fetch_assoc();

    // Redirecting and alerting the user if no album was found.
    if (!$album) passTo('../home/', ['msg', 'msgBGColor', 'msgColor'], ['Album with ID ' . $album_id . ' does not exist.', 'red', 'white']); //die('Subject with ' . ((isset($album_id) && !empty($album_id)) ? 'ID ' . $album_id : 'that ID') . ' doesn\'t exists, <a href="../"> click here to go back</a>.');


    $title = $album['title'];
    if (isset($album['imgURL'])) $imgURL = $album['imgURL'];
    if (isset($album['releaseYear'])) $releaseYear = $album['releaseYear'];
    if (isset($album['info'])) {
        $info = $album['info'];
    } else {
        // generates lorem ipsum for album, if no info is found.
        include '../_PHP/LoremIpsum.php';
        $lipsum = new \joshtronic\LoremIpsum();
        $info = '';
        for ($i = 0; $i < mt_rand(2, 4); $i++) {
            $info .= '<h3>'.ucfirst($lipsum->words(mt_rand(1, 5))).'</h3>';
            $info .= $lipsum->sentences(mt_rand(1,3));
            $info .= '<br><br>';
        }
    }

    $artist = new stdClass();
    $artist->id = $album['artist_id'];
    $artist->table = $conn->query('SELECT * FROM artist WHERE artist_id=' . $artist->id)->fetch_assoc();
    $artist->firstName = $artist->table['firstName'];
    $artist->lastName = isset($artist->table['lastName']) ? $artist->table['lastName'] : '';


    $songs = new stdClass();
    $songs->table = $conn->query("SELECT * FROM song WHERE album_id='$album_id'");
    $songs->count = 0;
    while ($rad = $songs->table->fetch_assoc()) {
        $songs->count++;
        $_song_id = $rad['song_id'];
        $_song_title = $rad['title'];
        $songs->all[$songs->count] = ['song_id' => $_song_id, 'title' => $_song_title];
    }

    $genres_table = $conn->query("SELECT genre FROM album_genre WHERE album_id='$album_id'");
    if ($genres_table) while ($row = $genres_table->fetch_assoc()) {
        $genres[] = $row['genre'];
    }
    $genres_count = count($genres);


    // Used in /_HTML/UI_rating.php.
    $subject = 'album';
    $subject_id = $album_id;


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title ?> | City Pop Lookup </title>
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
    <div id="subjectContainer" class="primary">

        <div class="secondary" id="subjectTitleDiv">
            <h1 class="title anim_text-expand noBottomMargin" id="editable1"> <?php echo $title ?> </h1>
            <h2 class="fancyFont anim_text-expand noTopMargin cursor_pointer" style="white-space: nowrap" onclick="window.location.href='../artist/?a=<?php echo $artist->id ?>'">
                ~
                <?php echo $artist->firstName . ' ' . $artist->lastName . (isset($releaseYear) ? ' - (' . $releaseYear . ')' : '') ?>
                ~
            </h2>
        </div>

        <div class="white frameShape pop" style="padding: 15px;" id="subjectImgContainer">
            <img src="<?php echo (isset($imgURL) && !empty(trim($imgURL))) ? $imgURL : 'https://picsum.photos/600/600'; ?>" alt="<?php echo $title ?>"
                 class="frameShape" id="subjectImg" title="<?php echo $title ?>">
            <div id="subjectImgEditPrompt" class="pop" style="display: none;">
                <input type="text" id="subjectImgEditInput" placeholder="new image url">
            </div>
            <!-- input type="file" -->
            <!--<button class="minimalistButton" onclick=""> submit image </button>-->
            <!-- kan alternativt bruke en DIV med background image && background-size:cover && background-repeat:no-repeat, og så en fast størrelse/en visibility:hidden <img> element i den. Da ville bildet mye lettere kunne vises i nøyaktig den formen og størrelsen jeg vil, men det trengs ikke her.  -->
        </div>


        <!-- INFORMATION CONTAINER -->
        <div class="row container alignLeft">
            <div class="container column" id="info_leftColumn">

                <!-- ALBUM RATINGS -->
                <?php include '../_HTML/UI_ratings.php' ?>

                <!-- ALBUM SONGS -->
                <div id="subjectAlbumsDiv" class="secondary">
                    <h1 class="fancyFont noselect"> Songs </h1>
                    <hr>
                    <?php
                        for ($j = 1; $j <= $songs->count; $j++) {
                            echo '<div class="album container row" onclick="//window.location.href=\'../song?a=' . $songs->all[$j]['song_id'] . '\'"> ' . '<h2 style="font-size: 14pt">' . $songs->all[$j]['title'] . '</h2> </div>';
                        }
                    ?>
                </div>

                <!-- ALBUM GENRES -->
                <div id="subjectAlbumsDiv" class="secondary">
                    <h1 class="fancyFont noselect"> Genres </h1>
                    <hr>
                    <?php
                        for ($j = 0; $j < $genres_count; $j++) {
                            echo '<div class="album container row" onclick="window.location.href=\'../search?query=' . $genres[$j] . '\'"> ' . '<h2 style="font-size: 14pt">' . $genres[$j] . '</h2> </div>';
                        }
                    ?>
                    <form action="../_PHP/tableManipulation/add.php" method="post" name="addGenreForm" style="width: 100%">

                        <input hidden name="table" type="text" value="album_genre">
                        <input hidden name="album_id" type="text" value="<?php echo $album_id ?>">

                        <div class="row container" style="width: 100%">
                            <h2 style="font-size: 14pt">Add</h2>
                            <input name="genre" type="text" class="minimalistInput" required style="width: 100px; background-color: transparent !important; box-shadow: none !important;">
                            <button class="retroButton" type="submit">
                                <i class="material-icons" style="font-size: 12pt; height: 12pt; width: 12pt;">library_add</i>
                            </button>
                        </div>

                    </form>
                </div>

            </div>

            <!-- ARTIST BIO -->
            <div id="subjectBio" style="max-width: 35vw" class="secondary">
                <h1 id="editable2" class="fancyFont"> <?php echo $title ?> </h1>
                <hr>
                <div id="editable3" class="container">
                    <p>
                        <?php
                            echo isset($info) ? $info : $title . ' ' . $info;
                        ?>
                    </p>
                </div>
            </div>
        </div>


        <!-- ACTION BUTTONS -->
        <?php include '../_HTML/UI_actionButtons.php' ?>


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
<?php include '../_HTML/UI_actionButtonsScript.php' ?>
</body>
</html>
