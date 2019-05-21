<div class="container" id="actionButtonsContainer">

    <!-- delete -->
    <div class="error" id="deleteSubjectDiv">
        <form action="../_PHP/tableManipulation/delete.php" method="post">
            <button type="button" class="container"
                    onclick="if(confirm('Are you sure you want to delete <?php echo ($subject === 'artist') ? $firstName . ' ' . $lastName : ($subject === 'album' ? $title : $subject) ?>?')) $('#delSubject_submitBtn').click()" id="deleteSubjectButton">
                <h2>Delete <?php echo $subject ?>?</h2>
            </button>
            <button type="submit" hidden id="delSubject_submitBtn"></button>
            <input type="text" name="id" hidden value="<?php echo $subject_id ?>">
            <input type="text" name="table" hidden value="<?php echo $subject ?>">
        </form>
    </div>

    <!-- edit -->
    <div class="" id="editSubjectDiv">
        <button onclick="window.initiateEditMode()" id="editSubjectButton" class="container">
            <h2>Edit <?php echo $subject ?>?</h2>
        </button>
    </div>

</div>

<!-- HIDDEN EDIT FORM -->
<form hidden action="../_PHP/tableManipulation/edit.php" method="post" style="display: none">
    <!-- not using target="_blank" as different browsers handle javascript that closes the page, very differently. Preferably I'd use another library language to handle sql without page reloads. -->
    <input hidden type="text" name="table" value="<?php echo $subject ?>">
    <input hidden type="text" name="<?php echo $subject ?>_id" value="<?php echo $subject_id ?>">
    <input hidden type="text" name="title" id="editForm_title">
    <input hidden type="text" name="name" id="editForm_name">
    <input hidden type="text" name="bio" id="editForm_bio">
    <input hidden type="text" name="info" id="editForm_info">
    <input hidden type="text" name="imgURL" id="editForm_imageURL" <?php if (isset($imgURL)) echo 'value="' . $imgURL . '"' ?> >
    <button hidden type="submit" id="editForm_submitBtn"></button>
</form>