$(document).ready(function () {
    // nice select initializer
    $("select").niceSelect();

    const perfectMatchSlider = () => {
        let wrapper = document.querySelector(".perfect--match--area--content");

        if (wrapper) {
            $(".perfect--match--area--content .owl-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 3,
                    },
                    1000: {
                        items: 4,
                    },
                },
            });
        }
    };

    perfectMatchSlider();

    const reviewSlider = () => {
        let wrapper = document.querySelector(".review--area--wrapper");

        if (wrapper) {
            $(".review--area--wrapper .owl-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 3,
                    },
                    1000: {
                        items: 3,
                    },
                },
            });
        }
    };

    reviewSlider();

    const passShow = () => {
        let wrappers = document.querySelectorAll(
            ".joining--content.auth--area .single--input.pass"
        );

        if (wrappers) {
            wrappers.forEach((wrapper) => {
                let showButton = wrapper.querySelector(".show--pass");
                let input = wrapper.querySelector("input");

                showButton.addEventListener("click", () => {
                    showButton.classList.toggle("active");

                    if (input.type === "password") {
                        input.type = "text";
                    } else {
                        input.type = "password";
                    }
                });
            });
        }
    };

    passShow();

    const profileSwiper = () => {
        let wrapper = document.querySelector(".profile--swiping--area--wrapper");

        if (wrapper) {
            $(".profile--swiping--area--wrapper .owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1,
                dots: false,
            });
        }
    };

    profileSwiper();

    const helpPopUp = () => {
        let wrapper = document.querySelector(".help--support--area--wrapper");

        if (wrapper) {
            let triggerBtn = wrapper.querySelector(".get--help--btn");
            let popup = document.querySelector("#help--center--popup");
            let closebtn = popup.querySelector(".close--btn");
            let popUpContent = popup.querySelector(".content");

            // opening the popup
            triggerBtn.addEventListener("click", () => {
                popup.classList.add("active");
            });
            // closing the popup
            closebtn.addEventListener("click", () => {
                popup.classList.remove("active");
            });

            // closing on outside click
            document.addEventListener("click", (event) => {
                if (
                    !popUpContent.contains(event.target) &&
                    !triggerBtn.contains(event.target)
                ) {
                    popup.classList.remove("active");
                }
            });
        }
    };
    helpPopUp();


    const requestPopUp = () => {
        let wrapper = document.querySelector(".help--support--area--wrapper");

        $(".modal_wrapper").map(function (el) {
            let modal = $(this)
            modal.find(".get--request--btn").on("click", () => {
                modal.find(".help--center--popup.request").css("opacity", 1)
                modal.find(".help--center--popup.request").css("visibility", "visible");
            })

            modal.find(".close--btn").on("click", () => {
                modal.find(".help--center--popup.request").css("opacity", 0)
                modal.find(".help--center--popup.request").css("visibility", "hidden");
            })

        })
    };
    requestPopUp();

    const showPassInput = () => {
        let wrapper = document.querySelector(".settings--form--input.password");

        if (wrapper) {
            let inputs = wrapper.querySelectorAll(".single--input");

            inputs.forEach((item) => {
                let input = item.querySelector("input");

                let showPass = item.querySelector(".show--pass");

                showPass.addEventListener("click", () => {
                    showPass.classList.toggle("active");

                    if (input.type === "password") {
                        input.type = "text";
                    } else {
                        input.type = "password";
                    }
                });
            });
        }
    };
    showPassInput();

    const inputFilePreview = () => {
        let wrappers = document.querySelectorAll(
            ".single--question--slide .file--input"
        );

        if (wrappers) {
            wrappers.forEach((wrapper) => {
                console.log(wrapper);
                let fileInput = wrapper.querySelector("input");

                fileInput.addEventListener("change", (event) => {
                    const file = event.target.files[0];
                    const previewContainer = wrapper.querySelector(".file--preview");

                    // Clear previous preview
                    previewContainer.innerHTML = "";

                    console.log("file entered");

                    if (file) {
                        const fileReader = new FileReader();

                        fileReader.onload = function (e) {
                            console.log(e);
                            const img = document.createElement("img");
                            img.src = e.target.result;
                            previewContainer.appendChild(img);
                        };

                        fileReader.readAsDataURL(file);
                    }
                });
            });
        }
    };
    inputFilePreview();

    const mobileNav = () => {
        let wrapper = document.querySelector(".header--content--wrapper");
        let header = document.querySelector("header");

        if (wrapper) {
            let icon = wrapper.querySelector(".hamburger");
            let sidebar = wrapper.querySelector(".menu--links");

            icon.addEventListener("click", () => {
                icon.classList.toggle("active");
                sidebar.classList.toggle("active");
            });

            // closing on outside click
            document.addEventListener("click", (event) => {
                if (!icon.contains(event.target) && !sidebar.contains(event.target)) {
                    icon.classList.remove("active");
                    sidebar.classList.remove("active");
                }
            });

            // adding shadow class on scroll
            document.addEventListener("scroll", () => {
                let target = window.scrollY;

                if (target > 80) {
                    header.classList.add("show--shadow");
                } else {
                    header.classList.remove("show--shadow");
                }
            });
        }
    };
    mobileNav();

    const boostPopUpFunction = () => {
        let wrapper = document.querySelector(".get--boost--popup--wrapper");
        let getBoostBtn = document.querySelector(
            ".single--stats.boosts .get--boost "
        );

        if (wrapper && getBoostBtn) {
            let content = wrapper.querySelector(".get--boost--popup--content");

            let closeButton = wrapper.querySelector(".close--btn");

            // opening the document
            getBoostBtn.addEventListener("click", (event) => {
                event.preventDefault();
                wrapper.classList.add("active");
            });

            // closing the document

            closeButton.addEventListener("click", () => {
                wrapper.classList.remove("active");
            });

            // closing on outside click
            document.addEventListener("click", (event) => {
                if (
                    !content.contains(event.target) &&
                    !getBoostBtn.contains(event.target)
                ) {
                    wrapper.classList.remove("active");
                }
            });
        }
    };
    boostPopUpFunction();
    $(".add--photo--wrapper .dropify").dropify();

    // notification dropdown
    const notificationDropDown = () => {
        let wrapper = document.querySelector(".notification--wrapper");


        if (wrapper) {
            let content = wrapper.querySelector(".content");
            let icon = wrapper.querySelector(".notification");

            // toggling the notification content
            icon.addEventListener("click", (event) => {
                event.preventDefault();
                event.stopPropagation();

                icon.classList.toggle("active");
                content.classList.toggle("active");
            });

            // closing the notification on outside click
            document.addEventListener("click", (event) => {
                if (!wrapper.contains(event.target)) {
                    icon.classList.remove("active");
                    content.classList.remove("active");
                }
            });
        }
    };

    notificationDropDown();
    // mobile sidebar
    const mobileSidebar = () => {
        let wrapper = document.querySelector(".sidebar--area--wrapper");

        if (wrapper) {
            let sideButton = document.querySelector(".sidebar--button");

            // toggling the sidebar
            sideButton.addEventListener("click", () => {
                wrapper.classList.toggle("active");
                sideButton.classList.toggle("active");
            });

            // closing the sidebar
            document.addEventListener("click", (event) => {
                if (
                    !sideButton.contains(event.target) &&
                    !wrapper.contains(event.target)
                ) {
                    wrapper.classList.remove("active");
                    sideButton.classList.remove("active");
                }
            });
        }
    };

    mobileSidebar();
    // mobile search functionality
    const mobileSearch = () => {
        let wrapper = document.querySelector(".dashboard--header--wrapper");

        if (wrapper) {
            let searchBar = wrapper.querySelector(".search--bar");
            let searchIcon = wrapper.querySelector(".mobile--search--icon");
            let inputElem = searchBar.querySelector("input");

            // turning the search bar on
            searchIcon.addEventListener("click", () => {
                searchBar.classList.add("active");
                searchBar.querySelector("input").focus();
            });

            // closing the search bar
            document.addEventListener("click", (event) => {
                if (
                    !inputElem.contains(event.target) &&
                    !searchIcon.contains(event.target)
                ) {
                    searchBar.classList.remove("active");
                }
            });
        }
    };
    mobileSearch();
});
