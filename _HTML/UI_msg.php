<?php

    if (isset($_POST['msg'])) {

        echo '
        <div id="UI_msg" class="secondary pop" style="margin: 0.75em 0 0.75em 0; ' . (isset($_POST['msgBGColor']) ? 'background-color: ' . $_POST['msgBGColor'] . ';' : '') . '">
            <h2 style="' . (isset($_POST['msgColor']) ? 'color: ' . $_POST['msgColor'] . ' !important;' : '') . ' max-width: 40vw; word-break: break-word;" ' . (isset($_POST['msgClass']) ? 'class="' . $_POST['msgClass'] . '" ' : '') . '>' . $_POST['msg'] . '</h2>
        </div>
        ';
    }

?>

