<?php
    require '../_PHP/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> City Pop Lookup </title>



    <?php include '../_HTML/BTS_universalHeaderLinks.html' ?>



    <link href="stylesheet.css" rel="stylesheet">
    <script src="index_boxes.js"></script>
    <script src="index-scrolling-and-toolbar.js"></script>


</head>
<body>



<!-- HEADER -->
<?php include '../_HTML/UI_header.html' ?>



<!-- TOOLBAR -->
<div id="toolbarLeft" class="toolbar">
    <div class="toolbarItem">
        <div class="container row" id="tokenCountDiv">
            <p>Songs</p>
            <img src="../resources/img/textures/vinyl32.ico" alt="token" id="tokenCountToken">
            <p id="songsCount">x <?php echo $conn->query("SELECT * FROM song")->num_rows ?> </p>
        </div>
    </div>
</div>
<div id="toolbarRight" class="toolbar">
    <div id="profileSettings" class="toolbarItem" onclick="window.location.href='../user/'">
        <p>My ratings</p>
        <img src="http://cdn.onlinewebfonts.com/svg/img_453152.png" style="border-radius: 0;">
    </div>
    <div id="logoutButton"><p>logout</p></div>
</div>
<!-- END OF TOOLBAR -->



<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 300px/*325*/">



    <!-- overlapping header (the header box uses clip-path, which also cuts child elements, therefore this is outside of the main header container.) -->
    <img id="headerSymbol" src="../resources/img/textures/vinyl250.png" draggable="false">
    <div style="border-radius: 0; min-height: 50px; top: 10px;" class="titleDiv shape-diamond blackText div cursor_normal">
        <h1>City Pop Lookup</h1></div>


    <!-- Min metode for page-spacing er vanligvis å bruke disse <span> tags'ene med <br> tags i,
    da det tillater meg å lettere og raskere forandre på spacingen og se hvordan jeg liker den.
    Samt. vil jeg kunne variere spacingen på forskjellige sider, som ville vært upraktisk med /_HTML/ modulene. -->
    <span><br></span>


    <!-- SEARCH BAR -->
    <?php include '../_HTML/UI_searchbar.html'; ?>


    <span><br></span>


    <!-- OPTIONAL MESSAGE BAR -->
    <?php include '../_HTML/UI_msg.php' ?>



    <!-- INFO BOX -->
    <div id="textBox" style="min-width: 550px; max-width: 33vw; font-size: 14pt;" class="frame leanUpRightPerma leanNormal secondaryVariant hoverFillPrimary">
        <h1 class="title">City Pop</h1>
        <p style="margin: 15px">
            <a href="https://www.nippon.com/en/japan-topics/g00631/a-guide-to-city-pop-the-soundtrack-for-japan%E2%80%99s-bubble-era-generation.html">
                City Pop </a>
            is a genre of music popular in Japan in the late 70s and 80s blending pop, jazz, and funk to
            create a pristine-sounding style of music meant to reflect the booming economic and technological prosperity
            taking place in Japan at the time.
            The genre saw a resurgence in popularity in the 2010s thanks to
            its popularity in the Vaporwave community and several songs which gained millions of views on YouTube thanks
            to frequently appearing in the "recommended" sections below other videos.
        </p>
        <blockquote> City Pop was the soundtrack to the dream like, optimistic state that
            Japan was relishing in. The swinging beats and soft jazzy soundscapes of City Pop set the tone for an
            interim that, although wasn’t
            to last, existed as a fantastical dream world for a time.
        </blockquote>
        <p id="cityPopLink1">
            <a href="https://youtu.be/6fJKlCUyhOs" class="smallText">
                80's Japanese City pop/funk Mix</a></p>
        <p id="cityPopLink2">
            <a href="https://www.vice.com/en_au/article/mbzabv/city-pop-guide-history-interview" class="smallText">
                The Guide to Getting Into City Pop, <br> Tokyo’s Lush 80s Nightlife Soundtrack</a></p>
    </div>







    <span><br><br><br></span>
    <!-- SPOTLIGHT -->
    <div id="spotlightBorder">
        <div id="spotlightTitle" class="shape-cigar"><h1 class="title"> SPOTLIGHT </h1></div>
        <div id="spotlightContainer"></div>
    </div>





    <span><br><br><br><br><br></span>


    <!-- ALL ARTISTS -->
    <?php include '../_HTML/UI_allArtists.php' ?>


    <span><br><br><br><br></span>


    <!-- ADDING -->
    <?php include '../_HTML/UI_add.html' ?>



    <span><br><br><br><br><br><br></span>
    <span><br><br><br><br><br><br></span>



    <?php include '../_HTML/UI_footer.html'; ?>



</div> <!-- end of document wrapper -->
<script>

</script>
</body>
</html>
