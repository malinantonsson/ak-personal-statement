(function(){
	"use strict";

	var $ = window.jQuery;

	var startslide = 0;

	$('.personal-carousel').slick({
	  	slidesToShow: 1,
	  	initialSlide: startslide,
	  	slidesToScroll: 1,
	  	arrows: false,
	  	autoplay: true,
	  	autoplaySpeed: 3000
	});
})();