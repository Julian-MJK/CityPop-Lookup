
<?php
require '../0PHP/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> City Pop Lookup </title>
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

    <!--<link rel="stylesheet" href="../0CSS/universal_menu.css">
    <script src="../0JS/universal_menu.js">rmh_href = "../0PHP/login.php";</script>-->

    <script src="index_boxes.js"></script>
    <script src="index-scrolling-and-toolbar.js"></script>



</head>
<body>

<!-- HEADER -->
<span id="headerSpan" class="clipPathShadow">
    <header style="position: fixed; z-index: 5;" class="clipPathShadow">
        <div class="column container div clipPathShadow"></div>
    </header>
</span>
<!-- END OF HEADER -->
<!-- TOOLBAR -->
<div id="toolbarLeft" class="toolbar">
    <div class="toolbarItem">
        <div class="container row" id="tokenCountDiv">
            <p>Songs</p>
            <img src="../resources/img/textures/vinyl32.ico" alt="token" id="tokenCountToken">
            <p id="songsCount">x <?php echo $kobling->query("SELECT * FROM song")->num_rows ?> </p>
        </div>
    </div>
</div>
<div id="toolbarRight" class="toolbar">
    <div id="profileSettings" class="toolbarItem"><p>Delete a table</p></div>
    <div id="logoutButton"><p></p></div>
</div>
<!-- END OF TOOLBAR -->




<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 325px">
    <!-- HEADER ELEMENTS -->
    <img id="headerSymbol" src="../resources/img/textures/vinyl250.png" draggable="false">
    <div class="titleDiv shape-diamond blackText div" style="border-radius: 0; min-height: 50px; top: 10px;" onclick="window.location.href='../home'"><h1>City
            Pop Lookup</h1></div>
    <!-- END OF HEADER ELEMENTS -->



    <span><br></span>


    <!-- MAIN ELEMENTS -->

    <?php include "../search/searchbar.php"; ?>

    <span><br><br><br></span>


    <!-- INFO BOX -->
    <div id="textBox" style="width: 50vw; font-size: 14pt;"
         class="frame leanUpRightPerma leanNormal secondaryVariant hoverFillPrimary">
        <h1 class="title">City Pop</h1>
        <p>
            <a href="https://www.nippon.com/en/japan-topics/g00631/a-guide-to-city-pop-the-soundtrack-for-japan%E2%80%99s-bubble-era-generation.html">City
                Pop</a>
            is a genre of music popular in Japan in the late 70s and 80s blending pop, jazz, and funk to
            create a pristine-sounding style of music meant to reflect the booming economic and technological prosperity
            taking place in Japan at the time.
            The genre saw a resurgence in popularity in the 2010s thanks to
            its popularity in the Vaporwave community and several songs which gained millions of views on YouTube thanks
            to frequently appearing in the "recommended" sections below other videos.
        </p>
        <p><a href="https://www.vice.com/en_au/article/mbzabv/city-pop-guide-history-interview" class="smallText">The
                Guide to Getting Into City Pop, Tokyo’s Lush 80s Nightlife Soundtrack</a></p>
        <blockquote> City Pop was the soundtrack to the dream like, optimistic state that Japan was relishing in.
            The swinging beats and soft jazzy soundscapes of City Pop set the tone for an interim that, although wasn’t
            to last, existed as a fantastical dream world for a time.
        </blockquote>
    </div>


    <!-- SEARCH BAR -->

    <span><br><br><br></span>
    <span><br><br><br></span>


    <!-- SPOTLIGHT -->
    <div id="spotlightBorder">
        <div id="spotlightTitle" class="shape-cigar"><h1 class="title"> SPOTLIGHT </h1></div>
        <div id="spotlightContainer">
        </div>
    </div>


    <span><br><br><br><br><br></span>
    <span><br><br><br><br><br></span>


    <!-- ADDING -->
    <div id="addDiv">
        <h1>Something missing?</h1>
        <div class="container row">
            <h3>Add: </h3>
            <select name="select" id="addSelect" class="minimalistInput" style="margin: 0 10px;" autocomplete="off"
                    onchange="
                    for(let i = 1; i < this.length; i++) document.getElementById('add'+$('#addSelect option').eq(i).val().capitalize()).style.display = 'none';
                    document.getElementById('add'+$('#addSelect :selected').val().capitalize()).style.display='flex'; ">
                <option value="" selected="selected" disabled hidden>Choose</option>
                <option value="artist">Artist</option>
                <option value="album">Album</option>
                <option value="song">Song</option>
            </select>
        </div>

        <div id="addArtist" class="addX pop" style="display:none">
            <h2>Add artist</h2>
            <form action="../0PHP/add.php" method="post">
                <input type="text" name="table" value="artist" hidden>
                <div class="container">
                    <p>First name:</p>
                    <input type="text" name="firstName" required> *
                </div>
                <div class="container">
                    <p>Last name:</p>
                    <input type="text" name="lastName" placeholder="">
                </div>
                <div class="container">
                    <p>Birth year:</p>
                    <input type="number" name="birthYear">
                </div>
                <div class="container">
                    <p>Birth City:</p>
                    <input type="text" name="birthCity">
                </div>
                <div class="container" style="flex-direction: column !important;">
                    <button type="submit" class="retroButton"><i class="material-icons">
                            <!--style="margin: 0; font-size: 25pt;"--> person_add</i></button>
                </div>
            </form>
        </div>

        <div id="addAlbum" class="addX pop" style="display:none">
            <h2>Add album</h2>
            <form action="../0PHP/addAlbum.php" method="post">
                <input type="text" name="table" value="album" hidden>
                <div class="container">
                    <p>Title:</p>
                    <input type="text" name="title" required> *
                </div>
                <div class="container">
                    <p>Artist:</p>
                    <input type="text" name="artistName" placeholder="" required> *
                </div>
                <div class="container">
                    <p>Genre:</p>
                    <input type="text" name="genre" pattern=".{2,}">
                </div>
                <div class="container">
                    <p>Year:</p>
                    <input type="number" name="releaseYear">
                </div>
                <div class="container">
                    <button type="submit" class="retroButton"><i class="material-icons">library_add</i></button>
                </div>
            </form>
        </div>

        <div id="addSong" class="addX pop" style="display:none">
            <h2>Add song</h2>
            <form action="../0PHP/addSong.php" method="post">
                <input type="text" name="table" value="song" hidden>
                <div class="container">
                    <p>Title:</p>
                    <input type="text" name="title" pattern=".{1,}"> *
                </div>
                <div class="container">
                    <p>Album:</p>
                    <input type="text" name="albumName" placeholder=""> *
                </div>
                <div class="container">
                    <button type="submit" class="retroButton"><i class="material-icons">library_add</i></button>
                </div>
            </form>
        </div>

    </div>



    <span><br><br><br><br><br><br><br></span>
    <span><br><br><br><br><br><br><br></span>


    <div id="testingDiv" class="secondaryVariant">

        <?php
        $sql = "SELECT * FROM artist ORDER BY birthYear";
        $artists = $kobling->query($sql);
        echo "<h3> The query \"$sql\" resulted in $artists->num_rows rows. </h3> <br>";

        echo '<table><tr><th>artist_id</th><th>firstName</th><th>lastName</th><th>birthYear</th></tr>';

        while ($row = $artists->fetch_assoc()) {
            $artist_id = $row['artist_id'];
            $artist_firstName = $row['firstName'];
            $artist_lastName = $row['lastName'];
            $artist_birthYear = $row['birthYear'];
            echo "<tr>";
            echo "<td>$artist_id</td>";
            echo "<td>$artist_firstName</td>";
            echo "<td>$artist_lastName</td>";
            echo "<td>$artist_birthYear</td>";
            echo "</tr>";
        }
        echo '</table>';
        ?>

        <form action="../0PHP/test.php" target="_blank" method="get">

            <input type="text" name="text">
            <button type="submit">submit</button>


        </form>


    </div>


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
