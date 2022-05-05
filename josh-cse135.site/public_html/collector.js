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

	collectorPerformance["timing"] = window.performance.timing;
	collectorPerformance["loadStart"] = window.performance.timing.loadEventStart;
	collectorPerformance["loadEnd"] = window.performance.timing.loadEventEnd;
	collectorPerformance["totalLoad"] = collectorPerformance["loadEnd"] - collectorPerformance["loadStart"];
	console.log(collectorStatic, collectorPerformance);
}

window.addEventListener('load', collectorCheck);

function collectorCheck() {
  if (window.performance.getEntriesByType("navigation")[0].loadEventEnd != 0) {
    collectorLoad();
  }
  else setTimeout(collectorCheck, 0); //put it back in queue
}

let c_pointerX = -1;
let c_pointerY = -1;
document.onmousemove = function(event) {
	c_pointerX = event.pageX;
	c_pointerY = event.pageY;
}
setInterval(pointerCheck, 100);
function pointerCheck() {
	console.log('Cursor at: '+pointerX+', '+pointerY);
}