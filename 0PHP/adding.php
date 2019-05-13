<div id="addDiv">
    <h1>Something missing?</h1>
    <div class="container row">
        <h3>Add: </h3>
        <select name="select" id="addSelect" class="minimalistInput" style="margin: 0 10px;" autocomplete="off"
                onchange="
                    for(let i = 1; i < this.length; i++) document.getElementById('add'+$('#addSelect option').eq(i).val().capitalize()).style.display = 'none';
                    document.getElementById('add'+$('#addSelect :selected').val().capitalize()).style.display='flex'; ">
            <option value="" selected="selected" disabled hidden>Choose</option>
            <option value="artist">Artist</option>
            <option value="album">Album</option>
            <option value="song">Song</option>
        </select>
    </div>

    <div id="addArtist" class="addX pop" style="display:none">
        <h2>Add artist</h2>
        <form action="../0PHP/addArtist.php" method="post">
            <div class="container">
                <p>First name:</p>
                <input type="text" name="firstName" required> *
            </div>
            <div class="container">
                <p>Last name:</p>
                <input type="text" name="lastName" placeholder="">
            </div>
            <div class="container">
                <p>Birth year:</p>
                <input type="number" name="birthYear">
            </div>
            <div class="container">
                <p>Birth City:</p>
                <input type="text" name="birthCity">
            </div>
            <div class="container" style="flex-direction: column !important;">
                <button type="submit" class="retroButton"><i class="material-icons">
                        <!--style="margin: 0; font-size: 25pt;"--> person_add</i></button>
            </div>
        </form>
    </div>

    <div id="addAlbum" class="addX pop" style="display:none">
        <h2>Add album</h2>
        <form action="../0PHP/addAlbum.php" method="post">
            <div class="container">
                <p>Title:</p>
                <input type="text" name="title" required> *
            </div>
            <div class="container">
                <p>Artist:</p>
                <input type="text" name="artistName" placeholder="" required> *
            </div>
            <div class="container">
                <p>Genre:</p>
                <input type="text" name="genre" pattern=".{2,}">
            </div>
            <div class="container">
                <p>Year:</p>
                <input type="number" name="releaseYear">
            </div>
            <div class="container">
                <button type="submit" class="retroButton"><i class="material-icons">library_add</i></button>
            </div>
        </form>
    </div>

    <div id="addSong" class="addX pop" style="display:none">
        <h2>Add song</h2>
        <form action="../0PHP/addSong.php" method="post">
            <div class="container">
                <p>Title:</p>
                <input type="text" name="title" pattern=".{1,}"> *
            </div>
            <div class="container">
                <p>Album:</p>
                <input type="text" name="albumName" placeholder=""> *
            </div>
            <div class="container">
                <button type="submit" class="retroButton"><i class="material-icons">library_add</i></button>
            </div>
        </form>
    </div>
</div>