(function ($) {
  "use strict"; //You will be happier

  $.fn.horizBarChart = function( options ) {

    var settings = $.extend({
      // default settings
      selector: '.bar',
      speed: 3000
    }, options);

    // Cycle through all charts on page
	  return this.each(function(){
	    // Start highest number variable as 0
	    // Nowhere to go but up!
  	  var highestNumber = 0;

      // Set highest number and use that as 100%
      // This will always make sure the graph is a decent size and all numbers are relative to each other
    	$(this).find($(settings.selector)).each(function() {
    	  var num = $(this).data('number');
        if (num > highestNumber) {
          highestNumber = num;
        }
    	});

      // Time to set the widths
      var bar_num = 0;
    	$(this).find($(settings.selector)).each(function() {
    		var bar = $(this),
    		    // get all the numbers
    		    num = bar.data('number'),
    		    // math to convert numbers to percentage and round to closest number (no decimal)
            //if(bar_num % 2 != 0)
    		      percentage = Math.round((num / highestNumber) * 100) + '%';
            if(bar_num%2==1)
            {
              percentage=Math.round((num/6)*100)+'%';
            }
           
            bar_num = bar_num + 1;
    		// Time to assign and animate the bar widths
    		$(this).animate({ 'width' : percentage }, settings.speed);
    		$(this).next('.number').animate({ 'left' : percentage }, settings.speed);
    	});
	  });

  }; // horizChart

}(jQuery));