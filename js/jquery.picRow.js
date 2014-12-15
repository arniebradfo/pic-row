// remap jQuery to $
(function($){

function picRow(selector){

	$(selector).each(function(){

		// get "selector" css px value for margin-bottom 
		// - parse out a floating point number 
		// - and divide by the outer width to get a decimal percentage
		var margin = (parseFloat($(this).css("margin-bottom"), 10))/($(this).outerWidth());
		// subtract subtract the total child margin from the total width to find the usable width
		var usableWidth = (1 - ((($(this).children("picture").length) - 1) * margin));


		// define and clear global ratio array
		var ratios = [];
		ratios.length = 0;
		var ratioSum = 0;
		// for each "selector" > picture > img - set width/height as one addition to the ratios array
		$(this).find("img").each(function(){
			ratios.push(($(this).width())/($(this).height()));
		});
		// sum all the ratios for later divison
		$.each(ratios,function(){
			ratioSum+=parseFloat(this) || 0;
		});
		$(this).children("picture").each(function(i){
			$(this).css({
				// divide each item in the ratios arry by the total array
				// as set that as the css width in percentage
				"width": ((ratios[i]/ratioSum) * usableWidth)*100 +"%",
				// set the margin-right equal to the parent margin-bottom
				"margin-right": margin*100 +"%",
			});
		});
		// set css of parent > picture:last-child to "margin-right":"0%"
		$(this).children(":last-child").css({
			"margin-right":"0%",
		});
	});
}

$(document).ready(function(){
	picRow(".pic-row");
});
$(window).load(function(){
	picRow(".pic-row");
});

})(window.jQuery);