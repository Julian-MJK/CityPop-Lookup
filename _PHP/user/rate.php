<?php
    /**
     * Created by IntelliJ IDEA.
     * User: ジュリアン
     * Date: 19.05.2019
     * Time: 08:52 PM
     */


    /*
     *
     * As i wish for the user to be able to rate albums in a visually pleasing way, the rating-input is handled through javascript.
     * Alternatively, I could have used radios as the stars, in the 5-star-rating-bar, and put that in a form, but that would not have been as easily customizable and adaptive.
     *
     */

    // note: i would have used target="_BLANK" to not force the user's browser to refresh the page,
    //  however, chrome is very strict on javascript closing the browser window. (Not possible through PHP as it's server side, not client side.)
    //   The best way to do it would of course be to use some other scripting language with SQL.

    require_once '../connection.php';
    require_once '../generic_functions.php';

    $subject = $_POST['subject'];
    $subject_id = $_POST['subject_id'];
    $rating = $_POST['rating'];
    $user_id = $_SESSION['user_id'];

    if (isset($subject) && isset($subject_id) && isset($rating)) {

        // DOES RATING ALREADY EXIST?
        if ($conn->query('SELECT user_id FROM userRating_' . $subject)->fetch_assoc()) {
            // DELETES EXISTING RATING
            $deletion = deleteComposite('userRating_' . $subject, $subject . '_id', 'user_id', $subject_id, $user_id);
            if ($_SESSION['debugMode']) echo $deletion ? 'Deleted existing rating' : 'Something went wrong, ' . $conn->error;
        }

        // INSERTING THE RATING
        $sql = 'INSERT INTO userRating_' . $subject . ' (user_id, ' . $subject . '_id, rating) VALUES (' . $user_id . ', ' . $subject_id . ', ' . $rating . ')';
        $success = $conn->query($sql);
        if ($success) {
            if ($_SESSION['debugMode']) echo 'Successfully rated ' . $subject . '_id ' . $subject_id . ' ' . $rating . '/5 for user ' . $_SESSION['username'];
        } else $error = 'Error: ' . $conn->error;

    } else $error = 'Error, could not rate artist, correct parameters not defined.';


    // REDIRECTING USER
    if (isset($error)) {

        passTo('../../' . $subject . '/?a=' . $subject_id, ['msg', 'msgBGColor'], [escape($error), 'var(--red)']);

    } else {

        $location = '../../' . $subject . '/?a=' . $subject_id;
        header('Location: ' . $location);

    }

