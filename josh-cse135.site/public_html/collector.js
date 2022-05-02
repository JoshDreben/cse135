var static = {};
var performance = {};
var activity = {};


function imagesEnabled() {
	if ((document.getElementById('imageFlag').offsetWidth == 1 && document.getElementById('imageFlag').readyState == 'complete') || (document.getElementById('imageFlag').offsetWidth == 1 && document.getElementById('imageFlag').readyState==undefined)) {
		return true;
	} else {
		return false;
	}
}

function load() {
	static["userAgent"] = window.navigator.userAgent;
	static["language"] = window.navigator.language;
	static["acceptCookies"] = window.navigator.cookieEnabled;
	static["imagesEnabled"] = imagesEnabled();
	static["windowInnerWidth"] = window.innerWidth;
	static["windowInnerHeight"] = window.innerHeight;
	static["windowOuterWidth"] = window.outerWidth;
	static["windowOuterHeight"] = window.outerHeight;
	static["screenWidth"] = window.screen.width;
	static["screenHeight"] = window.screen.height;
	console.log(static);
}

window.onload = load();