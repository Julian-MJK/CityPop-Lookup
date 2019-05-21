<div class="primary" id="allArtists">
    <h1 style="margin: 15px; position: sticky"> ALL ARTISTS </h1>
    <span style="width: 100%; max-height: 400px !important; overflow-y: scroll; overflow-x: hidden;">
        <?php $artists = $conn->query("SELECT * FROM artist ORDER BY firstName");
        while ($row = $artists->fetch_assoc()) {
            $artist_id = $row['artist_id'];
            $artist_firstName = $row['firstName'];
            $artist_lastName = $row['lastName'];
            echo "<h3 style='width: 100%; text-align: left; margin-left: 0%; word-break: break-all'> " .
                "<a href='../artist?a=$artist_id'> $artist_firstName $artist_lastName </a> </h3>";
        } ?>
    </span>
</div>