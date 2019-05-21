<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 14.05.2019
     * Time: 11:44 PM
     */


    require_once '../connection.php';

    require 'getUserInputs.php';

    $id = $_POST[$table . '_id'];

    foreach ($input_fieldNames as $i => $column) {
        $result[] = edit($table, $id, $column, $input_data[$i]);
    }

    // informs the user if something failed to edit.
    if (isset($result)) if (in_array(false, $result, true)) passTo("../../$table/?a=$id", ['msg'], ['Failed to edit one or more values in ' . $table]);


    passTo("../../$table/?a=$id", ['scrollTo'], ['ratingDiv']);


    //header("Location: ../../$table/?a=$id");


