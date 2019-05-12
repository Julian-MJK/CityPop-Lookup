<!--<QUESTIONMARKphp
session_start(); /*Starte en session for å hente verdiene lagret*/

require_once "../0PHP/connection.php"; /*Hente konfigurasjonsbitene*/

$id = $_SESSION["id"];
$sql = "SELECT * FROM users WHERE id=$id";
$query = mysqli_query($link, $sql);
$value = mysqli_fetch_object($query);
$theme = $value->theme;
?>-->

<?php
include '../0PHP/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> City Pop Lookup | Home </title>
    <link rel="icon" href="https://i.imgur.com/KIEjXV8.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <!--|Montserrat|Open+Sans|Raleway|Roboto-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
    <script src="../0JS/jquery-3.4.0.js"></script>

    <script src="../0JS/oddUtilities.js"></script>
    <link href="../0CSS/classes.css" rel="stylesheet">
    <link href="../0CSS/universal.css" rel="stylesheet">

    <!--<link rel="stylesheet" href="../0CSS/universal_menu.css">
    <script src="../0JS/universal_menu.js">rmh_href = "../0PHP/login.php";</script>-->

    <link href="index.css" rel="stylesheet">
    <script src="index_boxes.js"></script>
    <script src="index-scrolling-and-toolbar.js"></script>

    <link href="top10.css" rel="stylesheet">


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

            <img src="https://i.imgur.com/KIEjXV8.png" alt="token" id="tokenCountToken">
            <p id="tokenCount">x 2500</p>

        </div>
        <!--<button onclick="window.location.href='../games/snake/index.php'/*redirect to money-buying-place*/" class="retroButton"
                style="background-color: purple; color: yellow; margin-bottom: 4px;">GET
        </button>-->
    </div>
</div>
<div id="toolbarRight" class="toolbar">
    <div id="profileSettings" class="toolbarItem"><p>SEARCH</p></div>
    <div id="logoutButton"><p></p></div>
</div>
<!-- END OF TOOLBAR -->




<!-- DOCUMENT WRAPPER -->
<div id="documentWrapper" class="container column" style="margin-top: 325px">


    <!-- HEADER ELEMENTS -->
    <img id="headerSymbol" src="../resources/img/textures/vinyl250.png" draggable="false">

    <div id="toolbarTooltip" class="speech-bubble" style="display: none"><p>Click me to open the toolbar.</p></div>
    <script> $(function () {
            if (get("firstTime")) {
                $("#toolbarTooltip").fadeIn();
                $("#headerSymbol")[0].addEventListener("click", function () {
                    $("#toolbarTooltip").hide();
                });
            }
        }); </script>

    <div class="titleDiv shape-bat blackText div" style="border-radius: 0; min-height: 50px; top: 10px;">
        <h1>City Pop Archives</h1>
    </div>
    <!-- END OF HEADER ELEMENTS -->


    <!--
    ======= MAIN ELEMENTS =======
	======= MAIN ELEMENTS =======
	======= MAIN ELEMENTS =======
    -->

    <!-- SEARCHBAR -->
    <div id="searchBar" class="row">
        <input type="text" style="flex-grow: 1" class="" onkeyup="if(event.key==='Enter') console.log();" placeholder="Search for artists, songs, cities or albums.">
        <button class="fancyButtonSecondary"> SEARCH </button>
    </div>

    <!-- SPOTLIGHT ARTISTS -->
    <div id="spotlightBorder">
        <div class="shape-cigar">
            <h1 class="title">SPOTLIGHT</h1>
        </div>
        <div id="spotlightContainer">

        </div>
    </div>




    <span><br><br><br><br><br><br><br><br></span>
    <!-- footer -->
    <div id="footer">

        <div class="lowBound">
            <p></p>
            <p></p>
        </div>

        <div class="column square secondaryVariant">
            <p contenteditable="true"> This is a footer! Isn't it neat? </p>
            <p style="font-family: 'MS PMincho',serif; font-size: 18pt;"> ロイヤルーカジノ</p>
        </div>

        <div class="lowBound">
            <p></p>
            <p></p>
        </div>

    </div>

</div> <!-- end of document wrapper -->
<script>




    // todo - expand on, and change to make it look better, :
    let theme = "<?php echo $theme; ?>";
    if (theme === "Dark") {
        let root = $(':root')[0];
        root.css('--primary', 'black');
        root.css('--primaryVariant', 'black');
        root.css('--secondary', 'blue');
        root.css('--secondaryVariant', 'blue');
        root.css('--background', 'black');
        root.css('--background', 'black');
    }




</script>
</body>
</html>
