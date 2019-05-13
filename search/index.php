
<?php require '../0PHP/connection.php';  ?>

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
    <div class="titleDiv shape-bat-top blackText div" style="border-radius: 0; min-height: 50px; top: 10px;" onclick="window.location.href='../home'"><h1>City  Pop Archives</h1></div>
    <!-- END OF HEADER ELEMENTS -->



    <span><br></span>


    <?php include "searchbar.php"; ?>


    <span><br><br></span>



    <div id="searchResultsContainer" class="secondaryVariant">
        <?php include "search.php" ?>
    </div>


    <span><br><br><br><br></span>




    <div id="allArtists" class="primary">
        <h1 style="margin: 15px;""> ALL ARTISTS </h1>

        <?php
        $artists = $kobling->query("SELECT * FROM artist ORDER BY firstName");
        while ($row = $artists->fetch_assoc()) {
            $artist_id = $row['artist_id'];
            $artist_firstName = $row['firstName'];
            $artist_lastName = $row['lastName'];
            echo    "<h3 style='width: 100%; text-align: left; margin-left: 7%;'> " .
                "<a href='../artist?artist=$artist_id'> $artist_firstName $artist_lastName </a> </h3>";
        }
        ?>
    </div>



    <span><br><br></span>



    <!-- ADDING -->
    <?php include "../0PHP/adding.php" ?>



    <span><br><br><br><br><br><br><br></span>




    <!-- footer -->
    <div id="footer">
        <div class="lowBound"> <p></p> <p></p> </div>
        <div class="column square secondaryVariant">

            <p contenteditable="true"> This is a footer! Isn't it neat? </p>
            <p style="font-family: 'MS PMincho',serif; font-size: 18pt;"> ロイヤルーカジノ</p>

        </div>
        <div class="lowBound"> <p></p> <p></p> </div>
    </div>

</div> <!-- end of document wrapper -->
<script>




</script>
</body>
</html>
