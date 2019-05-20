<?php

    /* user must defined $subject and $subject_id (for example $subject='artist'; $subject_id=7 */


    $ratings = new stdClass();
    $ratings->table = $conn->query('SELECT rating FROM userRating_' . $subject . ' WHERE ' . $subject . "_id='" . $subject_id . "'");

    if ($ratings->table) while ($row = $ratings->table->fetch_assoc()) $ratings->all[] = $row['rating'];


    // Ratings for testing
    // $ratings->all = [1, 4, 1, 5, 4, 4, 2, 4];

    isset($ratings->all) ? $ratings->total = count($ratings->all) : $ratings->total = 0;
    if (isset($ratings->all)) $ratings->all_str = implode(', ', $ratings->all);
    if (isset($ratings->all)) $ratings->average = round(array_sum($ratings->all) / $ratings->total, 1);

    $ratings->user = $conn->query('SELECT rating FROM userRating_' . $subject . ' WHERE ' . $subject . "_id='" . $subject_id . "' AND user_id='" . $_SESSION['user_id'] . "'")->fetch_assoc()['rating'];


?>

<!-- RATINGS -->
<div id="ratingDiv" class="secondary">
    <h1 class="fancyFont"> User ratings </h1>
    <hr>
    <div class="container row" id="rating_stars">
        <span class="fa fa-star" id="fa-star_1"></span>
        <span class="fa fa-star" id="fa-star_2"></span>
        <span class="fa fa-star" id="fa-star_3"></span>
        <span class="fa fa-star" id="fa-star_4"></span>
        <span class="fa fa-star" id="fa-star_5"></span>
    </div>
    <p id="rating_avgP"> <?php echo isset($ratings->average) ? $ratings->average . ' average (' . $ratings->total . ' ratings)' : 'This ' . $subject . ' has no ratings.'; ?> </p>

    <form id="submitRatingForm" action="../-PHP/user/rate.php" method="post" class="alignCenter column" style="display: flex; width: 100%">
        <input hidden type="text" name="subject" value="<?php echo $subject ?>">
        <input hidden type="text" name="subject_id" value="<?php echo $subject_id ?>">
        <input hidden type="text" name="rating">
        <button class="fancyButtonBackground" style="width: 50%; color: black; height: 0; display: none; font-size: 12pt">
            Submit
        </button>
    </form>

    <script>

        // === SHOWING THE AVERAGE RATING === //
        let rating_stars = $("#rating_stars .fa-star");
        <?php echo isset($ratings->user) ? 'let rating = Math.round(' . $ratings->user . ');' : (isset($ratings->average) ? 'let rating = Math.round(' . $ratings->average . ');' : 'let rating = 0'); ?>

        let i = 0;

        function fillStar() {
            rating_stars[i].classList.add("checked");
            rating_stars[i].style.transform = "scale(1.15) translate(-5px, -5px)";
            i++;
            if (i < rating) setTimeout(fillStar, 750);
        }

        if (rating !== 0) setTimeout(fillStar, 2500);



        // === APPLYING USER RATING === //
        let selectedStar;
        rating_stars.on({
            mouseenter: function () {
                selectedStar = Number(this.id.replace('fa-star_', ''));
                this.style.transform = (selectedStar <= rating) ? "scale(1.15) translate(-5px, -5px)" : "scale(1.25) rotate(15deg)";
                this.style.zIndex = "2";
            },
            mouseleave: function () {
                if (selectedStar > rating) this.style.transform = "";
                this.style.zIndex = "1";
            },
            click: function () {
                rating = selectedStar;
                $("#submitRatingForm input[name='rating']")[0].value = rating;
                for (let k = 0; k < rating_stars.length; k++) {
                    if (k < selectedStar) {
                        rating_stars[k].classList.add("checked");
                        rating_stars[k].style.transform = "scale(1.15) translate(-5px, -5px)"
                    } else {
                        rating_stars[k].classList.remove("checked");
                        rating_stars[k].style.transform = "rotate(90deg)"
                    }
                }
                $("#submitRatingForm button")[0].style.display = "block";
                setTimeout(function () { $("#submitRatingForm button")[0].style.height = "50px"; }, 50);
            }
        });

    </script>
</div>