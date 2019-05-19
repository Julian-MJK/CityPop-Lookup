$(function () {


    window.spotlightArtists = [
        {
            title: "Tatsuro Yamashita",
            image: "https://s3.amazonaws.com/radiomilwaukee-wordpress-uploads/wp-content/uploads/2019/02/19151548/2549741985_abc5d67498_b.jpg",
            href: "../artist?a=1",
        },
        {
            title: "Mariya Takeuchi",
            image: "https://i.kym-cdn.com/photos/images/original/001/334/161/8b8.jpg",
            href: "../artist?a=2",
        },
        {
            title: "ANRI",
            image: "https://i1.sndcdn.com/artworks-000177876721-pv44w4-t500x500.jpg",
            href: "../artist?a=10",
        },
        {
            title: "Toshiki Kadomatsu",
            image: "https://media.ntslive.co.uk/crop/641x641/c6a6dbf6-f734-4d0b-9520-329710344579_1510704000.png",
            href: "../artist?a=7",
        },
        {
            title: "Meiko Nakahara",
            image: "http://img15.shop-pro.jp/PA01239/479/product/97732495_th.jpg?cmsp_timestamp=20160116145413",
            href: "../artist?a=4",
        },
        {
            title: "Senri Oe",
            image: "https://3.bp.blogspot.com/-rS6lpNxUhF8/V3-5ctnsjGI/AAAAAAAA9PM/SLs6ZeKJ8hEgvRf8ZhBfLTAH3THjVZuiACLcB/s1600/oti4xv.png",
            href: "../artist?a=24",
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