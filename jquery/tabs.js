$(document).ready(function() {
	var tab = $('.test').attr("tabIndex");
	$('.admin_a').click(function() {
		var $this = $(this);
		//hide tabs
		$(".tabs").hide();
		var tab = $this.attr("href");
		// show page
		$(tab).show();
		return false;
	}); // end click
	$(".admin_li:nth-child("+tab+") .admin_a").click();
	$("#status_green, #status_red").show().delay(3000).queue(function(n) {
		$(this).fadeOut(); n();
	});
});
