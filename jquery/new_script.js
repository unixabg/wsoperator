$(document).ready(function() {
	$(".new_script_button").click(function() {
		var form = $(this).attr("rowid");
		$("#add_script[rowid='" + form + "']").show();
		return false;
	});
	$(".cancel").click(function() {
		var form = $(this).attr("rowid");
		$("#add_script[rowid='" + form + "']").hide();
	});
});
