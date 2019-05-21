<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 18.05.2019
     * Time: 01:14 AM
     */


    /**
     * @function
     * @desc Returns bool TRUE if if $needle is a substring of $haystack (case-insensitive).
     * @param $needle
     * @param $haystack
     * @return bool
     */
    function contains($needle, $haystack)
    {
        return stripos($haystack, $needle) !== false;
    }


    /**
     * @param $table
     * @param array $columns
     * @param array $values
     */
    function add($table, array $columns, array $values)
    {

    }


    /**
     * @function
     * @desc - Updates $column of $table.'_id' to $value.
     * @param $table
     * @param $id
     * @param $column
     * @param $value
     * @return bool - returns true if query was successful, false if not.
     */
    function edit($table, $id, $column, $value)
    {
        if (empty($value)) return true; // stops the function and returns true if given value is empty (which would be unintended)

        $sql = 'UPDATE ' . $table . ' SET ' . $column . '="' . $value . '" WHERE ' . $table . '_id=' . $id;
        if ($_SESSION['debugMode']) echo '<br>( - - - S Q L - - - ) ' . $sql . '<br>';
        echo $GLOBALS['conn']->query($sql) ? '<br>' . $table . ' record updated successfully' : '<br> Error: ' . $GLOBALS['conn']->error;
        return $GLOBALS['conn']->query($sql) ? true : false;
    }


    /**
     * @param $table
     * @param $id
     * @return bool
     */
    function delete($table, $id)
    {
        $table_id = $table . '_id';
        $delSql = "DELETE FROM $table WHERE $table_id=$id";
        return $GLOBALS['conn']->query($delSql) ? true : false;
    }

    /**
     * @param $table
     * @param $id1Prefix
     * @param $id2Prefix
     * @param $id1
     * @param $id2
     * @return bool
     */
    function deleteComposite($table, $id1Prefix, $id2Prefix, $id1, $id2)
    {
        $delSql = "DELETE FROM $table WHERE $id1Prefix=$id1 AND $id2Prefix = $id2";
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
            echo "<input type='text' hidden name='" . $postName . "' value='" . escape($postValues[$i]) . "'>";
        }
        echo "<button type='submit'>If you're not automatically redirected,<noscript> then your browser doesn't support JavaScript, </noscript> click here.</button>
            <script> document.querySelector('form').querySelector('button').click() </script>
        </form>";
    }


    /**
     * @param $_album_id
     * @param array $genres
     */
    function addGenres($_album_id, array $genres)
    {
        if ($_SESSION['debugMode']) echo 'Adding genres (album_id=' . $_album_id . '): <br>';

        // LOOPS THROUGH THE GIVEN ARRAY OF GENRES
        foreach ($genres as $i => $genre) {

            if ($GLOBALS['conn']->query('SELECT genre FROM album_genre WHERE genre="' . $genre . '" AND album_id="' . $_album_id . '"')->fetch_assoc()) {

                // IGNORES REQUEST IF ALBUM ALREADY HAS GENRE
                if ($_SESSION['debugMode']) echo 'Album with id ' . $_album_id . ' already has genre ' . $genre . ', ignoring it. <br>';

            } else {

                // ADDS GENRE IF IT DOESN'T EXIST
                if (!$GLOBALS['conn']->query('SELECT * FROM genre WHERE name="' . $genre . '"')->fetch_assoc()) {
                    $GLOBALS['conn']->query('INSERT INTO genre (name) VALUES ("'.$genre.'")');
                }

                // INSERTING THE REQUESTED GENRE
                $sql = 'INSERT INTO album_genre (album_id, genre) VALUES ("' . $_album_id . '","' . $genre . '")';
                $query = $GLOBALS['conn']->query($sql);
                if ($_SESSION['debugMode']) echo $query ? 'Genre[' . $i . ']=' . $genre . '<br>' : '<br> Couldn\'t add genre [' . $i . '] ' . $genre . ', error:' . $GLOBALS['conn']->error;

            }
        }
    }


    /**
     * @function
     * @desc Does what escape() is supposed to do, but without totally messing up the string.
     * @param $string
     * @return mixed
     */
    function escape($string)
    {
        return str_replace(array("'", '"'), array("\'", '\"'), $string);
    }


?>
