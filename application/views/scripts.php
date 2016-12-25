<?php

echo '<script type="text/javascript">
$(document).ready( function() {
	$("div").click(function(event) {
		event.stopPropagation();
	});
	adjustElem();
	$(window).bind("resize", adjustElem);
	$(".fadeIn").fadeIn(1500);
	setFocus();
});
var adjustElem = function() {
	var mHeight = $(window).height();
	$(".rowC").css("height", (mHeight - 250) + "px");
};
$(window).load( function() {
	$("#backdrop").fadeIn(4000);
});
</script>';

// EoF !
