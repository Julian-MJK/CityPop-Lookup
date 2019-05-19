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

    $ratings = new stdClass();
    $ratings->table = $conn->query("SELECT rating FROM userRating_artist WHERE artist_id='" . $artist_id . "'");
    while ($row = $ratings->table->fetch_assoc()) $ratings->all[] = $row['rating'];
    $ratings->all = [1, 4, 1, 5, 4, 4, 2, 4];
    isset($ratings->all) ? $ratings->total = count($ratings->all) : $ratings->total = 0;
    if (isset($ratings->all)) $ratings->all_str = implode(', ', $ratings->all);
    if (isset($ratings->all)) $ratings->average = round(array_sum($ratings->all) / $ratings->total, 1);

    $ratings->user = $conn->query("SELECT rating FROM userRating_artist WHERE artist_id='" . $artist_id . "' AND user_id='" . $_SESSION['user_id'] . "'")->fetch_assoc()['rating'];

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
<?php include '../-HTML/UI_header.html' ?>

<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 125px">

    <!-- overlapping header (the header box uses clip-path, which also cuts child elements, therefore this is outside of the main header container.) -->
    <?php include '../-HTML/UI_onHeader.html' ?>

    <span><br></span>

    <?php include '../-HTML/UI_searchbar.html'; ?>

    <span><br><br></span>


    <div id="artistContainer" class="primary">

        <div class="secondary" id="artistTitleDiv">
            <h1 class="title anim_text-expand" id="editable1"> <?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?> </h1>
        </div>

        <div class="white frameShape pop" style="padding: 15px;" id="artistImgContainer">
            <img src="<?php echo (isset($imgURL) && !empty(trim($imgURL))) ? $imgURL : 'https://picsum.photos/800/533'; ?>" alt=""
                 class="frameShape" id="artistImg" title="<?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?>">
            <div id="artistImgEditPrompt" class="pop" style="display: none;">
                <input type="text" id="artistImgEditInput" placeholder="new image url">
                <!-- input type="file" -->
                <!--<button class="minimalistButton"> submit image url </button>-->
            </div>
            <!-- kan alternativt bruke en DIV med background image && background-size:cover && background-repeat:no-repeat, og så en fast størrelse/en visibility:hidden <img> element i den. -->
        </div>


        <!-- INFORMATION CONTAINER -->
        <div class="row container alignLeft">
            <div class="container column" id="info_leftColumn">
                <div id="artistRatingDiv" class="secondary">
                    <h1 class="fancyFont"> User ratings </h1>
                    <hr>
                    <div class="container row" id="rating_stars">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <p id="rating_avgP"> <?php echo isset($ratings->average) ? $ratings->average . ' average (' . $ratings->total . ' ratings)' : 'This artist has no ratings.'; ?> </p>
                    <script>
                        let rating_stars = $("#rating_stars .fa-star");

                        let rating = Math.round(0 <?php echo isset($ratings->user) ? '+ ' . $ratings->user : '+ ' . $ratings->average; ?> );

                        let i = 0;

                        function fillStar() {
                            rating_stars[i].classList.add("checked");
                            i++;
                            if (i < rating) setTimeout(function () {fillStar()}, 1000);
                        }
                        setTimeout(function () {fillStar()}, 2000);


                    </script>
                </div>

                <div id="artistAlbumsDiv" class="secondary">
                    <h1 class="fancyFont"> Albums </h1>
                    <hr>
                    <?php
                        for ($j = 1; $j <= $albumCount; $j++) {
                            echo '<div class="album container row cursor_pointer" onclick="window.location.href=\'../album?a=' . $albums[$j]['album_id'] . '\'"> ' . '<h2>' . $albums[$j]['title'] . '</h2>' . '<p> (' . $albums[$j]['releaseYear'] . ')</p> ' . '</div>';
                        }
                    ?>
                </div>
            </div>

            <div id="artistBio" style="max-width: 35vw" class="secondary">
                <h1 id="editable2" class="fancyFont"> <?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?> </h1>
                <hr>
                <div id="editable3" class="container">
                    <p>
                        <?php
                            echo isset($bio) ? $bio : $firstName . (isset($lastName) ? ' ' . $lastName : '') . " is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                    not only five centuries, but also the leap into electronic typesetting, remaining essentially
                    unchanged.";
                        ?>
                    </p>
                </div>
            </div>
        </div>


        <!-- ACTION BUTTONS -->
        <div class="container" id="actionButtonsContainer">
            <div class="error" id="deleteArtistDiv">
                <form action="../-PHP/tableManipulation/delete.php" method="post">
                    <button type="button" class="container"
                            onclick="if(confirm('Are you sure you want to delete <?php echo $firstName . ' ' . (isset($lastName) ? $lastName : '') ?>?')) $('#delArtist_submitBtn').click()" id="deleteArtistButton">
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


    <!-- HIDDEN EDIT FORM -->
    <form hidden action="../-PHP/tableManipulation/edit.php" method="post" style="display: none">
        <!-- target="_blank" -->
        <input hidden type="text" name="table" value="artist">
        <input hidden type="text" name="artist_id" value="<?php echo $artist_id ?>">
        <input hidden type="text" name="name" id="editForm_name">
        <input hidden type="text" name="bio" id="editForm_bio">
        <input hidden type="text" name="imgURL" id="editForm_imageURL" <?php if (isset($imgURL)) echo 'value="' . $imgURL . '"' ?>
        ">
        <button hidden type="submit" id="editForm_submitBtn"></button>
    </form>


    <span><br><br><br><br></span>



    <div class="container row">
        <!-- all artists -->
        <?php include '../-HTML/UI_allArtists.html' ?>
        <span><br><br></span>
        <!-- ADDING -->
        <?php include '../-HTML/UI_add.html' ?>
    </div>



    <span><br><br><br><br><br><br><br></span>



    <!-- footer -->
    <?php include '../-HTML/UI_footer.html' ?>




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

    // removes empty <p> tags in biography (leftovers from contentEditable)
    $('#editable3 p').each(function () {
        if ($(this).text().replace(/\s/g, '').length === 0 || $(this).text() === '') {
            $(this).remove();
        }
    });


    let eventListeners = [];

    /**
     * @method
     * @desc initiateEditMode() initiates editing mode
     */
    function initiateEditMode() {

        $("#editArtistButton")[0].querySelector("h2").innerHTML = "Submit changes";

        for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = true;

        $("#artistImgEditPrompt")[0].style.display = "flex";
        $("#artistImg")[0].style.filter = "blur(6px)";

        eventListeners[0] = $("#editable1")[0].addEventListener("input", function () {
            $("#editable2")[0].innerText = $("#editable1")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62
            });
        }, false);

        eventListeners[1] = $("#editable2")[0].addEventListener("input", function () {
            $("#editable1")[0].innerText = $("#editable2")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62
            });
        }, false);

        setTimeout(function () {$("#editArtistDiv")[0].onclick = function () {submitChanges()};}, 250);

        $("#deleteArtistButton h2")[0].innerHTML = "CANCEL";

        $("#deleteArtistButton")[0].onclick = function () {

            $("#deleteArtistButton h2")[0].innerHTML = "Delete artist?";
            $("#editArtistButton")[0].querySelector("h2").innerHTML = "Edit artist?";

            for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = false;
            $("#artistImgEditPrompt")[0].style.display = "none";
            $("#artistImg")[0].style.filter = "";

            $("#deleteArtistButton")[0].onclick = function () { if (confirm('Are you sure you want to delete <?php echo $firstName . ' ' . $lastName ?>?')) $('#delArtist_submitBtn').click() };
            setTimeout(function () {$("#editArtistDiv")[0].onclick = function () {initiateEditMode()};}, 100);

        }
    }

    //if(confirm('Are you sure you want to delete <?php echo $firstName . ' ' . $lastName ?>?')) $('#delArtist_submitBtn').click()


    /**
     * @method
     * @desc submitChanges() submits the changes by changing the values of a form, and clicking it's submit button.
     */
    window.submitChanges = function () {

        let results = [];
        for (let i = 1; i <= 3; i++) {
            results[i] = document.getElementById("editable" + i).innerHTML;
            results[i] = results[i].replace(/&nbsp;/gi, '').trim();
            results[i] = results[i].replace(/\s+/g, " ");
        }

        console.table(results);

        $("#editForm_name")[0].value = results[1];
        $("#editForm_bio")[0].value = results[3];
        if ($("#artistImgEditInput")[0].value.trim().length > 3) { // !== (undefined || '' || null || ' '))
            console.log($("#artistImgEditInput")[0].value.trim());
            $("#editForm_imageURL")[0].value = $("#artistImgEditInput")[0].value.trim();
        }

        console.log($("#editForm_name")[0].value);
        console.log($("#editForm_bio")[0].value);

        setTimeout(function () {
            $("#editForm_submitBtn").click();
        }, 250);

    };


</script>
</body>
</html>
