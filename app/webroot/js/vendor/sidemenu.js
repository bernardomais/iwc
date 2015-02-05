$(function() {
	var sidemenu = $('.sidemenu'), //menu css class
		body = $('body'),
		container = $('.page'), //container css class
		push = $('.push'), //css class to add sidemenu capability
		siteOverlay = $('.site-overlay'), //site overlay
		sidemenuClass = "sidemenu-left sidemenu-open", //menu position & menu open class
		sidemenuActiveClass = "sidemenu-active", //css class to toggle site overlay
		containerClass = "container-push", //container open class
		pushClass = "push-push", //css class to add sidemenu capability
		menuBtn = $('.menu-btn, .sidemenu a'), //css classes to toggle the menu
		menuSpeed = 200, //jQuery fallback menu speed
		menuWidth = sidemenu.width() + "px"; //jQuery fallback menu width

	function togglesidemenu(){
		body.toggleClass(sidemenuActiveClass); //toggle site overlay
		sidemenu.toggleClass(sidemenuClass);
		container.toggleClass(containerClass);
		push.toggleClass(pushClass); //css class to add sidemenu capability
	}

	function opensidemenuFallback(){
		body.addClass(sidemenuActiveClass);
		sidemenu.animate({left: "0px"}, menuSpeed);
		container.animate({left: menuWidth}, menuSpeed);
		push.animate({left: menuWidth}, menuSpeed); //css class to add sidemenu capability
	}

	function closesidemenuFallback(){
		body.removeClass(sidemenuActiveClass);
		sidemenu.animate({left: "-" + menuWidth}, menuSpeed);
		container.animate({left: "0px"}, menuSpeed);
		push.animate({left: "0px"}, menuSpeed); //css class to add sidemenu capability
	}

	if(Modernizr.csstransforms3d){
		//toggle menu
		menuBtn.click(function() {
			togglesidemenu();
		});
		//close menu when clicking site overlay
		siteOverlay.click(function(){ 
			togglesidemenu();
		});
	}else{
		//jQuery fallback
		sidemenu.css({left: "-" + menuWidth}); //hide menu by default
		container.css({"overflow-x": "hidden"}); //fixes IE scrollbar issue

		//keep track of menu state (open/close)
		var state = true;

		//toggle menu
		menuBtn.click(function() {
			if (state) {
				opensidemenuFallback();
				state = false;
			} else {
				closesidemenuFallback();
				state = true;
			}
		});

		//close menu when clicking site overlay
		siteOverlay.click(function(){ 
			if (state) {
				opensidemenuFallback();
				state = false;
			} else {
				closesidemenuFallback();
				state = true;
			}
		});
	}
});