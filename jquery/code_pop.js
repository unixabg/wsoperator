$(document).ready(function() {
	$(".a_code").click(function() {
		var row = $(this).attr("rowid");
		$(".backlight[rowid='" + row + "']").show();
	});
	$(".backlight").click(function() {
		$(this).hide();
	});
	// edit form pop up
	$(".edit_button").click(function() {
		var row = $(this).attr("rowid");
		$(".edit[rowid='" + row + "']").show();
		return false;
	});
	$(".cancel").click(function() {
		$(".edit").hide();
	});
});
