<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 18.05.2019
     * Time: 01:14 AM
     */


    /**
     * @param $table
     * @param array $columns
     * @param array $values
     */
    function add($table, array $columns, array $values)
    {

    }



    /**
     * @param $table
     * @param $id
     * @param $column
     * @param $value
     */
    function edit($table, $id, $column, $value)
    {
        $sql = 'UPDATE ' . $table . ' SET ' . $column . '=\'' . $value . '\' WHERE ' . $table . '_id=' . $id;
        echo '<br>sql= ' . $sql . '<br>';
        echo ($GLOBALS['conn']->query($sql) === TRUE) ? '<br> Record updated successfully' : '<br> Error: ' . $GLOBALS['conn']->error;
    }



    function delete($table, $id)
    {
            $table_id = $table . '_id';

            $delSql = "DELETE FROM $table WHERE $table_id=$id";

            return $GLOBALS['conn']->query($delSql) ? true : false;
    }



    /**
     * @param $url
     * @param array $postNames
     * @param array $postValues
     */
    function passTo($url, array $postNames, array $postValues)
    {
        echo "<form action='" . $url . "' method='post' style='margin: auto'>";
        foreach ($postNames as $i => $postName) {
            echo "<input type='text' hidden name='" . $postName . "' value='" . addslashes($postValues[$i]) . "'>";
        }
        echo "<button type='submit'>If you're not automatically redirected,<noscript> then your browser doesn't support JavaScript, </noscript> click here.</button>
            <script> document.querySelector('form').querySelector('button').click() </script>
        </form>";
    }


    /**
     * @param $_album_id
     * @param array $genres
     * @param bool $doesEcho
     */
    function addGenres($_album_id, array $genres, $doesEcho=true)
    {
        echo 'Adding genres (album_id=' . $_album_id . '): <br>';
        foreach ($genres as $i => $genre) {
            // checks if table has a row with same album and genre as requested in the parameters.
            if ($GLOBALS['conn']->query('SELECT genre FROM album_genre WHERE genre="' . $genre . '" AND album_id="' . $_album_id . '"')->fetch_assoc()) {
                if($doesEcho) echo 'Album with id ' . $_album_id . ' already has genre ' . $genre . ', ignoring it. <br>';
            } else {
                $sql = 'INSERT INTO album_genre (album_id, genre) VALUES ("' . $_album_id . '","' . $genre . '")';
                $query = $GLOBALS['conn']->query($sql);
                if($doesEcho) echo $query ? 'Genre[' . $i . ']=' . $genre . '<br>' : '<br> Couldn\'t add genre [' . $i . '] ' . $genre . ', error:' . $GLOBALS['conn']->error;
            }
        }
    }

/*
    function rate($what, $target_id, $rating)
    {
        //checks if rating already exists, if so, deletes it;
        if (isset($conn->query('SELECT user_id FROM userRating' . $what)->fetch_assoc())) {

        }
        $sql = 'INSERT INTO userRating_' . $what . ' ';
    }
*/

?>
