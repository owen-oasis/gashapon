(function($){
	$.fn.snow = function(options){
	var $flake = $('<div id="snowbox" class="snow"/ >').css({'position': 'absolute','z-index':'9999', 'top': '-50px'}).html('●'),
	documentHeight 	= $(document).height(),
	documentWidth	= $(document).width(),
	defaults = {
		minSize		: 10,
		maxSize		: 20,
		newOn		: 1000,
		flakeColor	: "#FFFFFF"
	},

	// 	var movementStrength = 25;
	// 	var height = movementStrength / $(document).height();
	// 	var width = movementStrength / $(document).width();
	// 	$("body").mousemove(function(e){
	// 	var pageX = e.pageX - ($(document).width() / 2);
	// 	var pageY = e.pageY - ($(document).height() / 2);
	// 	var startPositionLeft = width * pageX + 50;
	// 	var newvalueY = height * pageY + 50;
	// 	$(".snow").css('left', '+='+newvalueX+'px');
	// });


	options	= $.extend({}, defaults, options);
	var interval= setInterval( function(){
	var startPositionLeft = Math.random() * documentWidth - 100,
	startOpacity = 0.5 + Math.random(),
	sizeFlake = options.minSize + Math.random() * options.maxSize,
	endPositionTop = documentHeight - 200,
	endPositionLeft = startPositionLeft - 500 + Math.random() * 500,
	durationFall = documentHeight * 10 + Math.random() * 5000;
	$flake.clone().appendTo('body').css({
		left: startPositionLeft,
		opacity: startOpacity,
		'font-size': sizeFlake,
		color: options.flakeColor
	}).animate({
		top: endPositionTop,
		left: endPositionLeft,
		opacity: 0.2
	},durationFall,'linear',function(){
		$(this).remove()
	});
	}, options.newOn);
    };




})(jQuery);
$(function(){
    $.fn.snow({ 
	    minSize: 5,
	    maxSize: 30,
	    newOn: 200
    });


});