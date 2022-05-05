var collectorStatic = {};
var collectorPerformance = {};
var collectorActivity = {};

var collectorMouseCoords = [];
var collectorMouseClicks = [];


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
let c_clickPointerX = -1;
let c_clickPointerY = -1;
let c_clickButton = null;
document.onmousemove = function(event) {
	c_pointerX = event.pageX;
	c_pointerY = event.pageY;
	//console.log('Cursor at: '+c_pointerX+', '+c_pointerY);
	collectorMouseCoords.push([c_pointerX, c_pointerY]);

}

document.onmousedown = function(event) {
	c_clickPointerX = event.pageX;
	c_clickPointerY = event.pageY;
	c_clickButton  = event.button;
	collectorMouseClicks.push([c_clickPointerX, c_clickPointerY, c_clickButton])
}
setInterval(updateMouseCoords, 1000);
function updateMouseCoords() {
	console.log('Pushing mousemov coord array with length: ', collectorMouseCoords.length);
	console.log('Pushing mouseclick coord array with length: ', collectorMouseClicks.length);
}