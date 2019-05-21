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
    $id = $_POST['id'];


    if (isset($table, $id)) {

        $success = delete($table, $id);

        $msg = ($success ? $table . '=' . $id . ' successfully deleted' : 'ERROR: ' . $table . '=' . $id . ' not deleted');

    } else $msg = 'QUERY ERROR: Valid parameters not given, nothing deleted.';



    passTo('../../home/', ['msg', 'msgClass', 'msgColor'], [$msg, 'anim_text-shadow-drop', 'green']);




