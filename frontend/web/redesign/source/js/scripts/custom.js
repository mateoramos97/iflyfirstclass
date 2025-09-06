import Swiper from 'swiper';
import { Navigation, Scrollbar, Autoplay } from 'swiper/modules';
import {tomSelectInit} from "./tom-select";
import {InitAutocompleteAirport} from "./autocomplete";

export const InitDatepicker = function () {
    /* datepicker */
    $(".datepicker").datepicker({
        minDate: 0,
        maxDate: 350,
        dateFormat: "d M, y"
    });
};

jQuery(document).ready(function ($) {
    var isFront = false; var isFlightRequestMax = false;
    if ($(document.body).hasClass("flight-request-max"))
        isFlightRequestMax = true;
    if ($(document.body).hasClass("front-page"))
        isFront = true;

    $(function () {
        const videoPopup = $("#video-popup");

        $(document).on('click', '#video-popup', function (event) {
            if (event.target.tagName !== 'VIDEO') {
                videoPopup.find('video').trigger('pause');
                videoPopup.hide();
            }
        });

        $('.play-btn').click(function () {
            videoPopup.show();
            videoPopup.find('video').trigger('play');
        });
    });

    $(function () {
        $('.main-nav .dropdown').each(function () {
            $(this).click(function () {
                $(this).find('.menu-dropdown').toggleClass('active');
                $(this).find('.menu-service').toggleClass('active');
            })
        });

        $(document).click(function (event) {
            if (!$(event.target).closest(".dropdown").length) {
                $('.menu-dropdown').removeClass('active');
                $('.menu-service').removeClass('active');
            }
        });
    });

    new Swiper('.news-block .swiper', {
        modules: [Scrollbar],
        scrollbar: {
            el: '.swiper-scrollbar',
            hide: false,
        },
        slidesPerView: "auto",
        spaceBetween: 30,
        updateOnWindowResize: false,
    });

    new Swiper('.dealth-block-wrapper .swiper', {
        modules: [Autoplay],

        slidesPerView: "auto",
        speed: 5000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        loop: true,
        breakpoints:{
            1024: {
                spaceBetween: 0,
            },
            1200: {
                spaceBetween: 30,
            }
        }
    });

    new Swiper('.blog-list.swiper', {
        // configure Swiper to use modules
        modules: [Navigation],
        navigation: {
            nextEl: ".swiper-next",
            prevEl: ".swiper-prev",
        },
        slidesPerView: 3,
    });

    tomSelectInit();

    InitDatepicker();

    /* RoundTrip Datepicker */
    $(function () {
        var arrDateObj = $(".tab-round-trip .component-arrdate");
        var InitArrDate = function (mindate) {
            if (arrDateObj.datepicker("getDate") < mindate)
                arrDateObj.val("");
            arrDateObj.removeClass("hasDatepicker").datepicker({
                minDate: mindate,
                maxDate: 350,
                dateFormat: "d M, y"
            });
        };
        $(".tab-round-trip .component-depdate")
            .removeClass("hasDatepicker")
            .datepicker({
                minDate: 0,
                maxDate: 350,
                dateFormat: "d M, y",
                onSelect: function (date) {
                    var targetField = $(this).attr('data-date');
                    $('[data-date="' + targetField + '"]:not(.date-multi-city)').datepicker('setDate', date);
                    InitArrDate($(this).datepicker("getDate"));
                }
            });
    });

    //header menu
    $(function () {
        var browser = $(window),
        headerWrapper = $('#header-wrapper'),
        mainNav = headerWrapper.find('.main-nav'),
        menuSubWrapper = headerWrapper.find('.menu-sub-wrapper'),
        menues = headerWrapper.find('.menu'),
        menuSub = headerWrapper.find('.menu-sub');
        menues.each(function () {
        var self = $(this);
        self.click(function () {
            var dataMenu = $(this).data("menu");
            if ($(this).hasClass('active')) {
                menues.removeClass("active");
                menuSub.removeClass("active");
            } else {
                menues.removeClass("active");
                $(this).addClass("active");
                menuSub.removeClass("active");
                menuSub.filter("[data-menu='" + dataMenu + "']").addClass("active");
                }
            });
        });

        $(document).click(function(event) {
            if (!$(event.target).closest(".main-nav").length) {
                menuSub.removeClass("active");
                menues.removeClass("active");
            }
        });

        var ScrollEfectHeader = function () {
            if (browser.width() < 1260) {
                return;
            }
            if (browser.scrollTop() > 120) {
                $('body').css('padding-top', '100px');
                mainNav.addClass("fixed");
                menuSubWrapper.addClass("fixed");
            } else {
                $('body').css('padding-top', '0px');
                mainNav.removeClass("fixed");
                menuSubWrapper.removeClass("fixed");
            }
        }

        browser.scroll(function () {
            ScrollEfectHeader();
        });
    });

    //mobile header menu
    $(function () {
        var headerMobileWrapper = $(".header-mobile-wrapper"),
            openMenu = headerMobileWrapper.find(".open-menu"),
            closeMenu = headerMobileWrapper.find(".close-menu"),
            leftMenu = headerMobileWrapper.find(".left-menu"),
            leftMenuInner = leftMenu.find(".left-menu-inner");

        openMenu.click(function () {
            leftMenu.addClass("open");
        });

        closeMenu.click(function () {
            leftMenu.addClass("closing");
        });

        leftMenu.click(function (e) {
            if (!$(e.target).closest(leftMenuInner).length && leftMenu.hasClass('open')) {
                leftMenu.addClass('closing');
            }
        });

        leftMenuInner.on('webkitTransitionEnd otransitionend msTransitionEnd transitionend', function () {
            if (leftMenu.hasClass('closing')) {
                leftMenu.removeClass('closing').removeClass('open');
            }
        });
    });

    $(function () {
        const contactBtn = $(".contact-btn");
        const contactForm = $(".contact-form");
        contactBtn.click(function(){
            contactForm.show();
        })

        $(document).click(function(event) {
            if (!$(event.target).closest(".contact-btn").length) {
                contactForm.hide();
            }
        });
    });

    //form-tracker
    $(function () {
        var formTracker = $('.form-tracker');
        /* autocomplete */
        var AutocompleteAirport = function () {
            var autocomplete = formTracker.find(".airport-autocomplete");
            autocomplete.autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: document.location.origin + "/request/search-airport",
                        dataType: "json",
                        type: "POST",
                        data: {
                            keyword: request.term
                        },
                        success: function (data) {
                            response($.map($.parseJSON(data), function (item) {
                                return {
                                    value: item.label
                                }
                            }));
                        }
                    });
                },
                minLength: 3
            });
        };
        var AutocompleteAirline = function () {
            var autocomplete = formTracker.find(".airline-autocomplete");
            autocomplete.autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: document.location.origin + "/request/search-airline",
                        dataType: "json",
                        type: "POST",
                        data: {
                            keyword: request.term
                        },
                        success: function (data) {
                            response($.map($.parseJSON(data), function (item) {
                                return {
                                    value: item.label
                                }
                            }));
                        }
                    });
                },
                minLength: 3
            });
        };
        AutocompleteAirline();
        AutocompleteAirport();
    });

    //request subscriber
    $(function() {
        var requestSubscriber = $(".request-subscriber");
        requestSubscriber.each(function () {
            var self = $(this),
                hidden = self.find(".check-subscription-request-subscriber"),
                button = self.find("button[type='submit']");
            button.click(function () {
                hidden.val("f546jfghfHdhsdgUjbn345Hdssa3dsfdsf");
            });
            self.submit(function() {
                var form = $(this)
                var resultBlock = form.find(".result");
                form.find('input').each( function() {
                    $(this).removeClass("error");
                });
                var error = false;
                form.find('.required').each( function() {
                    if ($(this).val() == '') {
                        $(this).addClass("error");
                        error = true;
                    }
                });
                if (!error) {
                    $.ajax({
                        url: "/request/subscriber",
                        type: 'post',
                        dataType: 'JSON',
                        data: form.serialize(),
                        beforeSend: function () {
                            resultBlock.hide();
                            resultBlock.removeClass("success");
                            resultBlock.removeClass("error");
                        },
                        success: function (data) {
                            if (data.status === 'success') {
                                resultBlock.addClass("success");
                                resultBlock.text(data.message);
                                resultBlock.fadeIn();
                            } else {
                                resultBlock.addClass("error");
                                resultBlock.text(data.message);
                                resultBlock.fadeIn();
                            }
                        }
                    });
                }
                return false;
            });
        });
    });

    //support chat
    $(function() {
        var supportChatButton = $(".support-chat-button"),
            messageSupportWrapper = $(".message-support-wrapper"),
            closeButton = messageSupportWrapper.find(".close"),
            form = messageSupportWrapper.find(".form-block form");
        
        supportChatButton.click(function() {
            messageSupportWrapper.show()
        });

        closeButton.click(function() {
            messageSupportWrapper.hide()
        });

        form.each(function () {
            var self = $(this),
                hidden = self.find(".check-subscription"),
                button = self.find("button[type='submit']");
                
            button.click(function () {
                hidden.val("jfghfHdhsdgUjbn345Hddf0");
            });
        });
    });

    if (isFront) {
        //guarantee block
        $(function() {
            var guaranteeButton = $(".guarantee"),
                guaranteedBlockWrapper = $(".guaranteed-block-wrapper"),
                texture = guaranteedBlockWrapper.find(".texture"),
                isOpenBlock = false;

            guaranteeButton.click(function() {
                guaranteedBlockWrapper.show();
                isOpenBlock = true;
            });

            texture.click(function() {
                guaranteedBlockWrapper.hide();
                isOpenBlock = false;
            });

            $(this).keydown(function (eventObject) {
                if (eventObject.which === 27 && isOpenBlock === true) guaranteedBlockWrapper.hide();
                isOpenBlock = false;
            });
        });
    }


});

window.openTermsConditions = (elem) => {
    var content = document.getElementsByClassName("terms-conditions-wrapper");
    content[0].classList.add("open");
}
window.closeTermsConditions = (elem) => {
    var content = document.getElementsByClassName("terms-conditions-wrapper");
    content[0].classList.remove("open");
}

window.readMoreLanding = (elem) => {
    var content = document.getElementsByClassName("landing-columns"),
        landingMoreLink = document.getElementsByClassName("landing-more-link");
    landingMoreLink[0].classList.add('disable');
    content[0].classList.add("open");
}

window.popupBackdropShow = () => {
    const el = document.querySelector(".backdrop");
    el.classList.add("showed");
}

window.popupBackdropHide = () => {
    const el = document.querySelector(".backdrop");
    el.classList.remove("showed");
}

window.readMoreReviews = (elem) => {
    const content = document.querySelector(".reviews-wrapper");
    const moreLink = document.querySelector("#show-more-reviews");
    moreLink.classList.add('disable');
    content.classList.add("open");
}

window.readMoreDeals = (elem) => {
    const content = document.querySelector(".more-deals-wrapper");
    const moreLink = document.querySelector(".show-more-deals");
    moreLink.classList.add('disable');
    content.classList.add("open");
}

export const isMobileDisplay = () => {
    return $(window).width() < 600;
}

export const initFlightRequestForm = function () {
    setTimeout(InitAutocompleteAirport, 100);
};