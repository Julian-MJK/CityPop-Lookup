<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 18.05.2019
     * Time: 01:14 AM
     */


    /**
     * @function
     * @desc Does what addslashes() is supposed to do, but without totally messing up the string.
     * @param $string
     * @return mixed
     */
    function escape($string)
    {
        return str_replace(array("'", '"'), array("\'", '\"'), $string);
    }

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




    function addCell($table, $fieldName, $fieldValue)
    {
        $sql = "INSERT INTO $table ($fieldName) VALUES ($fieldValue)";
        $query = $GLOBALS['conn']->query($sql);
        if ($_SESSION['debugMode']) echo $query ? "<br> addRow: $table record added successfully." : '<br> ERROR - addRow: ' . $GLOBALS['conn']->error;
    }

    function addRow($table, array $fieldNames, array $fieldValues)
    {
        $_fieldStrings = singleQueryString_add($fieldNames, $fieldValues);
        $sql = "INSERT INTO $table ($_fieldStrings[0]) VALUES ($_fieldStrings[1])";
        $query = $GLOBALS['conn']->query($sql);
        if ($_SESSION['debugMode']) echo $query ? "<br> addRow: $table record added successfully." : '<br> ERROR - addRow: ' . $GLOBALS['conn']->error;
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
        if (empty($value)) return true; // stops the function and returns true if given value is empty (which would be unintended,
        // and not something the function-user would want to be halted for.)

        $sql = 'UPDATE ' . $table . ' SET ' . $column . '="' . $value . '" WHERE ' . $table . '_id=' . $id;

        //if ($_SESSION['debugMode']) echo '<br>( - - - S Q L - - - ) ' . $sql . '<br>';

        $query = $GLOBALS['conn']->query($sql);
        if ($_SESSION['debugMode']) echo $query ? "<br> $table record updated successfully." : '<br> Error: ' . $GLOBALS['conn']->error;

        return $GLOBALS['conn']->query($sql) ? true : false;
    }


    /**
     * @function
     * @desc Deletes an entry in given table with given Primary Key value, assuming the Primary Key fieldName is $tableName.'_id'.
     * @param $table
     * @param $id
     * @return bool
     */
    function delete($table, $id)
    {
        $table_id = $table . '_id';
        $sql = "DELETE FROM $table WHERE $table_id=$id";
        return $GLOBALS['conn']->query($sql) ? true : false;
    }

    // synonym
    //function deleteRow($table, $id) { delete($table, $id); };

    /**
     * @function
     * @desc Deletes row from $table where $fieldName = $fieldValue
     * @param $table
     * @param $fieldName
     * @param $fieldValue
     * @return bool
     */
    function deleteRow($table, $fieldName, $fieldValue){
        $sql = "DELETE FROM $table WHERE $fieldName=$fieldValue";
        return $GLOBALS['conn']->query($sql) ? true : false;
    }




    /**
     * @function
     * @desc Deletes a composite key consisting of two keys.
     * @param $table
     * @param $id1FieldName
     * @param $id2FieldName
     * @param $id1
     * @param $id2
     * @return bool
     */
    function deleteComposite($table, $id1FieldName, $id2FieldName, $id1, $id2)
    {
        $delSql = "DELETE FROM $table WHERE $id1FieldName=$id1 AND $id2FieldName=$id2";
        return $GLOBALS['conn']->query($delSql) ? true : false;

        // can be expanded to accept an array of keys and keyNames, and thus be scalable, but this will do for now.
    }


    /**
     * @function
     * @desc Redirects the user to given $url, while sending given values as _POST variables, to be fetched by the receiving-page.
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
            <script> " . ($_SESSION['debugMode'] ? '//': ''). "setTimeout(function(){document.querySelector('form').querySelector('button').click()}, 50); </script>
        </form> <br> <br> <a href='../home/'> If for some reason that didn't work, the developer probably made a silly mistake, click here. </a>";
    }

    // Note that normally, using _POST would prompt the user to re-submit the form on page-refresh, but I've included this piece of script:
    //    if (window.history.replaceState) {
    //        window.history.replaceState(null, null, window.location.href);
    //    }
    // In the footer, which prevents just that. If it weren't for that piece of script, I would be more careful with using passTo, or I'd use some other method, like cookies.




    /**
     * @function
     * @desc Adds $genres to given $_album_id. If specified genre doesn't exist, it's created and then inserted, and if given album already has specified genre, it's ignored.
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

                // CREATES GENRE IF IT DOESN'T EXIST
                if (!$GLOBALS['conn']->query('SELECT * FROM genre WHERE name="' . $genre . '"')->fetch_assoc()) {
                    $GLOBALS['conn']->query('INSERT INTO genre (name) VALUES ("' . $genre . '")');
                }

                // INSERTING THE REQUESTED GENRE
                $sql = 'INSERT INTO album_genre (album_id, genre) VALUES ("' . $_album_id . '","' . $genre . '")';
                $query = $GLOBALS['conn']->query($sql);
                if ($_SESSION['debugMode']) echo $query ? 'Genre[' . $i . ']=' . $genre . '<br>' : '<br> Couldn\'t add genre [' . $i . '] ' . $genre . ', error:' . $GLOBALS['conn']->error;

            }
        }
    }

    /**
     * @param $table
     * @param array $fieldNames
     * @param array $fieldValues
     * @return bool
     */
    function addComposite($table, array $fieldNames, array $fieldValues)
    {
        $count = count($fieldNames);

        if ($count !== count($fieldValues)) {
            echo 'ERROR - addComposite: fieldNames and fieldValues differ in length (table=' . $table . ', first fieldName=' . $fieldNames[0] . ', first fieldValue=' . $fieldValues . ').';
            return false;
        }

        for ($i = 0; $i < $count; $i++)

            if ($GLOBALS['conn']->query("SELECT $fieldNames[$i] FROM $table WHERE $fieldNames[$i]='$fieldValues[$i]'")->fetch_assoc()) {

                if ($_SESSION['debugMode']) echo "addComposite: Duplicate entry $fieldNames[$i]='$fieldValues[$i]', ignoring it. <br>';";

            } else {

                if (!$GLOBALS['conn']->query("SELECT * FROM $table WHERE $fieldNames[$i]=$fieldValues[$i]")->fetch_assoc()) {
                    $GLOBALS['conn']->query('INSERT INTO $table (name) VALUES ("' . $genre . '")');
                }

                $sql = 'INSERT INTO album_genre (album_id, genre) VALUES ("' . $_album_id . '","' . $genre . '")';
                $query = $GLOBALS['conn']->query($sql);
                if ($_SESSION['debugMode']) echo $query ? 'Genre[' . $i . ']=' . $genre . '<br>' : '<br> Couldn\'t add genre [' . $i . '] ' . $genre . ', error:' . $GLOBALS['conn']->error;

                return true;

            }
    }

    /**
     * @function
     * @desc Gathers given fieldNames and fieldValues into two separate strings, where each array value is separated with a comma.
     * Use as "INSERT INTO $table ($fieldNamesString) VALUES ($fieldValuesString)"
     * @param array $fieldNames
     * @param array $fieldValues
     * @return array|bool - false if aborted, array with [fieldNamesString, fieldValuesString] if success.
     */
    function singleQueryString_add(array $fieldNames, array $fieldValues)
    {
        $count = count($fieldNames);
        if ($count !== count($fieldValues)) {
            echo 'ERROR - singleQuery_add: fieldNames and fieldValues differ in length. Aborting.';
            return false;
        }
        $fieldNamesString = $fieldNames[0];
        $fieldValuesString = "'" . $fieldValues[0] . "'";
        for ($i = 1; $i < $count; $i++) {
            $fieldNamesString .= ', ' . $fieldNames[$i];
            $fieldValuesString .= ", '" . $fieldValues[$i] . "'";
        }
        return [$fieldNamesString, $fieldValuesString];
    }




?>
