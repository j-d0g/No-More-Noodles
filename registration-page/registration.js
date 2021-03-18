function swapToLogin() {
	var registerForm = document.querySelectorAll(".register-form");
	var loginForm = document.querySelectorAll(".login-form");
	var form = document.querySelector(".form");
	var gif = document.getElementById("gif");
	var xButton = document.getElementById("x-button");

	for (let i = 0; i < registerForm.length; i++) {
		registerForm[i].style.display = "none";
	}

	for (let i = 0; i < loginForm.length; i++) {
		loginForm[i].style.display = "block";
	}
	xButton.style.left = "243%";
	form.style.left = "25%";
	form.style.borderTopRightRadius = "0px";
	form.style.borderBottomRightRadius = "0px";
	form.style.borderTopLeftRadius = "25px";
	form.style.borderBottomLeftRadius = "25px";
	gif.style.borderTopRightRadius = "25px";
	gif.style.borderBottomRightRadius = "25px";
	gif.style.borderTopLeftRadius = "0px";
	gif.style.borderBottomLeftRadius = "0px";
	gif.style.left = "100%";
}

function swapToRegister() {
	var registerForm = document.querySelectorAll(".register-form");
	var loginForm = document.querySelectorAll(".login-form");
	var form = document.querySelector(".form");
	var gif = document.getElementById("gif");
	var xButton = document.getElementById("x-button");

	for (let i = 0; i < registerForm.length; i++) {
		registerForm[i].style.display = "block";
	}

	for (let i = 0; i < loginForm.length; i++) {
		loginForm[i].style.display = "none";
	}
	xButton.style.left = "-153%";
	form.style.left = "75%";
	form.style.borderTopLeftRadius = "0px";
	form.style.borderBottomLeftRadius = "0px";
	form.style.borderTopRightRadius = "25px";
	form.style.borderBottomRightRadius = "25px";
	gif.style.borderTopRightRadius = "0px";
	gif.style.borderBottomRightRadius = "0px";
	gif.style.borderTopLeftRadius = "25px";
	gif.style.borderBottomLeftRadius = "25px";
	gif.style.left = "-150%";
}
