<?php
/**
 * Created by IntelliJ IDEA.
 * User: ジュリアン
 * Date: 12.05.2019
 * Time: 09:53 PM
 */

require "connection.php";

if(isset($_POST['table']) && isset($_POST['id'])) {

    $table = $_POST['table'];
    $table_id = $table . '_id';
    $id = $_POST['id'];

    $sql = "SELECT * FROM $table WHERE $table_id=$id";
    $query = $kobling->query($sql);
    $row = $query->fetch_assoc();

    echo $row['artist_id'];

    $delSql = "DELETE FROM $table WHERE $table_id=$id";


    if (!$kobling->query($delSql)) {
            echo "<script> alert('ERROR: $table_id=$id not deleted') </script>";
    } else  echo "<script> alert('$table_id=$id successfully deleted') </script>";
}     else  echo "<script> alert('QUERY ERROR: Valid parameters not given, nothing deleted.') </script>";


echo "<script> location.replace('../');  </script>";





