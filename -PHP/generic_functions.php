<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 18.05.2019
     * Time: 01:14 AM
     */


    function add($table, array $columns, array $values)
    {

    }

    function edit($table, $id, $column, $value)
    {
        $sql = 'UPDATE ' . $table . ' SET ' . $column . '=\'' . $value . '\' WHERE ' . $table . '_id=' . $id;
        echo '<br>sql= ' . $sql . '<br>';
        echo ($GLOBALS['conn']->query($sql) === TRUE) ? '<br> Record updated successfully' : '<br> Error: ' . $GLOBALS['conn']->error;

    }


    function addGenres($_album_id, array $genres)
    {
        echo 'Adding genres: <br>';
        foreach ($genres as $i => $genre) {
            echo 'Genre ' . $i . ': ' . $genre; //note - might be reversed for some reason
            $sql = 'INSERT INTO album_genre (album_id, genre) VALUES (' . $_album_id . ',' . $genre . ')';
            $GLOBALS['conn']->query($sql);
        }
    }

    function passTo($url, array $postNames, array $postValues)
    {
        echo "<form action='" . $url . "' method='post' style='margin: auto'>";

        foreach ($postNames as $i => $postName) {
            echo "<input type='text' hidden name='" . $postName . "' value='" . addslashes($postValues[$i]) . "'>";
        }

        echo "<button type='submit'>If you're not automatically redirected, click here</button>
            <script> document.querySelector('form').querySelector('button').click() </script>
        </form>";
    }

?>
