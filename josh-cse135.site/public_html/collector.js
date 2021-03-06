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
var collectorSessionId = Date.now().toString();

function imagesEnabled() {
  if (document.getElementById("imageFlag").offsetWidth == 1) {
    collectorStatic["imagesEnabled"] = true;
  } else {
    collectorStatic["imagesEnabled"] = false;
  }
}

function cssEnabled() {
  collectorStatic["cssEnabled"] =
    window.getComputedStyle(document.getElementById("heading")).display ===
    "flex"
      ? true
      : false;
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
  let connection =
    navigator.connection ||
    navigator.mozConnection ||
    navigator.webkitConnection;
  if (connection != undefined) {
    collectorStatic["connectionType"] = connection.effectiveType;
  }
  collectorStatic["jsEnabled"] = true;
  imagesEnabled();
  cssEnabled();

  collectorPerformance["timing"] = JSON.stringify(window.performance.timing);
  collectorPerformance["loadStart"] = window.performance.timing.loadEventStart;
  collectorPerformance["loadEnd"] = window.performance.timing.loadEventEnd;
  collectorPerformance["totalLoad"] =
    collectorPerformance["loadEnd"] - collectorPerformance["loadStart"];
  collectorActivity["timeEntered"] = window.performance.timeOrigin;
  collectorActivity["timeExited"] = -1;
  collectorActivity["page"] = window.location.toString();
  collectorActivity["SID"] = parseInt(collectorSessionId);
  collectorPerformance["SID"] = parseInt(collectorSessionId);
  collectorStatic["SID"] = parseInt(collectorSessionId);
  fetch("https://josh-cse135.site/api/static", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(collectorStatic),
  });
  fetch("https://josh-cse135.site/api/performance", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(collectorPerformance),
  });
  fetch("https://josh-cse135.site/api/activity", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(collectorActivity),
  });
}

window.addEventListener("load", collectorCheck);

window.addEventListener("beforeunload", unloadCollector);
window.onunload = unloadCollector;
document.onunload = unloadCollector;

function unloadCollector() {
  collectorActivity["timeExited"] = Date.now();
  resetIdleTimer();
  fetch(`https://josh-cse135.site/api/activity/${collectorActivity["SID"]}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(collectorActivity),
  });
}

function collectorCheck() {
  if (window.performance.getEntriesByType("navigation")[0].loadEventEnd != 0) {
    collectorLoad();
  } else setTimeout(collectorCheck, 0); //put it back in queue
}

let c_oldSrollY = 0;
let c_scrollPointerY = -1;
document.onmousemove = function (event) {
  resetIdleTimer();

  collectorMouseCoords.push([event.pageX, event.pageY]);
};

document.onkeydown = function (event) {
  resetIdleTimer();
  collectorKeyDown.push([event.key, event.code]);
};
document.onkeyup = function (event) {
  resetIdleTimer();
  collectorKeyUp.push([event.key, event.code]);
};

document.onmousedown = function (event) {
  resetIdleTimer();
  collectorMouseClicks.push([event.pageX, event.pageY, event.button]);
};

document.onscroll = function (event) {
  c_scrollPointerY = window.scrollY;
  resetIdleTimer();
  collectorScrolls.push([c_oldSrollY, c_scrollPointerY]);
  c_oldSrollY = c_scrollPointerY;
};

setInterval(updateActivity, 3000);
function updateActivity() {
  collectorActivity["mouseCoords"] = JSON.stringify(collectorMouseCoords);
  collectorActivity["mouseClicks"] = JSON.stringify(collectorMouseClicks);
  collectorActivity["scrolls"] = JSON.stringify(collectorScrolls);
  collectorActivity["keysDown"] = JSON.stringify(collectorKeyDown);
  collectorActivity["keysUp"] = JSON.stringify(collectorKeyUp);
  collectorActivity["idleTimeouts"] = JSON.stringify(collectorIdleTimeouts);
  fetch(`https://josh-cse135.site/api/activity/${collectorActivity["SID"]}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(collectorActivity),
  });
}

setInterval(updateTimer, 1);

function updateTimer() {
  collectorTimer += 1;
}
function resetIdleTimer() {
  idleTime = collectorTimer;
  if (idleTime >= 1000) {
    collectorIdleTimeouts.push([idleTime, Date.now()]);
  }
  collectorTimer = 0;
}
