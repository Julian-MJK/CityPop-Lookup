<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 12.05.2019
     * Time: 09:53 PM
     */

    require '../connection.php';
    require '../generic_functions.php';

    $table = $_POST['table'];

    if (isset($_POST['composite'], $table)) {

        $key1Name = $_POST['key1Name'];
        $key2Name = $_POST['key2Name'];
        $key1 = $_POST['key1'];
        $key2 = $_POST['key2'];

        $success = deleteComposite($table, $key1Name, $key2Name, $key1, $key2);

        $msg = ($success ? "$table $key2 successfully deleted" : "ERROR: $table $key2 not deleted: $conn->error");

    } else {

        $id = $_POST['id'];
        if(!isset($id)) $id = $_POST[$table.'_id'];

        if (isset($table, $id)) {

            $success = delete($table, $id);

            $msg = ($success ? "$table $id successfully deleted" : "ERROR: $table $id  not deleted");

        } else $msg = 'QUERY ERROR: Valid parameters not given, nothing deleted.';

    }


    // redirecting the user
    if (isset($_POST['url'])) {

        // if a scroll-to point is defined
        if (isset($_POST['scrollTo'])) {

            // if the page requests the result message be brought over.
            if (isset($_POST['carryMsg'])) {

                passTo($_POST['url'], ['scrollTo', 'msg'], [$_POST['scrollTo'], $msg]);

            } else passTo($_POST['url'], ['scrollTo'], [$_POST['scrollTo']]);

        } else header('Location: ' . $_POST['url']);

    } else passTo('../../home/', ['msg', 'msgClass', 'msgColor'], [$msg, 'anim_text-shadow-drop', 'green']);




