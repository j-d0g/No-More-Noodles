function openForm() {
  document.getElementById("FAQ").style.top = "50%";

}
function closeForm() {
  document.getElementById("FAQ").style.top = "-50%";

}

function logged_in() {
  document.getElementById("settings_button").style.visibility = "visible";
  document.getElementById("login_button").style.visibility = "hidden";
  document.getElementById("logout_button").style.visibility = "visible";
}
