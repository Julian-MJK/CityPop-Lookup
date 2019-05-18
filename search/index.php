<?php require '../-PHP/connection.php'; ?>

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
    <script src="../-JS/jquery-3.4.0.js"></script>

    <script src="../-JS/oddUtilities.js"></script>
    <link href="../-CSS/classes.css" rel="stylesheet">
    <link href="../-CSS/universal.css" rel="stylesheet">
    <link href="../-CSS/universal_theme.css" rel="stylesheet">

    <link rel="stylesheet" href="../-CSS/universal_menu.css">
    <script src="../-JS/universal_menu.js"></script>

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

    <?php include "searchbar.php"; ?>

    <span><br><br></span>

    <div id="searchResultsContainer" class="secondaryVariant">
        <?php include "search.php" ?>
    </div>

    <span><br><br><br></span>

    <!-- all artists -->
    <?php include '../-PHP/UI_allArtists.html' ?>

    <span><br><br><br></span>

    <!-- adding -->
    <?php include '../-PHP/UI_add.html' ?>

    <span><br><br><br><br><br><br><br><br><br><br><br></span>

    <!-- footer -->
    <?php include '../-PHP/UI_footer.html' ?>

</div> <!-- end of document wrapper -->
<script>




</script>
</body>
</html>
