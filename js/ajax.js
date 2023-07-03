$(document).on("click", ".metismenu li a, .navbar-nav li a , .single_link", function(e) {
	e.preventDefault();
	var page = $(this).attr("href");
	if ($(this).attr("target") == "_self") {window.location.href= page; return true};
	//if ($(this).attr("target") == "_blank") {window.location.href= page; return true};
	if ($(this).attr("target") == "_blank") {
		window.open(page, "_blank");
		return;
	}

	 if (page == "javascript: void(0);") return false;

	window.location.hash = page;

	//$(".metismenu li, .metismenu li a").removeClass("active");
	//$(".metismenu ul").removeClass("in");
	
    $("#main-wrapper").removeClass("menu-toggle");
	$(".hamburger").removeClass("is-active");

	$(".metismenu a").each(function() {
		var pageUrl = window.location.hash.substr(1);
		if ($(this).attr("href") == pageUrl) {
			$(this).addClass("active");
			$(this).parent().addClass("mm-active"); // add active to li of the current link
			$(this).parent().parent().addClass("mm-show");
			$(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
			$(this).parent().parent().parent().addClass("mm-active");
			$(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
			$(this).parent().parent().parent().parent().parent().addClass("mm-active");
		}
	});

	$(".navbar-nav a").removeClass("active"); 
	$(".navbar-nav li").removeClass("active"); 
	$(".navbar-nav a").each(function () {
		var pageUrl = window.location.hash.substr(1);
        if ( $(this).attr('href') == pageUrl) {
			$(this).addClass("active");
			$(this).parent().addClass("active");
			$(this).parent().parent().addClass("active");
			$(this).parent().parent().parent().addClass("active");
			$(this).parent().parent().parent().parent().addClass("active");
			$(this).parent().parent().parent().parent().parent().addClass("active");
		}
	});

	 if (page == "javascript: void(0);") return false;
	//call_ajax_page(page);
});

function call_ajax_page(page) {

	if(page === "home")
	{
		document.title = "Dashboard | AnyInspect";
	}
	else
	{
		var title = page.replace(".php", "");
		var title1 = title.replace("-", " ");
		document.title = title1.charAt(0).toUpperCase() + title1.slice(1) + " | AnyInspect";

		if(page == ''){
			page = 'home'
		}
	}

	$.ajax({
		url: page,
		cache: false,
		dataType: "html",
		type: "GET",
		success: function(data) {
			$("#miniaresult").empty();
			$("#miniaresult").html(data);
			window.location.hash = page;
			$(window).scrollTop(0);
		},
		error: function(data){
			$.ajax({
				url: 404,
				cache: false,
				dataType: "html",
				type: "GET",
				success: function(data) {
					$("#miniaresult").empty();
					$("#miniaresult").html(data);
					window.location.hash = page;
					$(window).scrollTop(0);
				}
			});
			
		}
	});
}

$(document).ready(function() {
	
	 var path = window.location.hash.substr(1);

	 call_ajax_page(path);

	 /*if (path == "index"){
		call_ajax_page("home");
	
	} else {
		if (path == "home") {
			call_ajax_page("home");
		} else {
			if(path == ''){
				call_ajax_page("home");
			} else {
				call_ajax_page(path);
			}
						
		}
	 } */

	 window.onhashchange = function() {
		if (window.innerDocClick) {
			window.innerDocClick = false;
		} else {
			if (window.location.hash != '#undefined') {
				var path = window.location.hash.substr(1);
				call_ajax_page(path);

				/*if (path == "index"){
				   call_ajax_page("home");
			   
			   } else {
				   if (path == "home") {
					   call_ajax_page("home");
				   } else {
					   if(path == ''){
						   call_ajax_page("home");
					   } else {
						   call_ajax_page(path);
					   }
								   
				   }
				} */


			} else {
				//history.pushState("", document.title, window.location.pathname);
				//location.reload();
			}
		}
	}

	/*if(typeof(console) === 'undefined') {
		var console = {};
		console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};
	}*/
	
});