<script>

    var subject = '<?php echo $subject ?>';

    // prevents chrome adding a new <div> element on "enter" keypress in contenteditable=true.
    document.execCommand('defaultParagraphSeparator', false, 'p');

    window.onresize = function () {
        fitty('#editable1', {
            minSize: 30,
            maxSize: 62,
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

        if (subject === "album") {
            window.initiateGenreDeletionMode();
            window.initiateSongDeletionMode();
        }

        $("#editSubjectButton")[0].querySelector("h2").innerHTML = "Submit changes";

        for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = true;

        $("#subjectImgEditPrompt")[0].style.display = "flex";
        $("#subjectImg")[0].style.filter = "blur(6px)";

        eventListeners[0] = $("#editable1")[0].addEventListener("input", function () {
            $("#editable2")[0].innerText = $("#editable1")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62,
            });
        }, false);

        eventListeners[1] = $("#editable2")[0].addEventListener("input", function () {
            $("#editable1")[0].innerText = $("#editable2")[0].innerText;
            fitty('#editable1', {
                minSize: 30,
                maxSize: 62,
            });
        }, false);

        setTimeout(function () {$("#editSubjectDiv")[0].onclick = function () {submitChanges()};}, 250);

        $("#deleteSubjectButton h2")[0].innerHTML = "CANCEL";

        $("#deleteSubjectButton")[0].onclick = function () {

            if (subject === "album") {
                window.exitGenreDeletionMode();
                window.exitSongDeletionMode();
            }

            $("#deleteSubjectButton h2")[0].innerHTML = "Delete <?php echo $subject ?>?";
            $("#editSubjectButton")[0].querySelector("h2").innerHTML = "Edit <?php echo $subject ?>?";

            for (let i = 1; i <= 3; i++) document.getElementById("editable" + i).contentEditable = false;
            $("#subjectImgEditPrompt")[0].style.display = "none";
            $("#subjectImg")[0].style.filter = "";

            $("#deleteSubjectButton")[0].onclick = function () { if (confirm('Are you sure you want to delete <?php echo ($subject === 'artist') ? $firstName . ' ' . $lastName : ($subject === 'album' ? $title : $subject) ?> ?')) $('#delSubject_submitBtn').click() };
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


    if (subject === "album") {
        window.selectedGenreI = 0;
        window.selectedGenre = "";

        var genresContainer = $("#subjectGenresDiv")[0];
        var genreCount = '<?php echo isset($genres_count) ? $genres_count : 0; ?>';
        genreCount = Number(genreCount);
        var genresEl = [];

        window.initiateGenreDeletionMode = function () {
            if (genreCount !== 0) {
                for (let i = 0; i < genreCount - 1; i++) {
                    genresEl[i] = genresContainer.getElementsByClassName("album")[i];
                    genresEl[i].style.fontStyle = "italic";
                    genresEl[i].onmouseenter = function () {
                        this.style.textDecoration = "line-through";
                        this.style.transform = "scale(1.3)";
                        this.querySelector("h2").style.textDecoration = "initial";
                    };
                    genresEl[i].onmouseleave = function () {
                        this.style.transform = "";
                        this.style.textDecoration = "";
                    };
                    genresEl[i].onclick = function () {
                        window.selectedGenreI = i;
                        window.selectedGenre = this.querySelector("h2").innerText;
                        //$("#genreDeletionForm")[0].getElementsByTagName("key2")
                        document.getElementById("genreDelForm_key2").value = "'" + window.selectedGenre + "'";
                        $("#genreDeletionForm")[0].querySelector("button").click();
                    }
                }
            }
        };


        window.exitGenreDeletionMode = function () {
            if (genreCount !== 0) {
                for (let i = 0; i < genreCount - 1; i++) {
                    genresEl[i].style.fontStyle = "normal";
                    genresEl[i].style.textDecoration = "";
                    genresEl[i].style.transform = "";
                    genresEl[i].onmouseenter = function () { this.style.textDecoration = "underline"};
                    genresEl[i].onmouseleave = function () { this.style.textDecoration = ""};
                    genresEl[i].onclick = function () {window.location.href = '../search?query=' + this.querySelector("h2").innerText}
                }
            }
        };



        window.selectedSongI = 0;
        window.selectedSong = "";

        var songContainer = $("#subjectAlbumsDiv")[0];
        var songCount = '<?php echo isset($songs->count) ? $songs->count : 0; ?>';
        var songIds = [];
        songCount = Number(songCount);
        var songsEl = [];

        window.initiateSongDeletionMode = function () {
            if (songCount !== 0) {
                for (let i = 0; i < songCount-1; i++) {

                    songsEl[i] = songContainer.getElementsByClassName("album")[i];

                    songsEl[i].style.fontStyle = "italic";
                    songsEl[i].onmouseenter = function () {
                        this.style.textDecoration = "line-through";
                        this.style.cursor = "pointer";
                        this.style.transform = "scale(1.3)";
                        this.querySelector("h2").style.textDecoration = "initial";
                    };
                    songsEl[i].onmouseleave = function () {
                        this.style.transform = "";
                        this.style.textDecoration = "";
                    };
                    songsEl[i].onclick = function () {
                        window.selectedSongI = i;
                        window.selectedSong = this.querySelector("h2").innerText;
                        //$("#genreDeletionForm")[0].getElementsByTagName("key2")
                        //document.getElementById("songDelForm_song").value = "'" + window.selectedSong + "'";
                        document.getElementById("songDelForm_song_id").value = Number(this.id.replace('song_', ''));
                        $("#songDeletionForm")[0].querySelector("button").click();
                    }
                }
            }
        };


        window.exitSongDeletionMode = function () {
            if (songCount !== 0) {
                for (let i = 0; i < songCount-1; i++) {
                    songsEl[i].style.textDecoration = "";
                    songsEl[i].style.fontStyle = "normal";
                    songsEl[i].style.cursor = "normal";
                    songsEl[i].style.transform = "";
                    songsEl[i].onmouseenter = function () { this.style.textDecoration = "underline"};
                    songsEl[i].onmouseleave = function () { this.style.textDecoration = ""};
                    songsEl[i].onclick = function () {window.location.href = '../search?query=' + this.querySelector("h2").innerText}
                }
            }
        }
    }


</script>