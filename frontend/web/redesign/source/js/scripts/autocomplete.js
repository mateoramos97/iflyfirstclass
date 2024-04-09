import {isMobileDisplay} from "./custom";

export const InitAutocompleteAirport = function () {

	const leftOffset = 4;
	const minRightOffset = 14;
	const defaultWidth = 408;
	$('.autocomplete-value-input').each(function() {
		const elAutocompleteInput = $(this).closest('.autocomplete-wrapper').find('.autocomplete-enter-input-wrapper');
		const elValueInput = $(this).closest('.autocomplete-wrapper').find('.autocomplete-value-input');
		const form = $(this).closest('.form-flight-request');
		if(elValueInput.outerWidth() > (elAutocompleteInput.outerWidth() - leftOffset)) {
			elAutocompleteInput.css('width', elValueInput.outerWidth() + leftOffset);
		}

		const windowWidth = $(window).width();
		if (isMobileDisplay()) {
			const newWidth = windowWidth - 42;
			elAutocompleteInput.css('width', newWidth);
			const rightOffset = (windowWidth - (elValueInput.offset().left));
			if (rightOffset < newWidth) {
				elAutocompleteInput.css('left', (rightOffset - newWidth - 20) + 'px');
			}
		} else {
			elAutocompleteInput.css('width', defaultWidth);
			const rightOffset = ($(window).width() - (elValueInput.offset().left));
			const formLeftFullOffset = form.offset().left + form.outerWidth();
			const elAutocompleteInputLeftFullOffset = elAutocompleteInput.offset().left + elAutocompleteInput.outerWidth();

			if (elAutocompleteInputLeftFullOffset > formLeftFullOffset) {
				const left = (formLeftFullOffset -  elAutocompleteInputLeftFullOffset) - (windowWidth > 1024 ? minRightOffset : 0);
				elAutocompleteInput.css('left', left+ 'px');
			} else if (rightOffset < elAutocompleteInput.outerWidth()) {
				elAutocompleteInput.css('left', (rightOffset - elAutocompleteInput.outerWidth()) + 'px');
			}
		}

		$(this).click(function() {
			$('.autocomplete-enter-input-wrapper').each(function (){
				hideElement($(this));
			});

			const el = $(this).closest('.autocomplete-wrapper').find('.autocomplete-enter-input-wrapper');
			if (isMobileDisplay()) {
				popupBackdropShow();
				window.scrollTo({top: $(el).offset().top - 100, behavior: "smooth"});
			}
			showElement(el);
			setTimeout(() => {
				el.find('.ui-autocomplete-input').focus();
			}, 100);
		});
	});

	$(document).click(function(event) {
		const el = $(event.target);
		if(!el.hasClass('autocomplete-value-input') && !el.parent('.autocomplete-value-input').length) {
			const el = $('.autocomplete-enter-input-wrapper');
			hideElement(el);
			popupBackdropHide();
		}
	});

	const autocompleteSelectedHandle = function (event, ui) {
		const el = $(event.target).closest('.autocomplete-wrapper').find('.autocomplete-enter-input-wrapper');
		hideElement(el);
		const elInput = $(event.target).closest('.autocomplete-wrapper').find('.autocomplete-value-input');
		elInput.val(ui.item.value);

		$(".form-flight-request .form-request-tab").each(function () {
			const self = $(this),
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
						let result = '(' + (item.iata_code || item.icao_code) + ') ';
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
			setTimeout(() => autocompleteSelectedHandle(event,ui));
		},
		minLength:3,
		open: function () {
			const dropdown = $('ul.ui-autocomplete')
			const autocompleteInputWrapper =  $(this).parent('.autocomplete-enter-input-wrapper');
			autocompleteInputWrapper.addClass('autocomplete-opened');
			dropdown.css('width', autocompleteInputWrapper.outerWidth()).addClass('opened');
		},
		close: function () {
			$('ul.ui-autocomplete')
				.removeClass('opened')
				.css('display','none');
			$(this).parent('.autocomplete-enter-input-wrapper').removeClass('autocomplete-opened');
		},
	};

	const renderItem = function( ul, item ) {
		return $( "<li>" )
			.append( `<div class="flex items-center">
                           <i class="text-lg icon-airplane bg-white"></i>
                            <div class="airport-wrapper">
                                <div>
                                   <span class="font-gilroy-semibold airport-name">${item.name}</span><span class="pl-2 font-gilroy-light airport-code">${item.code}</span>
                                </div>
                                <div>
                                    <span class="airport-location">${item.city ? item.city + ',' : '' } ${item.country}</span>
                                </div>
                            </div>
                         </div>` )
			.appendTo( ul );
	}

	const autocomplete = $(".form-flight-request").find(".autocomplete");

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

};

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

function hideElement(el) {
	el.css('visibility', 'hidden');
	el.css('opacity', '0');
}
function showElement(el) {
	el.css('visibility', 'visible');
	el.css('opacity', '1');
}
