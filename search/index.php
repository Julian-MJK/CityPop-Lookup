<?php require '../_PHP/connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Results | City Pop Lookup </title>
    <link rel="icon" href="../resources/img/textures/vinyl32.ico">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <!--|Montserrat|Open+Sans|Raleway|Roboto-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
    <script src="../_JS/jquery-3.4.0.js"></script>

    <script src="../_JS/oddUtilities.js"></script>
    <link href="../_CSS/classes.css" rel="stylesheet">
    <link href="../_CSS/universal_generic.css" rel="stylesheet">
    <link href="../_CSS/universal_theme.css" rel="stylesheet">

    <link rel="stylesheet" href="../_CSS/universal_menu.css">
    <script src="../_JS/universal_menu.js"></script>

    <link href="stylesheet.css" rel="stylesheet">


</head>
<body>

<!-- header -->
<?php include '../_HTML/UI_header.html' ?>

<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 125px">

    <!-- overlapping header (the header box uses clip-path, which also cuts child elements, therefore this is outside of the main header container.) -->
    <?php include '../_HTML/UI_onHeader.html' ?>

    <span><br></span>

    <?php include "../_HTML/UI_searchbar.html"; ?>

    <span><br><br></span>

    <div id="searchResultsContainer" class="secondaryVariant">
        <?php include "search.php" ?>
    </div>

    <span><br><br><br></span>

    <!-- all artists -->
    <?php include '../_HTML/UI_allArtists.php' ?>

    <span><br><br><br></span>

    <!-- adding -->
    <?php include '../_HTML/UI_add.html' ?>

    <span><br><br><br><br><br><br><br><br><br><br><br></span>

    <!-- footer -->
    <?php include '../_HTML/UI_footer.html' ?>

</div> <!-- end of document wrapper -->
<script>




</script>
</body>
</html>
