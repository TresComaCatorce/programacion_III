$(document).ready(function()
{
	setInterval(function()
	{
		var text = $('.text');
		
		if( text.hasClass('hidden') )
		{
			text.removeClass("hidden");
		}
		else
		{
			text.addClass("hidden");
		}
	}, 3000);
	
	var myMenu = $('#menu nav');
	
	var distance = myMenu.offset().top, $window = $(window);

	$window.scroll(function()
	{
		console.log(distance);
		console.log($window.scrollTop());
		
		if ( $window.scrollTop() > distance )
		{
			$('#menu').addClass('sticky');
		}
		else
		{
			$('#menu').removeClass('sticky');
		}
	});
});