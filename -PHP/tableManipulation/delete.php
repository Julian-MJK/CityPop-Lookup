<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 12.05.2019
     * Time: 09:53 PM
     */

    require '../connection.php';
    require '../generic_functions.php';

    if (isset($_POST['table']) && isset($_POST['id'])) {
        $success = delete($_POST['table'], $_POST['id']);
        $msg = ($success ? $_POST['table'] . '=' . $_POST['id'] . ' successfully deleted' : 'ERROR: ' . $_POST['table'] . '=' . $_POST['id'] . ' not deleted');
    } else $msg = 'QUERY ERROR: Valid parameters not given, nothing deleted.';

    /*echo '<script> alert(' . $msg . ') </script>';

    echo "<script> location.replace('../../');  </script>";
    */

    passTo('../../home/', ['msg', 'msgClass', 'msgColor'], [$msg, 'anim_text-shadow-drop', 'green']);




