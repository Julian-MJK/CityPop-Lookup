$(function () {


    window.spotlightArtists = [
        {
            title: "Tatsuro Yamashita",
            image: "https://aramajapan.com/wp-content/uploads/2018/05/aramajapan.com-tatsuro-yamashita-reveals-the-details-about-his-upcoming-double-a-side-single-tatsuro-yamashita-reveals-the-details-about-his-upcoming-double-a-side-single-1-e1527710600509.jpg",
            href: "../games/Blackjack/index.html",
        },
        {
            title: "Mariya Takeuchi",
            image: "https://i.kym-cdn.com/photos/images/original/001/334/161/8b8.jpg",
            href: "../games/Roulette/index.php",
        },
        {
            title: "ANRI",
            image: "https://i1.sndcdn.com/artworks-000177876721-pv44w4-t500x500.jpg",
            href: "../games/Crash/index.php",
        },
        {
            title: "Meiko Nakahara",
            image: "data:image/jpeg;base64,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",
            href: "../games/GuessNumber/index.php",
        },
        {
            title: "Senri Oe",
            image: "https://3.bp.blogspot.com/-rS6lpNxUhF8/V3-5ctnsjGI/AAAAAAAA9PM/SLs6ZeKJ8hEgvRf8ZhBfLTAH3THjVZuiACLcB/s1600/oti4xv.png",
            href: "../games/CoinFlip/index.php",
        },
        {
            title: "Toshiki Kadomatsu",
            image: "http://popscene.jp/img/kasomatsu20190308.jpg",
            href: "../games/RPG tilemap/index.html",
        },

    ];


    // ____________________________________ DISPLAYING GAMES ___________________________________
    /**
     * method createGameBox(object) creates and returns a HTML element containing an image, title and link from given object.
     * @param object {Object} - The object of which to fetch the image url, title and link.
     * @returns {HTMLElement} - The HTML element generated.
     */
    function createGameBox(object) {

        // CREATING THE CONTAINER FOR THE GAME
        let container = document.createElement("div");
        container.classList.add("spotlight_container");

        // CREATING THE CONTAINER FOR THE IMAGE AND IT'S TITLE
        let imageContainer = document.createElement("div");
        imageContainer.classList.add("spotlight_imageContainer");

        // CREATING THE IMAGE
        let image = document.createElement("div");
        image.classList.add("spotlight_image");
        image.style.backgroundImage = "url(" + object.image + ")";

        //CREATING THE TITLE AND IT'S CONTAINER
        let imageTitleContainer = document.createElement("div");
        imageTitleContainer.classList.add("spotlight_imageTitleContainer");
        let title = document.createElement("h1");
        title.innerHTML = object.title.capitalize();
        imageTitleContainer.appendChild(title);

        // CREATING THE BUTTON AND IT'S TEXT
        let button = document.createElement("button");
        let buttonText = document.createElement("h2");
        buttonText.innerHTML = " ARTIST PAGE ";
        button.appendChild(buttonText);

        // ADDING EVENT LISTENERS ON THE BUTTON ELEMENT
        $(button).on({
            click: function () {
                // PLAYS AN ANIMATION ON EACH GAME BOX THAT ISN'T THIS ONE
                /* let tempVar = 0; for--> tempVar++; if (tempVar === 2) tempVar = 0;   if-->(notcontainer-->if     (tempVar === 0) { gameBoxes[i].classList.add("shadow-inset-center"); } else { gameBoxes[i].classList.add("shadow-inset-center"); }*/
                //container.style.transform = "scale(1.2)";
                /*
                for (let i = 0; i < gameBoxes.length; i++) {
                    if (gameBoxes[i] !== container) {
                        //gameBoxes[i].querySelector(".spotlight_image").style.filter = "";
                        gameBoxes[i].style.transform = "scale(0.95)";
                    }
                }
                */
                setTimeout(function () {
                    /*for (let i = 0; i < gameBoxes.length; i++) {
                        if (gameBoxes[i] !== container) {
                            gameBoxes[i].style.transform = "";
                        }
                    }
                    container.style.transform = "";
                    */
                    window.location.href = object.href;
                }, 150);
            },
            // BLURS OTHER GAME-IMAGES ON HOVER
            mouseenter: function () {
                // BLURS EACH GAME BOX THAT ISN'T THIS ONE
                for (let i = 0; i < gameBoxes.length; i++) {
                    if (gameBoxes[i] !== container) {
                        gameBoxes[i].querySelector(".spotlight_image").style.filter = "blur(3px)";
                    }
                }
            },
            // DE-BLURS OTHER GAME-IMAGES WHEN NO LONGER HOVERING
            mouseleave: function () {
                // DE-BLURS EACH GAME BOX THAT ISN'T THIS ONE
                for (let i = 0; i < gameBoxes.length; i++) {
                    if (gameBoxes[i] !== container) {
                        gameBoxes[i].querySelector(".spotlight_image").style.filter = "";
                    }
                }
            },

        });

        //APPENDING THE IMAGE AND IT'S TITLE TO THEIR CONTAINER
        imageContainer.appendChild(image);
        imageContainer.appendChild(imageTitleContainer);

        //APPENDING THE IMAGE CONTAINER AND THE BUTTON TO THE GAME CONTAINER
        container.appendChild(imageContainer);
        container.appendChild(button);

        //RETURNING THE GAME CONTAINER
        return container;
    }



    /*
    - STRUCTURE:
    <div class="spotlight_container">
        <div class="spotlight_imageContainer">
            <div class="spotlight_image" style="background-image: url(' [IMAGE URL] ')"></div>
            <div class="spotlight_imageTitleContainer">
                <h1> [TITLE] </h1>
            </div>
        </div>
        <button> <h2> PLAY NOW </h2> </button>
    </div>
    */


    /**
     * method addAllGameBoxes(container, array) creates a HTML element for each object of given array, using method createGameBox, and appends each element to the given container.
     * @param container {HTMLElement} - The container in which to append the created HTML elements.
     * @param array {Array} - The array from where to fetch the values used for creating the elements with method createGameBox. Should contain "title", "image" and "href".
     */
    function addAllGameBoxes(container, array, outputArray) {
        //kan alternativt velge hvor mange kolonner en skal generere, men det er mer flexible å i stedet bare bruke max-width på container.
        for (let i = 0; i < array.length; i++) {
            //if (array[i] === undefined) break; - breaks the lop if the given array element for some reason is undefined. Was more relevant when I was using the define-number-of-rows method when a row couldn't be filled, but it does no harm to keep.
            let gameContainer = createGameBox(spotlightArtists[i]);
            container.appendChild(gameContainer);
            outputArray[i] = gameContainer;
        }

    }



    let gameBoxes = [];

    // Creates and appends all game-boxes into the div with id "gamesContainer", and puts each game box element into the array "gameBoxes".
    addAllGameBoxes($("#spotlightContainer")[0], spotlightArtists, gameBoxes);


    for (let i = 0; i < gameBoxes.length; i++) {
        gameBoxes[i].style.transitionDuration = "0.5s";
    }





});