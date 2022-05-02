var static = {};
var performance = {};
var activity = {};


function imagesEnabled() {
	if ((document.getElementById('imageFlag').offsetWidth == 1)) {
		static["imagesEnabled"] = true;
	} else {
		static["imagesEnabled"] = false;
	}
}

function cssEnabled () {
	static["cssEnabled"] = window.getComputedStyle(document.getElementById('heading')).display === 'flex' ? true : false;
}

function load() {
	static["userAgent"] = window.navigator.userAgent;
	static["language"] = window.navigator.language;
	static["acceptCookies"] = window.navigator.cookieEnabled;
	static["windowInnerWidth"] = window.innerWidth;
	static["windowInnerHeight"] = window.innerHeight;
	static["windowOuterWidth"] = window.outerWidth;
	static["windowOuterHeight"] = window.outerHeight;
	static["screenWidth"] = window.screen.width;
	static["screenHeight"] = window.screen.height;
	if (window.navigator.connection !== null) {
		static["connectionType"] = window.navigator.connection.type;
	}
	console.log(static);
}

window.onload = load();