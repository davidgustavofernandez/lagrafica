(function ($) {
    "use strict";
    var _debug = true;

    var eventHandler = function (event, selector) {
        event.stopPropagation();
        event.preventDefault();
        if (event.type === "touchend") selector.off("click");
    };

    // Contact
    var contact = function (channel, phone, email, subject, body) {
        var channel = channel != "" ? channel : "";
        var phone = phone != "" ? phone : "";
        var email = email != "" ? email : "";
        var subject = subject != "" ? subject : "";
        var body = body != "" ? body : "";

        if (_debug) {
            console.log(
                "CONTACT:",
                channel + "|" + phone + "|" + email + "|" + subject + "|" + body
            );
        }

        if (channel == "email") {
            document.location.href =
                "mailto:" + email + "?subject=" + subject + "&body=" + body;
        } else if (channel == "whatsapp") {
            if (
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent
                )
            ) {
                window.open("https://wa.me/" + phone + "/?text=" + body + "&");
            } else {
                window.open(
                    "https://web.whatsapp.com/send?phone=" +
                        phone +
                        "&text=" +
                        body +
                        "&"
                );
            }
        } else if (channel == "phone") {
            document.location.href = "tel:" + phone;
        }
    };

    var popUp = function (url, ancho, alto, id, extras) {
        if (navigator.userAgent.indexOf("Mac") > 0) {
            ancho = parseInt(ancho) + 15;
            alto = parseInt(alto) + 15;
        }
        var left = (screen.availWidth - ancho) / 2;
        var top = (screen.availHeight - alto) / 2;
        if (extras != "") {
            extras = "," + extras;
        }
        var ventana = window.open(
            url,
            id,
            "width=" +
                ancho +
                ",height=" +
                alto +
                ",left=" +
                left +
                ",top=" +
                top +
                ",screenX=" +
                left +
                ",screenY=" +
                top +
                extras
        );
        var bloqueado =
            "AVISO:\n\nPara ver este contenido es necesario que desactive\nel Bloqueo de Ventanas para este Sitio.";
        if (ventana == null || typeof ventana.document == "undefined") {
            alert(bloqueado);
        } else {
            return ventana;
        }
    };

    var share = function (
        channel,
        url,
        title,
        image,
        hashtags,
        summary,
        email,
        email_subject,
        email_body,
        whatsapp_phone,
        whatsapp_body,
        source
    ) {
        var image = image != "" ? image : "../js/share.png";
        var title = title != "" ? title : "";
        var hashtags = hashtags != "" ? hashtags : "";
        var summary = summary != "" ? summary : "";
        var email = email != "" ? email : "";
        var email_subject = email_subject != "" ? email_subject : "";
        var email_body = email_body != "" ? email_body : "";
        var whatsapp_phone = whatsapp_phone != "" ? whatsapp_phone : "";
        var whatsapp_body = whatsapp_body != "" ? whatsapp_body : "";
        var source = source != "" ? source : "";

        if (url != "") {
            if (channel == "facebook") {
                popUp(
                    "http://www.facebook.com/sharer.php?s=100&p[url]=" +
                        url +
                        "&p[title]=" +
                        title +
                        "&p[images][0]=" +
                        image +
                        "&p[summary][0]=" +
                        summary +
                        "&",
                    "500",
                    "400",
                    "pop_facebook",
                    "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,location=no,left=250,top=70"
                );
            } else if (channel == "twitter") {
                popUp(
                    "http://twitter.com/share?original_referer=" +
                        url +
                        "&text=" +
                        title +
                        "&",
                    "500",
                    "400",
                    "pop_facebook",
                    "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,location=no,left=250,top=70"
                );
            } else if (channel == "pinterest") {
                popUp(
                    "http://www.pinterest.com/pin/create/button/?url=" +
                        url +
                        "&media=" +
                        image +
                        "&description=" +
                        title +
                        "&",
                    "750",
                    "400",
                    "pop_pinterest",
                    "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,location=no,left=250,top=70"
                );
            } else if (channel == "linkedin") {
                popUp(
                    "https://www.linkedin.com/shareArticle?mini=true&url=" +
                        url +
                        "&title=" +
                        title +
                        "&source=" +
                        source +
                        "&",
                    "750",
                    "400",
                    "pop_pinterest",
                    "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,location=no,left=250,top=70"
                );
            } else if (channel == "email") {
                document.location.href =
                    "mailto:" +
                    email +
                    "?subject=" +
                    email_subject +
                    "&body=" +
                    email_body +
                    " " +
                    url;
            } else if (channel == "whatsapp") {
                if (
                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                        navigator.userAgent
                    )
                ) {
                    window.open(
                        "https://wa.me/" +
                            whatsapp_phone +
                            "/?text=" +
                            whatsapp_body +
                            "&"
                    );
                } else {
                    window.open(
                        "https://web.whatsapp.com/send?phone=" +
                            whatsapp_phone +
                            "&text=" +
                            whatsapp_body +
                            "&"
                    );
                }
            }
        }
    };

    // Load Callbacks { -------
    var _load = function () {


        // // Smooth scrolling using jQuery easing
        // $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
        //     if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        //         var target = $(this.hash);
        //         target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        //         if (target.length) {
        //             $('html, body').animate({
        //             scrollTop: (target.offset().top - 20)
        //             }, 500, "easeInOutExpo");
        //             return false;
        //         }
        //     }
        // });

        // Menú
        var menu = $("ul#navigation");
        if (menu.length) {
            menu.slicknav({
                prependTo: ".mobile_menu",
                closedSymbol: "+",
                openedSymbol: "-",
            });
        }

        $(".hamburger").on("click", function () {
            $(this).toggleClass("is-active");
            $(this).next().toggleClass("nav-menu-show");
        });

        // Image Background
        $("[data-background]").each(function () {
            $(this).css(
                "background-image",
                "url(" + $(this).attr("data-background") + ")"
            );
        });

        // Bach to top
        $("#back-top a").on("click", function () {
            $("body,html").animate({scrollTop: 0}, 800);
            return false;
        });

        // if (_debug) {
        //     console.log("id_section:", id_section);
        // }
        // Slider
        if (id_section && id_section == "1") {
            $("#slider").bxSlider({
                auto: false,
                autoControls: true,
                pager: true,
                adaptiveHeight: false,
                slideWidth: 0,
                touchEnabled: false,
                onSliderLoad: function (currentIndex) {
                    if (_debug) {
                        console.log("Init - slider");
                    }
                    var elemento = $("#slider li").eq(1);
                    $("#go-to-work").attr("href", elemento.attr("attr-url"));
                },
                onSlideAfter: function (current) {
                    $("#go-to-work").attr(
                        "href",
                        current[0].attributes[1].nodeValue
                    );
                },
            });
        }

        $("#preloader-active").delay(1000).fadeOut("slow");
        $("body").delay(1000).css({
            overflow: "visible",
        });

        var caption_height = $(
            ".services-section .container .row .col .services-caption .image"
        ).height();
        $(
            ".services-section .container .row .col .services-caption .hover"
        ).height(caption_height);
        $(
            ".services-section .container .row .col .services-caption .hover"
        ).css("margin-top", "-" + caption_height + "px");

        $(".contactAction").on("touchend click", function (event) {
            eventHandler(event, $(this));
            var channel = $(this).attr("data-channel");
            var phone = $(this).attr("data-phone");
            var email = $(this).attr("data-email");
            var subject = $(this).attr("data-subject");
            var body = $(this).attr("data-body");
            contact(channel, phone, email, subject, body);
        });

        $(document)
            .on("touchend mouseenter", ".social", function () {
                $(this).find(".social-buttons").toggleClass("open");
                return false;
            })
            .on("mouseleave", ".social", function () {
                $(this).find(".social-buttons").toggleClass("open");
                return false;
            });

        $(".share").on("touchend click", function (event) {
            eventHandler(event, $(this));
            var data_channel = $(this).attr("data-channel");
            var data_url = $(this).attr("data-url");
            var data_title = $(this).attr("data-title");
            var data_summary = $(this).attr("data-summary");
            var data_image = $(this).attr("data-image");
            var data_hashtags = $(this).attr("data-hashtags");
            var data_email = $(this).attr("data-email");
            var data_email_subject = $(this).attr("data-email-subject");
            var data_email_body = $(this).attr("data-email-body");
            var data_whatsapp_phone = $(this).attr("data-whatsapp-phone");
            var data_whatsapp_body = $(this).attr("data-whatsapp-body");
            var data_source = $(this).attr("data-source");
            share(
                data_channel,
                data_url,
                data_title,
                data_image,
                data_hashtags,
                data_summary,
                data_email,
                data_email_subject,
                data_email_body,
                data_whatsapp_phone,
                data_whatsapp_body,
                data_source
            );
        });

        // var content = $(".separator .container .row .col .content");
        var image = $(".separator .container .row .col .content img");
        var correction = "-" + image.height() + "px";
        var content = $(".separator .container .row .col .content").css(
            "margin-top",
            correction
        );
    };
    // } Load Callbacks -------

    // Scroll Callbacks { ---------
    var _scroll = function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $(".header-sticky").removeClass("sticky-bar");
            $("#back-top").fadeOut(500);
        } else {
            $(".header-sticky").addClass("sticky-bar");
            $("#back-top").fadeIn(500);
        }
    };
    // } Scroll Callbacks ---------

    $(window).on("load", function () {
        _load();
    });

    // On Scroll
    $(window).on("scroll", function () {
        _scroll();
    });

    // On Resize
    $(window).on("resize", function () {
        _load();
    });
})(jQuery);
