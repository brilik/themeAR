$(window).on('load', function () {
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
		$('.icon-load__line-progress').addClass('active');
		$('body').addClass('ios');
	} else {
		$('.icon-load__line-progress').addClass('active');
		$('body').addClass('web');
	};
	setTimeout(function() {
        $('body').removeClass('loaded');
        
        //Wow
        if ($('.wow').length) {
            wow = new WOW({
                animateClass: 'animated', // default
                offset: 30, // default
                mobile: false, // default
                live: true // default
            })
            wow.init()
        };
        
    }, 1000);	

});

function initMap() {
	if ($('#map').length) {
		var latlng = new google.maps.LatLng(55.7341571, 37.6689197);
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 13,
			center: latlng,
			elementType: "geometry",
			styles: [
				{
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#f5f5f5"
      }
    ]
  },
				{
					"elementType": "labels.icon",
					"stylers": [
						{
							"visibility": "off"
      }
    ]
  },
				{
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#616161"
      }
    ]
  },
				{
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"color": "#f5f5f5"
      }
    ]
  },
				{
					"featureType": "administrative.land_parcel",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#bdbdbd"
      }
    ]
  },
				{
					"featureType": "administrative.neighborhood",
					"stylers": [
						{
							"visibility": "off"
      }
    ]
  },
				{
					"featureType": "poi",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#eeeeee"
      }
    ]
  },
				{
					"featureType": "poi",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#757575"
      }
    ]
  },
				{
					"featureType": "poi.attraction",
					"stylers": [
						{
							"visibility": "on"
      }
    ]
  },
				{
					"featureType": "poi.attraction",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#13b5b3"
      }
    ]
  },
				{
					"featureType": "poi.attraction",
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"visibility": "off"
      }
    ]
  },
				{
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#e5e5e5"
      }
    ]
  },
				{
					"featureType": "poi.park",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#bbeeb7"
      }
    ]
  },
				{
					"featureType": "poi.park",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#579728"
      },
						{
							"visibility": "on"
      }
    ]
  },
				{
					"featureType": "poi.park",
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"color": "#f2fff2"
      },
						{
							"visibility": "on"
      }
    ]
  },
				{
					"featureType": "poi.place_of_worship",
					"stylers": [
						{
							"visibility": "off"
      }
    ]
  },
				{
					"featureType": "road",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#ffffff"
      }
    ]
  },
				{
					"featureType": "road.arterial",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#bcbcbc"
      }
    ]
  },
				{
					"featureType": "road.arterial",
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"visibility": "off"
      }
    ]
  },
				{
					"featureType": "road.highway",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#fff"
      }
    ]
  },
				{
					"featureType": "road.highway",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#616161"
      }
    ]
  },
				{
					"featureType": "road.local",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#9e9e9e"
      }
    ]
  },
				{
					"featureType": "transit.line",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#e5e5e5"
      }
    ]
  },
				{
					"featureType": "transit.station",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#eeeeee"
      }
    ]
  },
				{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#c9c9c9"
      }
    ]
  },
				{
					"featureType": "water",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#ffccff"
      },
						{
							"visibility": "on"
      }
    ]
  },
				{
					"featureType": "water",
					"elementType": "labels.text",
					"stylers": [
						{
							"visibility": "off"
      }
    ]
  },
				{
					"featureType": "water",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#9e9e9e"
      }
    ]
  }
]
		});
	}
};

/* viewport width */
function viewport() {
	var e = window,
		a = 'inner';
	if (!('innerWidth' in window)) {
		a = 'client';
		e = document.documentElement || document.body;
	}
	return {
		width: e[a + 'Width'],
		height: e[a + 'Height']
	}
};
/* viewport width */

$(function () {
    
    //Autocomplete
	if ($('#js-town').length) {
        var availableTags = [
            "Бабаевская улица",
            "Бабьегородский 1-й",
            "переулок Бабьегородский 2-й",
            "переулок Багрицкого",
            "улица Баженова",
            "улица Бажова",
            "улица Базовая"
        ];
        $('#js-town').autocomplete({
            source: availableTags
        });
    };
	//Header menu
	$('.js-header-btn').toggle(function () {
		$(this).addClass('active');
		$('.box-header').addClass('active');
		$('.header-menu').addClass('active item-slide');
        $('.form-search').removeClass('active');
		if ($('.box-header').hasClass('light') && $('.header-menu').hasClass('active')) {
			$('.js-header-btn').addClass('light');
		}

		if ($(document).height() > $(window).height()) {
			var scrollTop = ($('html').scrollTop()) ? $('html').scrollTop() : $('body').scrollTop();
			$('html').addClass('no-scroll').css('top', -scrollTop);
		}
		return false;
	}, function () {
		$(this).removeClass('active');
		$('.box-header').removeClass('active');
		$('.header-menu').removeClass('active');

		if ($('.box-header').hasClass('light') && $('.header-menu').not('active')) {
			$('.js-header-btn').removeClass('light');
		}

		var scrollTop = parseInt($('html').css('top'));
		$('html').removeClass('no-scroll');
		$('html, body').scrollTop(-scrollTop);
		return false;
	});

	//Tabs
	$('.tabs li a').click(function () {
		$(this).closest('.tab-wrap').find('.tab-cont').addClass('hide');
		$(this).parent().siblings().removeClass('active');
		var id = $(this).attr('href');
		$(this).closest('.tab-wrap').find(id).removeClass('hide');
		$(this).parent().addClass('active');

		$('.slick-slider').slick('refresh');
        $('.wow').addClass('destroy');
		return false;
	});

	$('.tabs-default li a').click(function () {
		$(this).closest('.tab-wrap').find('.tab-cont').addClass('hide');
		$(this).parent().siblings().removeClass('active');
		var id = $(this).attr('href');
		$(this).closest('.tab-wrap').find(id).removeClass('hide');
		$(this).parent().addClass('active');
		return false;
	});

    //Tabs in order page
    $('.form-filter-delivery__radio-label').click(function () {
		$('.tab-wrap').find('.tab-cont').addClass('hide');
		$('.form-filter-delivery__radio-label').removeClass('active');
		var id = $(this).data('id');
		$('.tab-wrap').find(id).removeClass('hide');
		$(this).addClass('active');

        $('.wow').addClass('destroy');
		return false;
	});
    
	//Focus input
	$('.backcall-form__input, .backcall-form__textarea, .form-submit__input').focusin(function () {
		$(this).parent().addClass('focus');
	});
	$('.backcall-form__input, .backcall-form__textarea, .form-submit__input').focusin(function () {
		$(this).parent().addClass('focus');
	});
	$('.backcall-form__input, .backcall-form__textarea, .form-submit__input').focusout(function () {
		$(this).parent().removeClass('focus');
	});

	//Form search
	$('.js-form-search').click(function () {
		$('.form-search').toggleClass('active');
		setTimeout(function () {
			$('.form-submit__input').trigger('focus');
		}, 500);
	});
	$(document).on('touchstart click', function (e) {
		if ($(e.target).parents().filter('.form-search:visible').length != 1) {
			$('.form-search:visible').removeClass('active');
		}
	});

	//Select 
	$('.form-filter__select-top').on('click', function(e) {
		$(this).parent().toggleClass('active');
		$that = $(this);
        
		$('.select-list__item').on('click', function(e) {
			$(this).siblings().removeClass('active');
			$(this).addClass('active');
			$val = $(this).html();
			$(this).closest('.form-filter__select').find('.form-filter__select-title').html($val);
			$(this).closest('.form-filter__select').removeClass('active');

			return false;
		});
        
        $(document).on('touchstart click', function(e) {
            $cont = $that;
            if (!$cont.is(e.target) && $cont.has(e.target).length === 0) {
                $('.form-filter__select').removeClass('active');
            }
        });
	});	

    //Constructor slide
    $('.js-catalog-slide').click(function() {
        $('.constructor-info-slide, .constructor-slider-mask, .catalog-slider').toggleClass('active');
    });
    
    $('.constructor-info-slide__close, .constructor-slider-mask').click(function() {
        $('.constructor-info-slide, .constructor-slider-mask, .catalog-slider').removeClass('active');
    });
    
	//Catalog slide 
	$('.js-catalog-icon').click(function () {
		$('.catalog').addClass('active');
        $('.constructor-slider-mask, .constructor-info-slide, .catalog-slider').removeClass('active');
	});
    $('.js-catalog-toogle').click(function () {
		$('.catalog').toggleClass('active');
        $('.constructor-slider-mask, .constructor-info-slide, .catalog-slider').removeClass('active');
	});
	
	$('.place-list__item').click(function () {
		$('.catalog').addClass('active');
        $('.constructor-slider-mask, .constructor-info-slide, .catalog-slider').removeClass('active');
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
	});

	//Filter 
	$('.filter-list__item').click(function () {
		$('.filter-list__item').removeClass('active');
		$(this).addClass('active');
	});

	//Add to favorites
	$('.catalog-goods-list__heart').click(function () {
		$(this).toggleClass('active');
	});

	//Filter accord 
	$('.js-form-accord-top').click(function () {
		$(this).parent().toggleClass('active');
		$(this).next().slideToggle(400);
	});

	$('.js-accord-show').click(function () {
		$(this).toggleClass('active');
		$(this).prev().toggleClass('active');
	});

	//Select in products
	$('.js-catalog-filter-top').click(function () {
		$(this).parent().toggleClass('active');
	    $that = $(this);	
        
		$('.goods-filter-list__item').click(function () {
			$(this).siblings().removeClass('active');
			$(this).addClass('active');
			$val = $(this).text();
			$(this).closest('.catalog-filter__wrap').find('.catalog-filter__top-type').text($val);
			$(this).closest('.catalog-filter__wrap').removeClass('active');
						
			return false;
		});
        
        $(document).on('touchstart click', function(e) {
            $cont = $that;
            if (!$cont.is(e.target) && $cont.has(e.target).length === 0) {
                $('.catalog-filter__wrap').removeClass('active');
            }
        });
	});
    
    //Reset filter
    $('.js-filter-reset').click(function() {
        $('.form-filter *').removeAttr('checked');
    });

	//More in vacancy
	$('.vacancy-list__more').click(function () {
		$(this).toggleClass('active')
			   .prev('.vacancy-list__desc').toggleClass('active');
	});

	$('.pagination-list__item').click(function () {
		$('.pagination-list__item').removeClass('active');
		$(this).addClass('active');
		return false;
	});

	//Remove item in favorites
	$('.js-goods-item-remove').click(function () {
		$(this).closest('.catalog-goods-list__item').remove();
	});

	//Question page slide
	$('.js-questions-row').click(function () {
		$(this).toggleClass('active');
		$(this).next().slideToggle(400);
	});

	//Question page more info
	$('.js-answers-more').click(function() {
		$(this).toggleClass('active');
		$(this).parent().prev().toggleClass('active');
	});

	//Question page tabs
	$('.questions-list__link').click(function () {
		$(this).parents('.box-questions__wrap').find('.tab-cont').addClass('hide');
		$('.questions-list__item').removeClass('active');
		var id = $(this).attr('href');
		$(id).removeClass('hide');
		$(this).parent().addClass('active');
		return false;
	});
    
    //Order page quantity
    $('.product-table__quantity-increase').click(function () {
        $value = $(this).parent().find('.product-table__quantity-value').text();
        $value++;
        $(this).parent().find('.product-table__quantity-value').text($value);
    });

    $('.product-table__quantity-reduce').click(function () {
        $value = $(this).parent().find('.product-table__quantity-value').text();
        if ($value > 1) {
            $value--;
        }
        $(this).parent().find('.product-table__quantity-value').text($value);
    });
    
    //Order page quantity
    $('.js-constructor-info-header').click(function() {
        $(this).toggleClass('active');
        $(this).next().slideToggle('400');
    });
    
    //Cabinet remove    
    $('.js-current-order-remove').click(function() {
        $(this).closest('.current-order__row').remove();
    });
    
    $('.js-catalog-goods-heart').click(function() {
        $(this).closest('.current-order__row').remove();
    });
    
    //Cabinet remove
    $('.current-order-clear').click(function() {
        $('.current-order__row').remove();
    });
    
    //Cabinet check all
    $('.js-mailing-checkbox-all').click(function() {
        $('.cabinet-mailing-checkbox input').attr('checked', true);
    });
    
    //Cabinet address edit
    $('.js-cabinet-address-edit').click(function() {
        $(this).toggleClass('active');
        
        if ($(this).hasClass('active')) {
            $(this).closest('.cabinet-address__card').find('input').removeAttr('disabled');
        } else {
            $(this).closest('.cabinet-address__card').find('input').attr('disabled', true);
        }        
    });
    
    //Cabinet address remove
    $('.js-cabinet-address-remove').click(function() {
        $(this).closest('.cabinet-address__card-wrap').remove();
    });
    
    //Cabinet discount edit
    $('.js-cabinet-discount-edit').click(function() {
        $(this).toggleClass('active');
        
        if ($(this).hasClass('active')) {
            $(this).closest('.cabinet-discount__card').find('input').removeAttr('disabled');
        } else {
            $(this).closest('.cabinet-discount__card').find('input').attr('disabled', true);
        }        
    });
    
    //Cabinet discount remove
    $('.js-cabinet-discount-remove').click(function() {
        $(this).closest('.cabinet-discount__card-wrap').remove();
    });

    $(".js-check").toggle(function() {
        $(this).parents('form').find('.js-submit').prop("disabled", false);
        $(this).parents('form').find('.btn').removeClass('disabled');
        $(this).addClass('checked');
    }, function() {
        $(this).parents('form').find('.js-submit').prop("disabled", true);
       	$(this).parents('form').find('.btn').addClass('disabled');
        $(this).removeClass('checked');
    });
    
    //Cabinet quiz remove
    $('.js-complete-order-link-remove').click(function() {
        $(this).closest('.complete-order-table__row').remove();
        return false;
    });
    
    //Visible password
    $('.js-backcall-form-visible').click(function() {
        $(this).toggleClass('active');
        var type = $(this).prev().attr('type') == "text" ? "password" : 'text';
        $(this).prev().prop('type', type);
    });
    
    //Popup close 
    $('.popup__btn:not(.js-fancybox)').click(function() {
        $.fancybox.close();
        return false; 
    });
    
    //Change active class
    $('.js-apartment-check li a').click(function() {
		$(this).parent().siblings().removeClass('active');
		$(this).parent().addClass('active');
		$('.apartment-layouts').removeClass('list-disabled');
		return false;
    });
    
    //Change active class
    $('.js-eye-list li a').click(function() {
		$(this).parent().siblings().removeClass('active');
		$(this).parent().addClass('active');
		return false;
    });
    
    //Choose apartment
    $('.choose-apartment .form-control').keyup(function() {
        var messageLenght = $('.choose-apartment .form-control').val().length;
        var hasClass = $('.js-apartment-check li').hasClass('active');
        if (messageLenght >= 1) {        	
            $('.apartment-layouts').removeClass('list-disabled');
        } 
        if (messageLenght < 1 && !hasClass) {        	
            $('.apartment-layouts').addClass('list-disabled');
        }         
    });

    //More apartment
    $('.js-more-apartment').click(function() {
		$('.apartment-layouts__item ').removeClass('hidden-item');
		$(this).hide();
		return false;
    });
    
    
	//COMPONENTS

    //Scroll to id
    $('.questions-list__link').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top - 85;
        $('body,html').animate({
            scrollTop: top
        }, 1000);
    });
    
    $('.box-design-option .nav-tab-list__link').click(function(e) {
    	var target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top - 170 
        }, 1500); 
        return false;
    });
     
	//Rating
	if ($('.js-rating').length) {
		$('.js-rating').barrating({
			theme: 'fontawesome-stars',
			readonly: false
		});
	};

	if ($('.js-rating_select').length) {
		$('.js-rating_select').barrating({
			theme: 'fontawesome-stars'
		});
	};

	//Fancybox
	if ($('.js-fancybox').length) {
		$('.js-fancybox').fancybox({
			openEffect: 'fade',
			closeEffect: 'fade',
			padding: 0,
			margin: 15,
			fitToView: true,
			beforeShow: function () {
				$('body').css({
					'overflow-y': 'hidden'
				});
				$('html').css({
					'overflow-y': 'hidden'
				});
			},
			afterClose: function () {
				$('body').css({
					'overflow-y': 'visible'
				});
				$('html').css({
					'overflow-y': 'visible'
				});
			}
		});
	};

    //Custom scroll
    if ($('.js-scroll').length) {
        $('.js-scroll').mCustomScrollbar({
            axis: 'x',
            theme: 'dark-thin',
            autoExpandScrollbar: true
        });
    };
    
	//Datepicker
	if ($('.js-datapicker').length) {
		var disabledDays = [0, 6],
			datePicker = $('.js-datapicker'),
			cell = $('.datepicker--cell.-selected-'),
			dateField = $('.data-pick-date');

		datePicker.datepicker({
			showOtherMonths: true,
			showOtherYears: false,
			timepicker: false,
			position: 'bottom left',
			onRenderCell: function (date, cellType) {
				if (cellType == 'day') {
					var day = date.getDay(),
						isDisabled = disabledDays.indexOf(day) != -1;

					return {
						disabled: isDisabled
					}
				}
			},
			onHide: function (inst) {
				inst.update('position', 'bottom left');
			},
			onShow: function (inst, animationComplete) {
				if ($(window).width() <= 568) {
					inst.update('position', 'bottom left');
				} else {
					inst.update('position', 'bottom left');
				}
			},
			onSelect: function (fd, date) {
				var selected = cell.attr('data-date'),
					day = date.getDate(),
					month = date.getMonth() + 1;


				if (day < 10 && day > 0) {
					day = '0' + day;
				}
				if (month < 10 && month > 0) {
					month = '0' + month;
				}

				var selectedDate = day + '/' + month;

				dateField.text(selectedDate);
			},
		});
	}
    
	if ($('.js-main-slider').length) {

		//Progress bar
		$('.js-main-slider').on('init', function (event, slick, currentSlide, nextSlide) {
			$('.js-slider-progress-line').addClass('active');
		});
		$('.js-main-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
			$('.js-slider-progress-line').removeClass('active');
		});
		$('.js-main-slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
			$('.js-slider-progress-line').addClass('active');
		});

		$('.js-main-slider').slick({
			dots: false,
			arrows: false,
			speed: 700,
			fade: true,
			autoplay: true,
			autoplaySpeed: 5000,
			pauseOnFocus: false,
			pauseOnHover: false
		});

		//Custom click
		$('.main-slider-pagination .slick-prev').click(function () {
			$('.js-main-slider').slick('slickPrev');
		});
		$('.main-slider-pagination .slick-next').click(function () {
			$('.js-main-slider').slick('slickNext');
		});

	};

	if ($('.js-design-slider').length) {
		$('.js-design-slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.js-design-slider-nav'
		});

		$('.js-design-slider-nav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.js-design-slider',
			dots: false,
			arrows: true,
			focusOnSelect: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			responsive: [
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				}
			]
		});
	};

	if ($('.js-feedback-slider').length) {
		$('.js-feedback-slider').slick({
			dots: false,
			infinite: true,
			speed: 400,
			slidesToShow: 3,
			slidesToScroll: 1,
			focusOnSelect: true,
			swipeToSlide: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			responsive: [
				{
					breakpoint: 930,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 590,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	};

	if ($('.js-constructor-slider').length) {
		$('.js-constructor-slider').slick({
			dots: true,
			fade: true,
			infinite: false,
			speed: 400,
			slidesToShow: 1,
			slidesToScroll: 1,
			swipe: false,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>'
		});
	};

	if ($('.js-catalog-slider').length) {
		$('.js-catalog-slider').slick({
			dots: false,
			infinite: false,
			speed: 400,
			slidesToShow: 9,
			slidesToScroll: 1,
			focusOnSelect: true,
			swipeToSlide: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 8,
					}
				},
				{
					breakpoint: 1100,
					settings: {
						slidesToShow: 7,
					}
				},
				{
					breakpoint: 1023,
					settings: {
						slidesToShow: 8,
					}
				},
				{
					breakpoint: 900,
					settings: {
						slidesToShow: 7,
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 6,
					}
				},
				{
					breakpoint: 700,
					settings: {
						slidesToShow: 5,
					}
				}
			]
		});
	};

	if ($('.js-style-slider').length) {
		$('.js-style-slider').slick({
			dots: false,
			infinite: true,
			speed: 400,
			slidesToShow: 3,
			slidesToScroll: 1,
			focusOnSelect: true,
			swipeToSlide: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 2,
					}
				}
			]
		});
	};

	if ($('.js-interior-slider').length) {
		$('.js-interior-slider').slick({
			dots: false,
			speed: 400,
			fade: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>'
		});
	};

	if ($('.js-material-slider').length) {
		$('.js-material-slider').slick({
			dots: false,
			speed: 400,
			slidesToShow: 3,
			slidesToScroll: 1,
			focusOnSelect: true,
			swipeToSlide: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			responsive: [
				{
					breakpoint: 950,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 400,
					settings: {
						slidesToShow: 1,
					}
				}
			]
		});
	};

	if ($('.js-design-board-slider').length) {
		$('.js-design-board-slider').slick({
			dots: false,
			speed: 400,
			slidesToShow: 5,
			slidesToScroll: 1,
			focusOnSelect: true,
			swipeToSlide: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			responsive: [
				{
					breakpoint: 1100,
					settings: {
						slidesToShow: 4,
					}
				},
				{
					breakpoint: 820,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 620,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 420,
					settings: {
						slidesToShow: 1,
					}
				}
			]
		});
	};

	if ($('.js-design-option-slider').length) {
		$('.js-design-option-slider').slick({
			dots: false,
			speed: 400,
			fade: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>'
		});
	};

	if ($('.js-product-slider').length) {
		$('.js-product-slider').slick({
			dots: false,
			arrows: false,
			speed: 700,
			fade: true,
			autoplay: true,
			autoplaySpeed: 5000,
			pauseOnFocus: false,
			pauseOnHover: false
		});

		//Custom click
		$('.main-slider-pagination .slick-prev').click(function () {
			$('.js-product-slider').slick('slickPrev');
		});
		$('.main-slider-pagination .slick-next').click(function () {
			$('.js-product-slider').slick('slickNext');
		});
	};

	if ($('.js-card-slider').length) {
		$('.js-card-slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			asNavFor: '.js-card-slider-nav'
		});

		$('.js-card-slider-nav').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			asNavFor: '.js-card-slider',
			focusOnSelect: true,
			arrows: false,
			responsive: [
				{
					breakpoint: 1250,
					settings: {
						slidesToShow: 4,
					}
				},
				{
					breakpoint: 900,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 5,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 4,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 3,
					}
				}
			]
		});
	};

	if ($('.js-favorites-slider').length) {
		$('.js-favorites-slider').slick({
			dots: false,
			speed: 400,
			fade: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>'
		});
	};

	if ($('.js-choose-design-slider').length) {
		$('.js-choose-design-slider').slick({
			dots: false,
			speed: 400,
			slidesToShow: 4,
			slidesToScroll: 1,
			focusOnSelect: true,
			swipeToSlide: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon-arrow-prev"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon-arrow-next"></i></button>',
			responsive: [
				{
					breakpoint: 1023,
					settings: {
						slidesToShow: 4,
					}
				},
				{
					breakpoint: 820,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 620,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 420,
					settings: {
						slidesToShow: 1,
					}
				}
			]
		});
	};

	if ($('#js-price-range')) {
		$('#js-price-range').slider({
			range: true,
			min: 9900,
			max: 39990,
			values: [9900, 39990],
			slide: function (event, ui) {
				$('#price-min').val(ui.values[0]);
				$('#price-max').val(ui.values[1]);
			}
		});

		$("#price-min").change(function () {
			$("#js-price-range").slider('values', 0, $(this).val());
		});
		$("#price-max").change(function () {
			$("#js-price-range").slider('values', 1, $(this).val());
		});
	};

	

	/* components */

});

var handler = function () {

	var viewport_wid = viewport().width;
	var viewport_height = viewport().height;

	$('.box-header').addClass('visible');

	if (viewport_wid >= 1024) {
		$('.box-main').height(viewport_height);
	}

	if (viewport_wid < 1024) {
		$('.js-form-accord-top').parent().removeClass('active')
			.end().next().slideUp(400);
	}
	//Fixed header 
	if ($('.box-main').length) {

		var offset_this = $('.box-main').height();

		var scr_top = $(window).scrollTop();
		if (offset_this <= scr_top) {
			$('.box-header').addClass("light");
		} else {
			$('.box-header').removeClass("light")
		}

		$(window).scroll(function () {
			var scr_top = $(window).scrollTop();
			if (offset_this <= scr_top) {
				$('.box-header').addClass("light");
			} else {
				$('.box-header').removeClass("light")
			}
		});
	};
    
}

$(window).bind('load', handler);
$(window).bind('resize', handler);