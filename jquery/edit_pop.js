$(document).ready(function(){
	$(".custom").click(function(){
		$(".edit").show();
		return false;
	});
	$(".cancel").click(function(){
		$(".edit").hide();
		return false;
	});
});
