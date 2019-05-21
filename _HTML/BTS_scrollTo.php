<?php
    if (isset($_POST['scrollTo'])) {
        $scrollTo = $_POST['scrollTo'];
        echo "<script> document.getElementById(\"$scrollTo\").scrollIntoView({block: 'center'}); </script>";
    }
?>