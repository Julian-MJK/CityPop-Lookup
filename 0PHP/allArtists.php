<div id="allArtists" class="primary">
    <h1 style="margin: 15px;""> ALL ARTISTS </h1>
    <?php $artists = $kobling->query("SELECT * FROM artist ORDER BY firstName");
    while ($row = $artists->fetch_assoc()) {
        $artist_id = $row['artist_id'];
        $artist_firstName = $row['firstName'];
        $artist_lastName = $row['lastName'];
        echo "<h3 style='width: 100%; text-align: left; margin-left: 7%;'> " .
            "<a href='../artist?a=$artist_id'> $artist_firstName $artist_lastName </a> </h3>";
    } ?>
</div>