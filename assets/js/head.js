/**
 * Events
 */
$(document).ready(function() {
	var nav_bar = $(".navbar");
	var posic = nav_bar.offset();

	$(window).scroll(function() {
		if( $(this).scrollTop() > posic.top ) {
			$(".navbar").addClass("navbar-fixed-custom");
		} else {
			$(".navbar").removeClass("navbar-fixed-custom");
		}
	});

	$("#parallax-navbar > li > a").click(function(e){
		if( $(this).attr("data-target")!="no-parallax" ) {
			e.preventDefault();
			var which = $(this).attr("data-target");
			$("#parallax-navbar > li").removeClass("active");
			$(this).parent().addClass("active");
			$("html, body").animate({
				scrollTop: $(which).offset().top-70
			},800);
		}
	});
	
	$("#scroll-contact").click(function(e){
		e.preventDefault();
		$("a.nav-link[data-target='#contacto']").trigger("click");
	});
});

/**
 * /. Events
 */

/**
 * Functions
 */
//Ejemplo: var variable = getUrlVar("variable"); para ?variable=1 obtiene 1
function getUrlVar(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if(pair[0] == variable){return pair[1];}
  }
  return(false);
}
/**
 * /. Functions
 */