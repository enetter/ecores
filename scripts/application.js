$(function(){
		$('#top_carousel').carousel();
		$('.dropdown-toggle').dropdown();
		$('div[rel=popover]').popover();
		$('#multi-page-post').bind('change', function() {
			var url = $(this).val();
			if (url) {
				window.location = url;
			}
			return false;	
		});
	});