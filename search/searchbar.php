<div id="searchBar" class="row pop">
    <form action="../search" method="get">
        <input type="text" name="query" style="flex-grow: 1" onkeyup="if(event.key==='Enter') $('#searchButton').click();" required
               placeholder="Search for artists, albums, genres or songs.">
        <button id="searchButton" type="submit" class="retroButton"><i class="material-icons">search</i></button>
    </form>
</div>