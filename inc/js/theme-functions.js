/* ------------------------------------------------------------------------ */
/* Javascripts
/* ------------------------------------------------------------------------ */

(function($) {

    $(document).ready(function() {
        "use strict";

            // Home Slider
            $('.home-slider-image').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                centerMode: true,
                dots: true,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                appendDots: $('.dots'),
            });

            // Single Product Slider
            $('.single-product-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                appendDots: $('.dots'),
                responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                        settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 480,
                        settings: {
                        slidesToShow: 1,
                    }
                },
                                {
                breakpoint: 360,
                        settings: {
                        slidesToShow: 1,
                    }
                }
                ]
            });

            // Contributor Product Slider
            $('.contributor-product-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                appendDots: $('.dots'),
                responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                        settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 480,
                        settings: {
                        slidesToShow: 2,
                    }
                }
                ]
            });

            // Wrap Element
            $('.product-preview-slide .elementor-swiper-button, .product-preview-slide .swiper-pagination').wrapAll('<div class="drizy-swipper-pagination"></div>');
            $('.woocommerce .woocommerce-notices-wrapper .button').wrapInner('<span></span>');

            // Rearenge Element Swipper
            $(".product-preview-slide .swiper-pagination").insertBefore(".product-preview-slide .elementor-swiper-button-next");

            // Product Cat Image Slider
            // $('.product-cat-image-slide').slick({
            //     slidesToShow: 3,
            //     slidesToScroll: 1,
            //     autoplay: false,
            //     autoplaySpeed: 2000,
            //     arrows: false,
            // });


            // Show and Hide Image Preview Product Cat
            $(".show-hide-image #switch").click(function () {
                if ($(this).is(":checked")) {
                    $(".product-archive-container .product").addClass("thumbs");
                    $(".product-archive-container .product-cat-image-slide-inner").slideToggle();
                } else {
                    $(".product-archive-container .product").removeClass("thumbs");
                    $(".product-archive-container .product-cat-image-slide-inner").slideToggle();
                }
            });

            // Add class to filter select product cat
            $('<div class="jet-filter-icon"></div>').prependTo('.product-cat-filter .jet-filter-items-dropdown');


            // Add class to load more button
            //$('.product-pagination .facetwp-facet-loadmore').addClass("button-effect"); 
            //$('.product-pagination .facetwp-facet-loadmore button').wrapAll('<span></span>');

            // Nice Select
            jQuery(document).ready(function (e) {
                e(".drizy-custom-select, .facetwp-facet-cat select, .facetwp-facet-blog_categories select").niceSelect(),
                e(".multiselect").niceSelect("destroy");
            });

            // Rent Option - Services Page
            var selected = null;
            $(".hero-container .gallery-wrap .item").hover(
                function() {
                    selected = $('.hero-container .gallery-wrap .item.active').removeClass('active');
                    $(this).addClass('active');
                },
                function() {
                    $(".hero-container .gallery-wrap .item").removeClass('active');
                    selected.addClass('active');
                }
            );

            // Single Product Content Tabs
            // Show the first tab and hide the rest
            $('#single-tabs-nav li:first-child').addClass('active');
            $('.single-tab-content').hide();
            $('.single-tab-content:first').show();

            // Click function
            $('#single-tabs-nav li').click(function(){
                $('#single-tabs-nav li').removeClass('active');
                $(this).addClass('active');
                $('.single-tab-content').hide();

                var activeTab = $(this).find('a').attr('href');
                $(activeTab).fadeIn();
                return false;
            });


            // Buying Options Tabs
            //When page loads...
            $(".buying-options-tab-content").hide(); //Hide all content
            $("ul.buying-options-tabs li:first").addClass("active").show(); //Activate first tab
            $(".buying-options-tab-content:first").show(); //Show first tab content

            //On Click Event
            $("ul.buying-options-tabs li").click(function() {
                $("ul.buying-options-tabs li").removeClass("active"); //Remove any "active" class
                $(this).addClass("active"); //Add "active" class to selected tab
                $(".buying-options-tab-content").hide(); //Hide all tab content

                var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                $(activeTab).show(); //Fade in the active ID content
                return false;
            });

            $(".tab-content-vertical").hide(); //Hide all content
            $("ul.buying-options-tabs-vertical li:first").addClass("active").show(); //Activate first tab
            $(".tab-content-vertical:first").show(); //Show first tab content

            //On Click Event
            $("ul.buying-options-tabs-vertical li").click(function() {
                $("ul.buying-options-tabs-vertical li").removeClass("active"); //Remove any "active" class
                $(this).addClass("active"); //Add "active" class to selected tab
                $(".tab-content-vertical").hide(); //Hide all tab content

                var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                $(activeTab).show(); //Fade in the active ID content
                return false;
            });

            $('.license-wrapper .lisence-list-wrapper').find('.lisence-list').click(function(){
            
            //Expand or collapse this panel
            var isActive = $(this).hasClass("active");
            $('.lisence-list').removeClass('active')
            if (!isActive) {
            $(this).toggleClass('active');
            }

            $(this).next().slideToggle('fast');     
            //Hide the other panels
            $(".lisence-list-description").not($(this).next()).slideUp('fast');

            });

            // Buying Options
            $('a.buying-options').click(function(){
                $('html, body').animate({
                    scrollTop: $( $(this).attr('href') ).offset().top
                }, 500);
                return false;
            });

            // Rolling Text
            let elements = document.querySelectorAll(".rolling-text");

            elements.forEach((element) => {
                let innerText = element.innerText;
                element.innerHTML = "";

                let textContainer = document.createElement("div");
                textContainer.classList.add("block");

                for (let letter of innerText) {
                let span = document.createElement("span");
                span.innerText = letter.trim() === "" ? "\xa0" : letter;
                span.classList.add("letter");
                textContainer.appendChild(span);
                }

                element.appendChild(textContainer);
                element.appendChild(textContainer.cloneNode(true));
            });

            // for presentation purpose
            setTimeout(() => {
                elements.forEach((element) => {
                    element.classList.remove("play");
                });
            }, 600);

            elements.forEach((element) => {
                element.addEventListener("mouseover", () => {
                    element.classList.add("play");
                    element.classList.remove("play");
                });
            });

            // Show hide Glyph base on Selected Option
            var $textpreview = jQuery('#glyph-font-style');
            $textpreview.on('change', e => {
              $('.font-glyphs-list').hide().filter('.' + e.target.value).show();
            });

            // Show & hide product tags & purpose
            // Tags
            $(".product-archive-header .product-filter .product-tags").click(function(e) {
                e.stopPropagation();
                if($(this).hasClass("show")) {
                  $(this).removeClass("show");
                } else {
                    $(".product-archive-header .product-filter .product-purpose").removeClass("show"); 
                    $(".product-archive-header .product-filter .product-tags").removeClass("show");
                    $(this).addClass("show");
                }
            });
            $(document).on('click', function (e) {
                e.stopPropagation();
                $('.product-archive-header .product-filter .product-tags').removeClass("show");
            });

            // Purpose
            $(".product-archive-header .product-filter .product-purpose").click(function(e) {
                e.stopPropagation();
                if($(this).hasClass("show")) {
                  $(this).removeClass("show");
                } else {
                    $(".product-archive-header .product-filter .product-tags").removeClass("show");
                    $(".product-archive-header .product-filter .product-purpose").removeClass("show");
                    $(this).addClass("show");
                }
            });
            $(document).on('click', function (e) {
                e.stopPropagation();
                $('.product-archive-header .product-filter .product-purpose').removeClass("show");
            });


            // Font Size Slider Category Page
            $(".product-archive-header .product-toogle-font-size #cat-text-size").on("input",function () {
                $('.product-archive-container .product-cat-font-preview .font-preview-list').css("font-size", $(this).val() + "px");
            });

    		//change text preview
    		$(document.body).on('change','#text-preview', function (e) {
    			let currentVal = $('#text-preview option:selected').val();
    			$('.font-preview-list').addClass('hide');
    			$('.'+currentVal).removeClass('hide');
    		})

    		//change font style
    		$(document.body).on('change','select[name="font-style"]', function (e) {
    			let currentId = $(this).data('id'),
    				currentVal = $(this).val();
    			$('#font-preview-'+ currentId).css({'font-family' : '"'+currentVal+'"'});
    		})

    		//change title sort by
    		$(document.body).on('change','#product-filter', function (e) {
    			let currentVal = $('#product-filter option:selected').val(),
    				currentTitle = 'New Releases';
    			if( currentVal == 'popular' )
    				currentTitle = 'Best Sellers';
          		$('.archive-filter-title.default').text(currentTitle);
      		})

            // Show login form if user not login
            jQuery( '.free-download-btn' ).click( function( e ) {
                e.preventDefault();
                elementorProFrontend.modules.popup.showPopup( { id: 2132 } );
            });

            // Click to show social media share
            $('.social-share-box .social-button').click(function() {

                let clicked_btn = $(this);

                //toggle the wanted social-share-list
                clicked_btn.siblings(".social-share-list").toggle();

                //hide all other .social-share-list
                clicked_btn.siblings(".social-share-list").addClass("active");
                $(".social-share-box .social-share-list:not(.active)").hide()
                $(".social-share-box .social-share-list.active").removeClass("active");

            });

            //hide all social-share-list when you click outside of a social-share-list
            $("body").click(function(event) {
                if (!event.target.closest(".social-share-list,.social-button")) {
                    $(".social-share-box .social-share-list").hide();
                }
            });


            // CHange image on swicth Custom Service
            $(".cs-customization-inner .option-variant .option-label #alternates").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.alternates").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.alternates").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-weight").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-weight").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-weight").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #condensed").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.condensed").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.condensed").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #expanded").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.expanded").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.expanded").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-serif").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-serif").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-serif").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-ligatures").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-ligatures").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-ligatures").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-contrast").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-contrast").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-contrast").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-pua").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-pua").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-pua").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-height").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-height").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-height").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-punctuation").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-punctuation").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-punctuation").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #custom-tabular").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.custom-tabular").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.custom-tabular").removeClass("active");
                }
            });

            $(".cs-customization-inner .option-variant .option-label #old-style").click(function () {
                if ($(this).is(":checked")) {
                    $(".cs-customization-inner .option-variant .option-text.old-style").addClass("active");
                } else {
                    $(".cs-customization-inner .option-variant .option-text.old-style").removeClass("active");
                }
            });


            // Element animate
            AOS.init();

    });
	
})(jQuery);