<script>

    // prevents chrome adding a new <div> element on "enter" keypress in contenteditable=true.
    document.execCommand('defaultParagraphSeparator', false, 'p');

    window.onresize = function () {
        fitty('#editable1', {
            minSize: 30,
            maxSize: 62
        });
    };

    // removes empty <p> tags in biography (leftovers from contentEditable)
    $('#editable3 p').each(function () {
        if ($(this).text().replace(/\s/g, '').length === 0 || $(this).text() === '') {
            $(this).remove();
        }
    });


    let eventListeners = [];

    /**
     * @method
     * @desc initiateEditMode() initiates editing mode
     */
    window.initiateEditMode = function () {

        $("#editSubjectButton")[0].querySelector("h2").innerHTML = "Submit changes";

        for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = true;

        $("#subjectImgEditPrompt")[0].style.display = "flex";
        $("#subjectImg")[0].style.filter = "blur(6px)";

        eventListeners[0] = $("#editable1")[0].addEventListener("input", function () {
            $("#editable2")[0].innerText = $("#editable1")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62
            });
        }, false);

        eventListeners[1] = $("#editable2")[0].addEventListener("input", function () {
            $("#editable1")[0].innerText = $("#editable2")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62
            });
        }, false);

        setTimeout(function () {$("#editSubjectDiv")[0].onclick = function () {submitChanges()};}, 250);

        $("#deleteSubjectButton h2")[0].innerHTML = "CANCEL";

        $("#deleteSubjectButton")[0].onclick = function () {

            $("#deleteSubjectButton h2")[0].innerHTML = "Delete <?php echo $subject ?>?";
            $("#editSubjectButton")[0].querySelector("h2").innerHTML = "Edit <?php echo $subject ?>?";

            for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = false;
            $("#subjectImgEditPrompt")[0].style.display = "none";
            $("#subjectImg")[0].style.filter = "";

            $("#deleteSubjectButton")[0].onclick = function () { if(confirm('Are you sure you want to delete <?php echo ($subject === 'artist') ? $firstName . ' ' . $lastName : ($subject === 'album' ? $title : $subject) ?> ?')) $('#delSubject_submitBtn').click() };
            setTimeout(function () {$("#editSubjectDiv")[0].onclick = function () {initiateEditMode()};}, 100);

        }
    };

    //if(confirm('Are you sure you want to delete <?php echo ($subject === 'artist') ? $firstName . ' ' . $lastName : ($subject === 'album' ? $title : $subject) ?>?')) $('#delSubject_submitBtn').click()


    /**
     * @method
     * @desc submitChanges() submits the changes by changing the values of a form, and clicking it's submit button.
     */
    window.submitChanges = function () {

        let results = [];
        for (let i = 1; i <= 3; i++) {
            results[i] = document.getElementById("editable" + i).innerHTML;
            results[i] = results[i].replace(/&nbsp;/gi, '').trim();
            results[i] = results[i].replace(/\s+/g, " ");
        }

        console.table(results);


        let subject = '<?php echo $subject ?>';

        if (subject === 'artist') {
            $("#editForm_name")[0].value = results[1];
            $("#editForm_bio")[0].value = results[3];
            if ($("#subjectImgEditInput")[0].value.trim().length > 3) { // !== (undefined || '' || null || ' '))
                $("#editForm_imageURL")[0].value = $("#subjectImgEditInput")[0].value.trim();
            }
        }

        if (subject === 'album') {
            $("#editForm_title")[0].value = results[1];
            $("#editForm_info")[0].value = results[3];
            if ($("#subjectImgEditInput")[0].value.trim().length > 3) { // !== (undefined || '' || null || ' '))
                $("#editForm_imageURL")[0].value = $("#subjectImgEditInput")[0].value.trim();
            }
        }


        setTimeout(function () {
            $("#editForm_submitBtn").click();
        }, 250);

    };


</script>