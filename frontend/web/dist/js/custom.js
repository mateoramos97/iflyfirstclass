jQuery(document).ready(function ($) {
    var isFront = false;
    if ($(document.body).hasClass("flight-request-max"))
        isFlightRequestMax = true;
    if ($(document.body).hasClass("front-page"))
        isFront = true;

    var InitDatepicker = function () {
        /* datepicker */
        $(".datepicker").datepicker({
            minDate: 0,
            dateFormat: "d M, y"
        });
    };

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
            menuSubWrapper = headerWrapper.find('.menu-sub-wrapper')
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
            if (browser.scrollTop() > 36) {
                mainNav.addClass("fixed");
                menuSubWrapper.addClass("fixed");
            } else {
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

    //flight request
    $(function () {
        var formFlightRequestMaxWrapper = $(".form-flight-request"),
            navFormTab = formFlightRequestMaxWrapper.find(".tab-menu").find("li a"),
            formRequestTab = formFlightRequestMaxWrapper.find(".form-request-tab"),
            formRequestAirline = formFlightRequestMaxWrapper.find(".form-request-airline");
        /* tab form */
        navFormTab.each(function () {
            var self = $(this);
            self.click(function () {
                var dataNavId = $(this).data("tabLiId");
                navFormTab.removeClass("active");
                $(this).addClass("active");
                formRequestTab.removeClass("active");
                formRequestTab.filter("[data-tab-form='" + dataNavId + "']").addClass("active");
            });
        });

        //requset form
        var FormrequestAirline = function () {
            formRequestAirline.each(function () {
                var self = $(this),
                    hidden = self.find(".check-subscription"),
                    from = self.find(".from").find('input[type=text]').first(),
                    to = self.find(".to").find('input[type=text]').first(),
                    button = self.find("button[type='submit']");
                button.click(function () {
                    hidden.val("jfghfHdhsdgUjbn345Hd");
                });
                self.submit(function () {
                    var form = $(this),
                        error = false;

                    form.find('.required-field').each(function () {
                        $(this).removeClass("error-field");
                    });

                    form.find('.required-field').each(function () {
                        if ($(this).val() === '') {
                            $(this).addClass("error-field");
                            error = true;
                        }
                    });

                    if (from.val().toLowerCase() === to.val().toLowerCase()) {
                        from.addClass("error-field");
                        to.addClass("error-field");
                        error = true;
                    }

                    if (!error) {
                        button.prop("disabled", true);
                        button.html("Searching...");
                        return true;
                    }

                    return false;
                });
            });
        };
        FormrequestAirline();

        /* multi city */
        $(function () {
            var totalRowDestination = 3,
                currentCountRowDestination = 1,
                destinationBlockWrapper = formFlightRequestMaxWrapper.find(".destination-block-wrapper"),
                addDestinationBlock = formFlightRequestMaxWrapper.find(".add-destination"),
                addDestination = formFlightRequestMaxWrapper.find(".add-destination").find("a"),
                destinationRowFirstClone = formFlightRequestMaxWrapper.find("[data-destination-id='1']").clone();
            /* add class datepicker first flight */
            formFlightRequestMaxWrapper.find("[data-destination-id='1']")
                .find(".depart .form-group")
                .removeClass("field-dep-date-multi-city")
                .addClass("field-dep-date-multi-city-1")
                .find(".date-multi-city").addClass("datepicker")
                .attr("id", "dep-date-multi-city-1");
            InitDatepicker();
            var CheckCurrentCountRowDestination = function () {
                var destinationRow = formFlightRequestMaxWrapper.find(".destination-row");
                return destinationRow.length;
            };
            var IsAddFlightButton = function () {
                if (CheckCurrentCountRowDestination() >= totalRowDestination) {
                    addDestinationBlock.addClass("disabled");
                } else if (CheckCurrentCountRowDestination() < totalRowDestination && addDestinationBlock.hasClass("disabled")) {
                    addDestinationBlock.removeClass("disabled");
                }
            };
            /* sort destination id */
            var SortDestinationRowId = function () {
                var destinationRows = formFlightRequestMaxWrapper.find(".destination-row");
                destinationRows.each(function () {
                    $(this).attr("data-destination-id", $(this).index() + 1)
                        .find(".depart .form-group")
                        .removeClass("field-dep-date-multi-city")
                        .addClass("field-dep-date-multi-city-" + $(this).index() + 1)
                        .find(".date-multi-city")
                        .attr("id", "dep-date-multi-city-" + $(this).index() + 1);
                });
            };
            /* add flight */
            var AddFlight = function () {
                addDestination.click(function () {
                    var destinationRowClone = destinationRowFirstClone.clone();
                    currentCountRowDestination = CheckCurrentCountRowDestination();
                    if (currentCountRowDestination < totalRowDestination) {
                        destinationRowClone.attr("data-destination-id", currentCountRowDestination + 1)
                            .appendTo(destinationBlockWrapper)
                            .find(".depart .form-group")
                            .removeClass("field-dep-date-multi-city")
                            .addClass("field-dep-date-multi-city-" + currentCountRowDestination + 1)
                            .find(".date-multi-city")
                            .addClass("datepicker")
                            .attr("id", "dep-date-multi-city-" + currentCountRowDestination + 1);
                        var newDepDateWrapper = $(".field-dep-date-multi-city-" + currentCountRowDestination + 1);
                        newDepDateWrapper.find(".date-multi-city").remove();
                        newDepDateWrapper.append(
                            $('<input/>', {
                                name: 'FlightRequestMax[dep_date][]',
                                type: 'text',
                                id: 'dep-date-multi-city-' + currentCountRowDestination + 1,
                                class: 'date-multi-city border-radius-right datepicker required-field',
                                placeholder: 'Depart',
                                readonly: 'readonly'}).datepicker({
                                minDate: 0,
                                dateFormat: "d M, y"
                            })
                        );
                        RemoveFlight();
                        IsAddFlightButton();
                        AutocompleteAirport();
                    }
                    return false;
                });
            };
            AddFlight();
            /* remove flight */
            var RemoveFlight = function () {
                var destinationRows = formFlightRequestMaxWrapper.find(".destination-row");
                destinationRows.each(function () {
                    var self = $(this),
                        removeFlight = self.find(".remove-flight");

                    removeFlight.click(function () {
                        self.remove();
                        currentCountRowDestination = CheckCurrentCountRowDestination();
                        SortDestinationRowId();
                        IsAddFlightButton();
                    });
                });
            };
            RemoveFlight();
        });

        /* autocomplete */
        var AutocompleteAirport = function () {
            var autocomplete = formFlightRequestMaxWrapper.find(".autocomplete");

            var autocomleteTest = function () {
                formRequestTab.each(function () {
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
                                    value: result
                                }
                            }));
                        }
                    });
                },
                select: function (event, ui) {
                    setTimeout(autocomleteTest);
                },
                minLength:3,
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
        AutocompleteAirport();
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
                resultBlock = form.find(".result");
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