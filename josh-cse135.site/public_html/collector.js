var collectorStatic = {};
var collectorPerformance = {};
var collectorActivity = {};

var collectorMouseCoords = [];
var collectorMouseClicks = [];
var collectorScrolls = [];
var collectorKeyDown = [];
var collectorKeyUp = [];
var collectorIdleTimeouts = [];

var collectorTimer = 0;

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
	collectorActivity["timeEntered"] = window.performance.timeOrigin;
	collectorActivity["page"] = window.location;
	console.log(collectorStatic, collectorPerformance);
}

window.addEventListener('load', collectorCheck);

window.addEventListener('beforeunload', unloadCollector);

function unloadCollector() {
	collectorActivity["timeLeft"] = Date.now();	
}

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

let c_oldSrollY = 0;
let c_scrollPointerY = -1;
let c_clickButton = null;
document.onmousemove = function(event) {
	c_pointerX = event.pageX;
	c_pointerY = event.pageY;
	resetIdleTimer();

	collectorMouseCoords.push([c_pointerX, c_pointerY]);

}

document.onkeydown = function(event) {
	resetIdleTimer();
	collectorKeyDown.push([event.key,event.code]);
}
document.onkeyup = function(event) {
	resetIdleTimer();
	collectorKeyUp.push([event.key,event.code]);
}

document.onmousedown = function(event) {
	resetIdleTimer();
	c_clickPointerX = event.pageX;
	c_clickPointerY = event.pageY;
	c_clickButton  = event.button;
	collectorMouseClicks.push([c_clickPointerX, c_clickPointerY, c_clickButton])
}

document.onscroll = function (event) {
	c_scrollPointerY = window.scrollY;
	resetIdleTimer();
	collectorScrolls.push([c_oldSrollY, c_scrollPointerY]);
	c_oldSrollY = c_scrollPointerY;

}
setInterval(updateActivity, 1000);
function updateActivity() {
	// console.log('Pushing mousemov coord array with length: ', 
	// collectorMouseCoords.length, '\n Pushing mouseclick coord array with length: ', 
	// collectorMouseClicks.length, '\n Pushing scroll coord array with length: ', 
	// collectorScrolls.length, '\n Pushing key down info with array length: ',
	// collectorKeyDown.length, '\n Pushing key up info with array length: ',
	// collectorKeyUp.length, '\n Pushing idle time with array length: ', 
	// collectorIdleTimeouts.length);
	collectorActivity["mouseCoords"] = collectorMouseCoords;
	collectorActivity["mouseClicks"] = collectorMouseCoords;
	collectorActivity["scrolls"] = collectorMouseCoords;
	collectorActivity["keysDown"] = collectorMouseCoords;
	collectorActivity["keysUp"] = collectorMouseCoords;
	collectorActivity["idleTimeouts"] = collectorMouseCoords;
}

setInterval(updateTimer, 1);

function updateTimer() {
	collectorTimer += 1;
}
function resetIdleTimer() {
	idleTime = collectorTimer;
	if (collectorTimer >= 2000) {
		collectorIdleTimeouts.push([idleTime, Date.now()]);
	}
	collectorTimer = 0;
}