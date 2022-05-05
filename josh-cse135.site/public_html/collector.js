var collectorStatic = {};
var collectorPerformance = {};
var collectorActivity = {};


function imagesEnabled() {
	if ((document.getElementById('imageFlag').offsetWidth == 1)) {
		collectorStatic["imagesEnabled"] = true;
	} else {
		collectorStatic["imagesEnabled"] = false;
	}
}

function cssEnabled () {
	collectorStatic["cssEnabled"] = window.getComputedStyle(document.getElementById('heading')).display === 'flex' ? true : false;
}

function showNavDetails() {
	console.log(window.performance.getEntriesByType("navigation"));
}

function collectorLoad() {
	collectorStatic["userAgent"] = window.navigator.userAgent;
	collectorStatic["language"] = window.navigator.language;
	collectorStatic["acceptCookies"] = window.navigator.cookieEnabled;
	collectorStatic["windowInnerWidth"] = window.innerWidth;
	collectorStatic["windowInnerHeight"] = window.innerHeight;
	collectorStatic["windowOuterWidth"] = window.outerWidth;
	collectorStatic["windowOuterHeight"] = window.outerHeight;
	collectorStatic["screenWidth"] = window.screen.width;
	collectorStatic["screenHeight"] = window.screen.height;
	let connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
	if (connection != undefined) {
		collectorStatic["connectionType"] = connection.effectiveType;
	}
	collectorStatic["jsEnabled"] = true;
	imagesEnabled();
	cssEnabled();
	collectorStatic["timing"] = window.performance.timing;
	collectorStatic["loadStart"] = window.performance.timing.loadEventStart;
	collectorStatic["loadEnd"] = window.performance.timing.loadEventEnd;
	collectorStatic["totalLoad"] = collectorStatic["loadEnd"] - collectorStatic["loadStart"];
	console.log(collectorStatic);
}


