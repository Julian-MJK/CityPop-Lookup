<?php

    require '../-PHP/connection.php';

    $artist_id = $_GET['a'];
    $sql = "SELECT * FROM artist WHERE artist_id='$artist_id'";
    $artist = $conn->query($sql)->fetch_assoc();


    $firstName = $artist['firstName'];
    if (isset($artist['lastName'])) $lastName = $artist['lastName'];
    if (isset($artist['birthYear'])) $birthYear = $artist['birthYear'];
    if (isset($artist['imgURL'])) $imgURL = $artist['imgURL'];
    if (isset($artist['bio'])) $bio = $artist['bio'];


    $albumTable = $conn->query("SELECT * FROM album WHERE artist_id='$artist_id'");
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
    <script src="../-JS/jquery-3.4.0.js"></script>
    <script src="../-JS/fitty.min.js"></script>

    <script src="../-JS/universal_menu.js"></script>
    <link href="../-CSS/universal_menu.css" rel="stylesheet">

    <script src="../-JS/oddUtilities.js"></script>
    <link href="../-CSS/classes.css" rel="stylesheet">

    <link href="../-CSS/universal.css" rel="stylesheet">
    <link href="../-CSS/universal_theme.css" rel="stylesheet">

    <link href="stylesheet.css" rel="stylesheet">



</head>
<body>

<!-- header -->
<?php include '../-PHP/UI_header.html' ?>

<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 125px">

    <!-- overlapping header (the header box uses clip-path, which also cuts child elements, therefore this is outside of the main header container.) -->
    <?php include '../-PHP/UI_onHeader.html' ?>

    <span><br></span>

    <?php include "../search/searchbar.php"; ?>

    <span><br><br></span>


    <div id="artistContainer" class="primary">

        <div class="secondary" id="artistTitleDiv">
            <h1 class="title anim_text-expand" id="editable1"> <?php echo $firstName . ' ' . $lastName ?> </h1>
        </div>

        <div class="white frameShape pop" style="padding: 15px;" id="artistImgContainer">
            <img src="<?php echo isset($imgURL) ? $imgURL : 'https://picsum.photos/800/533'; ?>" alt=""
                 class="frameShape" id="artistImg" title="<?php echo $firstName . ' ';
                echo isset($lastName) ? $lastName : ''; ?>">
            <!-- kan alternativt bruke en DIV med background image && background-size:cover && background-repeat:no-repeat, og så en fast størrelse/en visibility:hidden <img> element i den. -->
        </div>

        <!-- Information container -->
        <div class="row container alignLeft">

            <div id="artistAlbumsDiv" class="secondary">
                <h1 class="fancyFont"> Albums </h1>
                <hr>
                <?php
                    for ($j = 1; $j <= $albumCount; $j++) {
                        echo '<div class="album container row cursor_pointer" onclick="window.location.href=\'../album?album=' . $albums[$j]['album_id'] . '\'"> ' . '<h2>' . $albums[$j]['title'] . '</h2>' . '<p> (' . $albums[$j]['releaseYear'] . ')</p> ' . '</div>';
                    }
                ?>
            </div>

            <div id="artistBio" style="max-width: 35vw" class="secondary">
                <h1 id="editable2" class="fancyFont"> <?php echo $firstName . ' ' . $lastName ?> </h1>
                <hr>
                <div id="editable3" class="container">
                    <p></p><?php
                        echo isset($bio) ? $bio : $firstName . ' ' . $lastName . " is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                    not only five centuries, but also the leap into electronic typesetting, remaining essentially
                    unchanged.";
                    ?>
                </div>
            </div>
        </div>

        <!-- action buttons -->
        <div class="container" id="actionButtonsContainer">
            <div class="error" id="deleteArtistDiv">
                <form action="../-PHP/delete.php" method="post">
                    <button type="button" class="container"
                            onclick="if(confirm('Are you sure you want to delete <?php echo $firstName . ' ' . $lastName ?>?')) $('#delArtist_submitBtn').click()" id="deleteArtistButton">
                        <h2>Delete artist?</h2>
                    </button>
                    <button type="submit" hidden id="delArtist_submitBtn"></button>
                    <input type="text" name="id" hidden value="<?php echo $artist_id ?>">
                    <input type="text" name="table" hidden value="artist">
                </form>
            </div>

            <div class="" id="editArtistDiv">
                <button onclick="initiateEditMode()" id="editArtistButton" class="container">
                    <h2>Edit artist?</h2>
                </button>
            </div>
        </div>
        <!-- / -->
    </div>

    <form action="../-PHP/edit.php" method="post" target="_blank" style="display: none">
        <input hidden type="text" name="table" value="artist">
        <input hidden type="text" name="artist_id" value="<?php echo $artist_id ?>">
        <input hidden type="text" name="name" id="editForm_name">
        <input hidden type="text" name="bio" id="editForm_bio">
        <button hidden type="submit" id="editForm_submitBtn"></button>
    </form>

    <span><br><br><br><br></span>

    <div class="container row">
        <!-- all artists -->
        <?php include "../-PHP/UI_allArtists.html" ?>
        <span><br><br></span>
        <!-- ADDING -->
        <?php include "../-PHP/UI_add.html" ?>
    </div>

    <span><br><br><br><br><br><br><br></span>

    <!-- footer -->
    <?php include '../-PHP/UI_footer.html' ?>


</div> <!-- end of document wrapper -->
<script>

    // prevents chrome adding a new <div> element on "enter" keypress in contenteditable=true.
    document.execCommand('defaultParagraphSeparator', false, 'p');

    window.onresize = function () {
        fitty('#editable1', {
            minSize: 30,
            maxSize: 62
        });
    };


    let eventListeners = [];

    function initiateEditMode() {

        $("#editArtistButton")[0].querySelector("h2").innerHTML = "Submit changes";

        for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = true;

        eventListeners[0] = $("#editable1")[0].addEventListener("input", function () {
            $("#editable2")[0].innerText = $("#editable1")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62
            });
            setTimeout(function () {
                if ($("#editable2")[0].innerText === "") $("#editable2")[0].innerText = " ";
                if ($("#editable1")[0].innerText === "") $("#editable1")[0].innerText = " ";
            }, 100);
        }, false);

        eventListeners[1] = $("#editable2")[0].addEventListener("input", function () {
            $("#editable1")[0].innerText = $("#editable2")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62
            });
            setTimeout(function () {
                if ($("#editable2")[0].innerText === "") $("#editable2")[0].innerText = " ";
                if ($("#editable1")[0].innerText === "") $("#editable1")[0].innerText = " ";
            }, 100);
        }, false);

        setTimeout(function () {$("#editArtistDiv")[0].onclick = function () {submitChanges()};}, 250);

        $("#deleteArtistButton h2")[0].innerHTML = "CANCEL";
        $("#deleteArtistButton")[0].onclick = function () {

            $("#editArtistButton")[0].querySelector("h2").innerHTML = "Edit artist?";
            for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = false;

            setTimeout(function () {$("#editArtistDiv")[0].onclick = function () {initiateEditMode()};}, 100);
            $("#deleteArtistButton h2")[0].innerHTML = "Delete artist?";
            $("#deleteArtistButton")[0].onclick = function () { if (confirm('Are you sure you want to delete <?php echo $firstName . ' ' . $lastName ?>?')) $('#delArtist_submitBtn').click() };
        }
    }

    //if(confirm('Are you sure you want to delete <?php echo $firstName . ' ' . $lastName ?>?')) $('#delArtist_submitBtn').click()


    window.submitChanges = function () {

        let results = [];
        for (let i = 1; i <= 3; i++) {
            results[i] = document.getElementById("editable" + i).innerHTML;
        }
        console.table(results);


        $("#editForm_name")[0].value = results[1];
        $("#editForm_bio")[0].value = results[3];

        console.log($("#editForm_name")[0].value);
        console.log($("#editForm_bio")[0].value);

        setTimeout(function () {
            $("#editForm_submitBtn").click();
        }, 250);

    };


</script>
</body>
</html>
