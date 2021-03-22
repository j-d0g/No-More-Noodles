function openForm() {
  document.getElementById("FAQ").style.top = "50%";

}
function closeForm() {
  document.getElementById("FAQ").style.top = "-50%";

}

function logged_in() {
  document.getElementById("settings_button").style.display = "inline-block";
  document.getElementById("login_button").style.display = "none";
  document.getElementById("logout_button").style.display = "inline-block";
}
