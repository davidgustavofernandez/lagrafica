/**
 * hero v1.01.02
 * Copyright 2023-2025 David Gustavo Fernandez (https://www.linkedin.com/in/david-gustavo-fernandez-7bb4a028/)
 * Written for Developers Build ASAP
 * Licensed under MIT (http://opensource.org/licenses/MIT)
 */
(function ($) {
    var _debug = true;

    // var defaults = {
    //   // GENERAL
    //   heroSelector: '',
    //   parrallax: false,
    //   responsive: false,
    //   images: [],
    //   image: '',
    //   background: [{'size': '','repeat': '','position': '','attachment': '',}],
    //   height_mode: [{'mode': 'normal','type': '','valor': 0}]
    // };

    $.fn.hero = function (options) {
        var settings = $.extend(
            {
                heroSelector: "",
                parrallax: false,
                responsive: false,
                images: [],
                image: "",
                background: [
                    {size: "", repeat: "", position: "", attachment: ""},
                ],
                height_mode: [{mode: "normal", type: "", valor: 0}],
            },
            options
        );

        if (this.length === 0) {
            return this;
        }

        // support multiple elements
        if (this.length > 1) {
            this.each(function () {
                $(this).hero(options);
            });
            return this;
        }

        // create a namespace to be used throughout the plugin
        var hero = {};
        // set a reference to our hero element
        el = this;

        // get the original window dimens (thanks a lot IE)
        (windowWidth = $(window).width()), (windowHeight = $(window).height());

        // Return if hero is already initialized
        if ($(el).data("hero")) {
            return;
        }

        // PRIVATE FUNCTIONS
        var init = function () {
            if (_debug) {
                console.log("Init Hero");
                console.log(
                    "Viewport:" + "W: " + windowWidth + " | H: " + windowHeight
                );
            }

            // Return if hero is already initialized
            if ($(el).data("hero")) {
                return;
            }

            hero.working = false;

            // merge user-supplied options with the defaults
            // hero.settings = $.extend({}, defaults, options);
            hero.settings = settings;
            if (_debug) {
                console.log("hero.settings:", hero.settings);
            }

            // Add images background
            set_image($(el), hero);

            // Add Background indications
            if (hero.settings.background[0].size != "") {
                $(el).css({
                    "background-size": hero.settings.background[0].size,
                });
            }
            if (hero.settings.background[0].repeat != "") {
                $(el).css({
                    "background-repeat": hero.settings.background[0].repeat,
                });
            }
            if (hero.settings.background[0].position != "") {
                $(el).css({
                    "background-position": hero.settings.background[0].position,
                });
            }
            if (hero.settings.background[0].attachment != "") {
                $(el).css({
                    "background-attachment":
                        hero.settings.background[0].attachment,
                });
            }

            // Resize Height from viewport height
            if (hero.settings.height_mode[0].mode == "viewport") {
                if (hero.settings.height_mode[0].mode != "less") {
                    if (_debug) {
                        console.log("MORE");
                    }
                    // detect viewport
                    if (windowWidth < 391 && windowHeight < 845) {
                        if (_debug) {
                            console.log("Mobile - Portrait");
                        }
                        resize_height(
                            $(el),
                            hero.settings.height_mode[0].type,
                            0
                        );
                    } else if (windowWidth < 845 && windowHeight < 391) {
                        if (_debug) {
                            console.log("Mobile - Lanscape");
                        }
                        resize_height(
                            $(el),
                            hero.settings.height_mode[0].type,
                            120
                        );
                    } else if (windowWidth < 821 && windowHeight < 1181) {
                        if (_debug) {
                            console.log("Tablet - Portrait");
                        }
                        resize_height(
                            $(el),
                            hero.settings.height_mode[0].type,
                            120
                        );
                    } else if (windowWidth < 1181 && windowHeight < 821) {
                        if (_debug) {
                            console.log("Tablet - Landscape");
                        }
                        resize_height(
                            $(el),
                            hero.settings.height_mode[0].type,
                            150
                        );
                    } else if (windowWidth < 1366 && windowHeight < 821) {
                        if (_debug) {
                            console.log("Desktop - Landscape 1");
                        }
                        resize_height(
                            $(el),
                            hero.settings.height_mode[0].type,
                            317
                        );
                    } else {
                        if (_debug) {
                            console.log("Desktop - Landscape");
                        }
                        resize_height(
                            $(el),
                            hero.settings.height_mode[0].type,
                            hero.settings.height_mode[0].valor
                        );
                    }
                    // if (windowWidth <= '500') {
                    //   resize_height($(el), hero.settings.height_mode[0].type, 0);
                    // } else if (windowWidth >= '501' && windowWidth <= '900') {
                    //   resize_height($(el), hero.settings.height_mode[0].type, 120);
                    // } else {
                    // resize_height(
                    //     $(el),
                    //     hero.settings.height_mode[0].type,
                    //     hero.settings.height_mode[0].valor
                    // );
                    // }
                } else {
                    if (_debug) {
                        console.log("LESS");
                    }
                    resize_height(
                        $(el),
                        hero.settings.height_mode[0].type,
                        hero.settings.height_mode[0].valor
                    );
                }
            } else {
                $(el).css({height: hero.settings.height + "px"});
            }

            // bind the resize call to the window
            // if (hero.settings.responsive) {
            //   // console.log('call');
            //   $(window).bind("resize", resizeWindow(el, hero));
            // }
        };

        /**
         * Update all dynamic hero elements
         */
        el.redrawHero = function (hero) {
            // resize all
            if (_debug) {
                console.log("Resize");
            }

            // Set a new image
            set_image($(el), hero);

            // Resize Height from viewport height
            if (hero.settings.height_mode[0].mode == "viewport") {
                resize_height(
                    $(el),
                    hero.settings.height_mode[0].type,
                    hero.settings.height_mode[0].valor
                );
            } else {
                $(el).css({height: hero.settings.height + "px"});
            }
        };

        /**
         * Setting image
         */
        var set_image = function (el, hero) {
            if (hero.settings.responsive == true) {
                // get the original window dimens (thanks a lot IE)
                (windowWidth = $(window).width()),
                    (windowHeight = $(window).height());
                // Add images background
                if (hero.settings.images[0].desktop) {
                    var current_image = "";

                    // detect viewport
                    if (windowWidth < 391 && windowHeight < 845) {
                        if (_debug) {
                            console.log("Mobile - Portrait");
                        }
                        current_image = hero.settings.images[0].mobile_portrait;
                    } else if (windowWidth < 845 && windowHeight < 391) {
                        if (_debug) {
                            console.log("Mobile - Lanscape");
                        }
                        current_image =
                            hero.settings.images[0].mobile_landscape;
                    } else if (windowWidth < 821 && windowHeight < 1181) {
                        if (_debug) {
                            console.log("Tablet - Portrait");
                        }
                        current_image = hero.settings.images[0].tablet_portrait;
                    } else if (windowWidth < 1181 && windowHeight < 821) {
                        if (_debug) {
                            console.log("Tablet - Landscape");
                        }
                        current_image =
                            hero.settings.images[0].tablet_landscape;
                    } else {
                        if (_debug) {
                            console.log("Desktop - Landscape");
                        }
                        current_image = hero.settings.images[0].desktop;
                    }

                    if (_debug) {
                        console.log("Add image background");
                        console.log(current_image);
                    }

                    $(el).css("background-image", "url(" + current_image + ")");
                } else {
                    $(el).css(
                        "background-image",
                        "url(" + hero.settings.image + ")"
                    );
                }
            }
        };

        /**
         * Resize Height
         */
        var resize_height = function (el, operator, valor) {
            if (_debug) {
                console.log(
                    "Resize Height:",
                    el + "|" + operator + "|" + valor
                );
            }

            // Get height of viewport
            var window_height = $(window).outerHeight();
            if (_debug) {
                console.log("window_height:", window_height);
            }

            // Add or substract height
            if (operator != "" && valor != "") {
                if (operator == "less") {
                    var return_height = window_height - Number(valor);
                } else {
                    var return_height = window_height + Number(valor);
                }
            } else {
                var return_height = window_height;
            }

            $(el).css({height: return_height + "px"});
        };

        /**
         * Window resize event callback
         */
        var resizeWindow = function (el, hero) {
            // console.log('resizeWindow sssssssssss');
            // Delay if hero working.
            if (hero.working) {
                window.setTimeout(resizeWindow(el, hero), 10);
            } else {
                // get the new window dimens (again, thank you IE)
                var windowWidthNew = $(window).width(),
                    windowHeightNew = $(window).height();
                // make sure that it is a true window resize
                // *we must check this because our dinosaur friend IE fires a window resize event when certain DOM elements
                // are resized. Can you just die already?*
                if (
                    windowWidth !== windowWidthNew ||
                    windowHeight !== windowHeightNew
                ) {
                    // set the new window dimens
                    windowWidth = windowWidthNew;
                    windowHeight = windowHeightNew;
                    // update all dynamic elements
                    el.redrawHero(hero);
                }
            }
        };

        init();

        // el.reloadHero = function (settings) {
        //   console.log('?');
        //   // if (settings !== undefined) { options = settings; }
        //   this.init();
        // };

        // $( window ).resize(function() {
        //   // Remove slider and redo
        //   // console.log('resize');
        //   resizeWindow(el, hero);
        //   // init();
        // });

        // returns the current jQuery object
        return this;
    };
})(jQuery);
