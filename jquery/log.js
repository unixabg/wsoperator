$(document).ready(function() {
	$('.log_link').click(function() {
		$('.backlight').show();
		var link = $(this).attr('href');
		$("#content_pop").load(link);
		return false;
	});
	$('.exit').click(function() {
		$('.backlight').hide();
	});
	$('.backlight').click(function() {
		$(this).hide();
	});
});
