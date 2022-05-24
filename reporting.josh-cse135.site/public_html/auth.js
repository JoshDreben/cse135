function enableAdminDash() {
  let user_link = document.getElementById("usermgmt");
  if (user_link == null) return;
  user_link.style.display = "inherit";
}
function redirectToLogin() {
  window.location.replace("https://reporting.josh-cse135.site/login.html");
}
function loggedIn() {
  let user_obj = sessionStorage.getItem("user");
  if (user_obj == null) redirectToLogin();
  let user = JSON.parse(user_obj)["user"];
  let pass = JSON.parse(user_obj)["pass"];
  fetch(`https://reporting.josh-cse135.site/api/login.php`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ user: user, pass: pass }),
  }).then((res) => {
    res.json().then((json_res) => {
      if (json_res["status"] == 1) {
        if (json_res["type"] == "admin") enableAdminDash();
        return;
      } else {
        redirectToLogin();
      }
    });
  });
}
loggedIn();
