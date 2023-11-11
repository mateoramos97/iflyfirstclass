jQuery(document).ready(function ($) {
    var isFront = isLandingPage = isAirlinePage = isBlogPage = isBlogArticlePage = isTravelTipsPage =
        isTravelTipsAttactionsPage = isAboutPage = isHotelPage = isCorporateAccountsPage = isFlightRequestMax =
            isServicePage = isFlightRequestAccepted = false;
    if ($(document.body).hasClass("flight-request-max"))
        isFlightRequestMax = true;
    if ($(document.body).hasClass("front-page"))
        isFront = true;
    if ($(document.body).hasClass("landing-page"))
        isLandingPage = true;
    if ($(document.body).hasClass("airline-page"))
        isAirlinePage = true;
    if ($(document.body).hasClass("blog-page"))
        isBlogPage = true;
    if ($(document.body).hasClass("blog-article-page"))
        isBlogArticlePage = true;
    if ($(document.body).hasClass("travel-tips-page"))
        isTravelTipsPage = true;
    if ($(document.body).hasClass("travel-tips-attactions-page"))
        isTravelTipsAttactionsPage = true;
    if ($(document.body).hasClass("about-page"))
        isAboutPage = true;
    if ($(document.body).hasClass("hotels-page"))
        isHotelPage = true;
    if ($(document.body).hasClass("corporate-accounts-page"))
        isCorporateAccountsPage = true;
    if ($(document.body).hasClass("service-page"))
        isServicePage = true;
    if ($(document.body).hasClass("flight-request-accepted"))
        isFlightRequestAccepted = true;

    // datepicker
    //$(function () {
    //	$(".datepicker").datepicker({
    //		minDate: 0,
    //		dateFormat: "d M, y"
    //	});
    //});

    var InitCustomUI = function () {
        /* datepicker */
        $(".datepicker").datepicker({
            minDate: 0,
            dateFormat: "d M, y"
        });
    };

    InitCustomUI();

    /*link scroll top page*/
    $(function () {
        var linkScrollTopPage = $(".link-scroll-top-page");
        linkScrollTopPage.click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });
    });

    /*header nav drop menu*/
    $(function () {
        var headerNavMenu = $(".header-nav-menu"),
            drop = headerNavMenu.find(".drop"),
            dropMenu = drop.find("ul");
        drop.click(function () {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
            }
            else {
                $(this).addClass("active");
            }
        });
        $(document).click(function (event) {
            if ($(event.target).closest(drop).length)
                return;
            drop.removeClass("active");
            event.stopPropagation();
        });
    });
    /*header visible*/
    var HeaderVisible = function (valueHeight) {
        var browser = $(window),
            headerWrapper = $("#header-wrapper");
        if (browser.scrollTop() > valueHeight) {
            headerWrapper.addClass("visible");
        }
        browser.scroll(function () {
            if (browser.scrollTop() > valueHeight) {
                headerWrapper.addClass("visible");
            }
            else {
                headerWrapper.removeClass("visible");
                headerWrapper.find(".drop").removeClass("active");
            }
        });
    };
    /*header left menu*/
    $(function () {
        var headerInnerMobile = $('.header-inner-mobile'),
            block_item = headerInnerMobile.find(".left-menu"),
            leftMenuInner = block_item.find(".left-menu-inner"),
            openMenu = headerInnerMobile.find(".open-menu"),
            closeMenu = block_item.find(".close-menu");

        openMenu.on('click', function () {
            block_item.addClass('open');
        });
        closeMenu.on('click', function () {
            block_item.addClass('menu_close');
            return false;
        });
        block_item.on('click', function (e) {
            if (!$(e.target).closest(leftMenuInner).length && block_item.hasClass('open')) {
                block_item.addClass('menu_close');
            }
        });
        block_item.on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
            if (block_item.hasClass('menu_close')) {
                block_item.removeClass('menu_close').removeClass('open');
            }
        });
        var ScrollEfectHeader = function () {
            if ($(window).scrollTop() > 0)
                headerInnerMobile.addClass("scroll");
            else
                headerInnerMobile.removeClass("scroll");
        };
        ScrollEfectHeader();
        $(window).scroll(function () {
            ScrollEfectHeader();
        });
    });

    if (isFlightRequestMax) {
        /* form */
        $(function () {
            var welcomeBlockWrapper = $(".welcome-block-wrapper"),
                formBlockWrapper = welcomeBlockWrapper.find(".form-flight-request-max-wrapper"),
                formRequestAirline = welcomeBlockWrapper.find(".form-request-airline"),
                navFormTab = welcomeBlockWrapper.find(".tab-menu").find("li a"),
                formRequestTab = welcomeBlockWrapper.find(".form-request-tab"),
                topContentWrapper = welcomeBlockWrapper.find(".top-content-wrapper"),
                contactClockWrapper = welcomeBlockWrapper.find(".contact-block-wrapper");
            var FormrequestAirline = function () {
                formRequestAirline.each(function () {
                    var self = $(this),
                        hidden = self.find(".check-subscription"),
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
                            if ($(this).val() == '') {
                                $(this).addClass("error-field");
                                error = true;
                            }
                        });
                        if (!error) {
                            return true;
                        }
                        return false;
                    });
                });
            };
            FormrequestAirline();
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
            /* multi city */
            $(function () {
                var totalRowDestination = 3,
                    currentCountRowDestination = 1,
                    destinationBlockWrapper = formBlockWrapper.find(".destination-block-wrapper"),
                    addDestinationBlock = formBlockWrapper.find(".add-destination"),
                    addDestination = formBlockWrapper.find(".add-destination").find("a"),
                    destinationRowFirstClone = formBlockWrapper.find("[data-destination-id='1']").clone();
                /* add class datepicker first flight */
                formBlockWrapper.find("[data-destination-id='1']")
                    .find(".depart .form-group")
                    .removeClass("field-dep-date-multi-city")
                    .addClass("field-dep-date-multi-city-1")
                    .find(".date-multi-city").addClass("datepicker")
                    .attr("id", "dep-date-multi-city-1");
                InitCustomUI();
                var CheckCurrentCountRowDestination = function () {
                    var destinationRow = formBlockWrapper.find(".destination-row");
                    return destinationRow.length;
                };
                var IsAddFlightButton = function () {
                    if (CheckCurrentCountRowDestination() >= totalRowDestination) {
                        addDestinationBlock.addClass("disabled");
                    }
                    else if (CheckCurrentCountRowDestination() < totalRowDestination && addDestinationBlock.hasClass("disabled")) {
                        addDestinationBlock.removeClass("disabled");
                    }
                };
                /* sort destination id */
                var SortDestinationRowId = function () {
                    var destinationRows = formBlockWrapper.find(".destination-row");
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
                            RemoveFlight();
                            IsAddFlightButton();
                            InitCustomUI();
                            AutocompleteAirport();
                        }
                        return false;
                    });
                };
                AddFlight();
                /* remove flight */
                var RemoveFlight = function () {
                    var destinationRows = formBlockWrapper.find(".destination-row");
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
            /* travelers info */
            $(function () {
                formRequestTab.each(function () {
                    var self = $(this),
                        fieldBlockWrapper = self.find(".field-block-wrapper"),
                        personesBlock = fieldBlockWrapper.find(".persones-block"),
                        labelPeople = fieldBlockWrapper.find(".label-people"),
                        labelCabinClass = fieldBlockWrapper.find(".label-cabin-class"),
                        cabinClassSelect = fieldBlockWrapper.find(".cabin-class").find("select"),
                        travelersBlockLinkOpen = fieldBlockWrapper.find(".travelers-block").find("a"),
                        travelersContent = fieldBlockWrapper.find(".travelers-content");
                    /* close travelers content */
                    $(document).click(function (event) {
                        if (travelersContent.has(event.target).length === 0 && travelersContent.hasClass("open")) {
                            travelersContent.removeClass("open");
                            travelersBlockLinkOpen.removeClass("open");
                        }
                    });
                    /* open travelers content */
                    var OpenTravelersContent = function () {
                        travelersBlockLinkOpen.click(function () {
                            if (travelersContent.hasClass("open")) {
                                travelersContent.removeClass("open");
                                travelersBlockLinkOpen.removeClass("open");
                            }
                            else {
                                travelersContent.addClass("open");
                                travelersBlockLinkOpen.addClass("open");
                            }

                            return false;
                        });
                    };
                    /* check number persones */
                    var CheckPersones = function (count) {
                        if (count == 1) {
                            labelPeople.text(count + " person");
                        }
                        else {
                            labelPeople.text(count + " persons");
                        }
                    };
                    /* check cabin class */
                    var CheckCabinClass = function (value) {
                        labelCabinClass.text(value);
                    };

                    /* change cabin class */
                    var ChangeCabinClass = function () {
                        cabinClassSelect.change(function () {
                            CheckCabinClass($(this).find("option:selected").text());
                        });
                    };
                    /* add persones */
                    var AddPersones = function () {
                        var minus = personesBlock.find(".minus"),
                            plus = personesBlock.find(".plus"),
                            input = personesBlock.find("input"),
                            maxPersones = 8;
                        minus.click(function () {
                            var count = parseInt(input.val()) - 1;
                            count = count < 1 ? 1 : count;
                            input.val(count);
                            input.change();
                            CheckPersones(count);
                            return false;
                        });
                        plus.click(function () {
                            var count = parseInt(input.val()) + 1;
                            count = count > maxPersones ? maxPersones : count;
                            input.val(count);
                            input.change();
                            CheckPersones(count);
                            return false;
                        });
                    };
                    OpenTravelersContent();
                    ChangeCabinClass();
                    AddPersones();
                });
            });
            /* autocomplete */
            var AutocompleteAirport = function () {
                var autocomplete = formBlockWrapper.find(".autocomplete");
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
                    minLength: 3,
                });
            };
            AutocompleteAirport();
        });
    }

    /*front-page*/
    if (isFront) {
        /*city resize*/
        function CityImgResize() {
            if ($('#cities_list')) {
                var cityItems = $('#cities_list').find(".city-items.visible"),
                    ratio = cityItems.find("li").find(".photo").first().width() / 173;
                cityItems.find("li .photo").height(125 * ratio);
            }
        }

        CityImgResize();

        /*city block*/
        var welcomeBlockWrapper = $(".welcome-block-wrapper"),
            pageContent = $(".page-content"),
            specialsBlockWrapper = $(".specials-block-wrapper"),
            continentsItems = specialsBlockWrapper.find(".continents-items"),
            continentItemLink = continentsItems.find(".continent-item").find("a"),
            citiesBlockWrapper = specialsBlockWrapper.find(".cities-block-wrapper"),
            cities_list = citiesBlockWrapper.find("#cities_list"),
            cityItems = citiesBlockWrapper.find(".city-items"),
            bottomBlockWrapper = citiesBlockWrapper.find(".bottom-block-wrapper"),
            buttonShowMore = bottomBlockWrapper.find(".show-more");

        /*welcome block*/
        var ResizeWelcomeBlockHeight = function () {
            var page_h = $("html").height(),
                continentListWrapperHeight = $(".continent-list-wrapper").height();
            welcomeBlockWrapper.css("height", page_h - continentListWrapperHeight);
            pageContent.css('margin-top', page_h - continentListWrapperHeight);
        };
        //ResizeWelcomeBlockHeight();

        buttonShowMore.click(function () {
            //citiesBlockWrapper.css("height", "auto");
            citiesBlockWrapper.addClass("open");
            bottomBlockWrapper.removeClass("active").addClass("disable");
        });
        var OpenBlockCity = function () {
            continentItemLink.click(function () {
                var self = $(this),
                    cityItems = citiesBlockWrapper.find(".city-items"),
                    dataContinentId = self.data("continentId");

                if (cityItems.filter("[data-current-continent='" + dataContinentId + "']").length == 0) {
                    $.ajax({
                        url: "site/continents",
                        dataType: "html",
                        type: "POST",
                        data: {},
                        success: function (data) {
                            cities_list.append(data);
                            var cityItems = citiesBlockWrapper.find(".city-items");
                            continentItemLink.removeClass("active");
                            self.addClass("active");
                            cityItems.removeClass("visible");
                            cityItems.filter("[data-current-continent='" + dataContinentId + "']").addClass("visible");
                            CityImgResize();
                            ResizeCitiesBlockWrapper();
                            //OpenBlockCity();
                        }
                    });
                }
                else {
                    continentItemLink.removeClass("active");
                    self.addClass("active");
                    cityItems.removeClass("visible");
                    cityItems.filter("[data-current-continent='" + dataContinentId + "']").addClass("visible");
                    CityImgResize();
                    ResizeCitiesBlockWrapper();
                }
                return false;
            });
        };
        OpenBlockCity();

        var ResizeCitiesBlockWrapper = function () {
            var currentCityBlock = citiesBlockWrapper.find(".city-items.visible"),
                currentCityBlockHeight = currentCityBlock.height(),
                cityItems = currentCityBlock.find(".city-item");
            cityItemHeight = cityItems.first().outerHeight();
            stableCityItemHeight = cityItemHeight * 3;
            if ((currentCityBlockHeight + 100) < stableCityItemHeight) {
                citiesBlockWrapper.css("height", currentCityBlockHeight);
                bottomBlockWrapper.removeClass("active").addClass("disable");
            }
            else {
                citiesBlockWrapper.css("height", (cityItemHeight * 2) + 100);
                bottomBlockWrapper.removeClass("disable").addClass("active");
            }
        };
        ResizeCitiesBlockWrapper();

        /*resize*/
        $(window).resize(function () {
            ResizeWelcomeBlockHeight();
            CityImgResize();
            ResizeCitiesBlockWrapper();
        });
    }

    if (isBlogPage) {
        function BlogImgResize() {
            if ($('#cities_list')) {
                var Items = $('.items'),
                    ratio = Items.find(".item").find(".photo").first().width() / 230;
                Items.find(".item .photo").height(125 * ratio);
            }
        }

        BlogImgResize();
        $(window).resize(function () {
            BlogImgResize();
        });
    }

    if (isTravelTipsPage) {
        HeaderVisible(0);
        function TravelTipsResize() {
            var Items = $('.items'),
                ratio = Items.find(".item").find(".inner").first().width() / 173;
            Items.find(".item .inner").height(270 * ratio);
        }

        TravelTipsResize();
        $(window).resize(function () {
            TravelTipsResize();
        });
    }

    if (isAboutPage) {
        HeaderVisible(0);
    }

    if (isTravelTipsAttactionsPage) {
        function TravelTipsResize() {
            var Items = $(".random-travel-tips").find('.items'),
                ratio = Items.find(".item").find(".inner").first().width() / 173;
            Items.find(".item .inner").height(270 * ratio);
        }

        TravelTipsResize();
        $(window).resize(function () {
            TravelTipsResize();
        });
    }

    if (isHotelPage) {
        HeaderVisible(0);
        function TravelTipsResize() {
            var Items = $(".random-travel-tips").find('.items'),
                ratio = Items.find(".item").find(".inner").first().width() / 173;
            Items.find(".item .inner").height(270 * ratio);
        }

        TravelTipsResize();
        $(window).resize(function () {
            TravelTipsResize();
        });
    }

    if (isCorporateAccountsPage) {
        HeaderVisible(0);
        /*form-animate-label*/
        $(function () {
            var formAnimateLabel = $(".form-animate-label");
            formAnimateLabel.each(function () {
                var self = $(this),
                    muiFormControl = self.find(".mui-form-control"),
                    muiFormFloatingLabel = self.find(".mui-form-floating-label");
                muiFormControl.each(function (index) {
                    if ($(this).val() != '') {
                        self.find(".mui-form-floating-label" + "-" + index).addClass("active");
                    }
                    else {
                        self.find(".mui-form-floating-label" + "-" + index).removeClass("active");
                    }
                    $(this).focusout(function () {
                        if ($(this).val() != '') {
                            self.find(".mui-form-floating-label" + "-" + index).addClass("active");
                        }
                        else {
                            self.find(".mui-form-floating-label" + "-" + index).removeClass("active");
                        }
                    });
                });
            });
        });
    }

    /*parallax*/
    if (isFront || isLandingPage || isBlogPage || isBlogArticlePage || isTravelTipsAttactionsPage || isServicePage) {
        var headerWrapper = $("#header-wrapper");
        $(function () {
            function singleHeaderScroll() {
                var singleHeaderContent = $('.single-header__content'),
                    singleHeader = singleHeaderContent.closest('.section--header-parallax'),
                    singleHeaderFhMeta = $('.single-header__meta'),
                    singlePageMenu = singleHeader.find('.header-top'),
                    caseBg = $('.header-case__img'),
                    scrollCoef_t = 250;
                // if (!singleHeaderContent.length) return;

                if (isBlogPage) {
                    scrollCoef_t = 100;
                }

                var scrollCoef = $(window).scrollTop() / singleHeader.outerHeight();
                var topTranfsorm = scrollCoef * scrollCoef_t;
                var opacity = 1 - 1 * scrollCoef;

                if ($(window).width() > 760) {
                    singleHeaderContent.css('transform', 'translateY(' + (-topTranfsorm) + 'px)');
                    /*if (singleHeaderFhMeta.length) {
                     singleHeaderFhMeta.css('transform', 'translateY(' + (-topTranfsorm) + 'px)');
                     }*/
                } else {
                    // singleHeaderContent.css({'transform': 'translateY(' + (topTranfsorm) + 'px)'});
                }

                if (opacity <= 0) {
                    singlePageMenu.hide();
                    headerWrapper.addClass("visible");
                } else {
                    singlePageMenu.show();
                    headerWrapper.find(".drop").removeClass("active");
                    headerWrapper.removeClass("visible");
                }

                if (singlePageMenu.length) {
                    if ($(window).width() <= 760) {
                        /*scrollCoef = $(window).scrollTop() / ($('.single-header__title').offset().top - singlePageMenu.outerHeight()/2);
                         opacity =  1 - 1 * scrollCoef;
                         if (opacity < 0) opacity = 0;
                         singlePageMenu.css('opacity', opacity);*/
                    } else {
                        if (opacity < 0) opacity = 0;
                        singlePageMenu.css('opacity', opacity);
                    }
                }
            }

            singleHeaderScroll();

            $(window).scroll(function () {
                singleHeaderScroll();
            });
        });
    }

    $(function() {
        var requestSubscriber = $(".request-subscriber");
        requestSubscriber.each(function () {
            var self = $(this),
                hidden = self.find(".check-subscription-request-subscriber"),
                button = self.find("button[type='submit']");
            button.click(function () {
                hidden.val("jfghfHdhsdgUjbn345Hdssa3dsfdsf");
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
});