import Swiper from 'swiper';
import { Navigation, Scrollbar } from 'swiper/modules';
import TomSelect from "tom-select";

export const InitDatepicker = function () {
    /* datepicker */
    $(".datepicker").datepicker({
        minDate: 0,
        dateFormat: "d M, y"
    });
};

jQuery(document).ready(function ($) {
    var isFront = false; var isFlightRequestMax = false;
    if ($(document.body).hasClass("flight-request-max"))
        isFlightRequestMax = true;
    if ($(document.body).hasClass("front-page"))
        isFront = true;

    new Swiper('.news-block .swiper', {
        // configure Swiper to use modules
        modules: [Scrollbar],
        scrollbar: {
            el: '.swiper-scrollbar',
            hide: false,
        },
        slidesPerView: "auto",
        spaceBetween: 30,
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

    document.querySelectorAll('.tom-select').forEach((el)=>{
        let settings = {};
        new TomSelect(el,settings);
    });

    InitDatepicker();

    /* RoundTrip Datepicker */
    $(function () {
        var arrDateObj = $(".tab-round-trip .component-arrdate");
        var InitArrDate = function (mindate) {
            if (arrDateObj.datepicker("getDate") < mindate)
                arrDateObj.val("");
            arrDateObj.removeClass("hasDatepicker").datepicker({
                minDate: mindate,
                dateFormat: "d M, y"
            });
        };
        $(".tab-round-trip .component-depdate")
            .removeClass("hasDatepicker")
            .datepicker({
                minDate: 0,
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

    //flight request


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

export const initFlightRequestForm = function () {
    var formFlightRequestMaxWrapper = $(".form-flight-request");
    /* autocomplete */
    setTimeout(AutocompleteAirport);
};

export const AutocompleteAirport = function () {
    var autocomplete = $(".form-flight-request").find(".autocomplete");

    var autocomleteTest = function () {
        $(".form-flight-request .form-request-tab").each(function () {
            var self = $(this),
                fromAir = self.find(".field-from"),
                toAir = self.find(".field-to"),
                formRequestNotify = self.find('.form-request-notify');
            if (typeof fromAir.val() !== "undefined" && typeof toAir.val() !== "undefined" ) {
                if (fromAir.val().indexOf(' US,') !== -1 && toAir.val().indexOf(' US,') !== -1) {
                    formRequestNotify.addClass("open");
                } else {
                    formRequestNotify.removeClass("open");
                }
            }
        });
    }

    const autocompleteConfig = {
        source: function (request, response) {
            $.ajax({
                url: document.location.origin + "/request/search-airport",
                dataType: "json",
                type: "POST",
                data: {
                    keyword: request.term
                },
                success: function (data) {
                    const result = data.response;
                    const citiesByAirports = result.cities_by_airports;
                    const cities = result.cities;
                    const airports = result.airports;
                    const airportsByCities = result.airports_by_cities;
                    const citiesSearch = arrayUnique(cities.concat(citiesByAirports), 'city_code').sort(compare);
                    const airportsSearch = arrayUnique(airports.concat(airportsByCities), 'icao_code').sort(compare);
                    response($.map(airportsSearch, function (item) {
                        const city = item.city_code;
                        var result = '(' + (item.iata_code || item.icao_code) + ') ';
                        const dataCity = citiesSearch.find(function (c) { return c.city_code == city });
                        if (dataCity) {
                            result += dataCity.name + ', ';
                        }
                        result += item.country_code + ', ' + item.name;

                        return {
                            city: dataCity?.name,
                            country: item.country_code,
                            code: item.iata_code || item.icao_code,
                            name: item.name,
                            value: result,
                        }
                    }));
                }
            });
        },
        select: function (event, ui) {
            setTimeout(autocomleteTest);
        },
        minLength:3,
    };

    const renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( `<div class="flex items-center">
                           <i class="text-lg icon-airplane bg-white p-2 rounded-xl"></i>
                            <div class="ml-4">
                                <div>
                                   <span class="font-gilroy-semibold">${item.name}</span> <span class="font-gilroy-light">${item.code}</span>
                                </div>
                                <div>
                                    <span class="text-xs">${item.city ? item.city + ',' : '' } ${item.country}</span>
                                </div>
                            </div>
                         </div>` )
            .appendTo( ul );
    }

    autocomplete.each(function (){
        $(this).autocomplete(autocompleteConfig);
        $(this).autocomplete("instance")._renderItem = renderItem;
    });
    function compare( a, b ) {
        if ( a.popularity < b.popularity ){
            return 1;
        }
        if ( a.popularity > b.popularity ){
            return -1;
        }
        return 0;
    }
    function arrayUnique(array, prop) {
        var a = array.concat();
        for(var i=0; i<a.length; ++i) {
            if (typeof a[i][prop] === 'undefined'){
                continue;
            }
            for(var j=i+1; j<a.length; ++j) {
                if (typeof a[j][prop] === 'undefined'){
                    continue;
                }
                if(a[i][prop] === a[j][prop]) {
                    a.splice(j--, 1);
                }
            }
        }

        return a;
    }
};