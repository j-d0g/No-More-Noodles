


const slideImagesImgBreakfast = document.querySelectorAll(".Breakfast > .recipe-image > img");
const slideImagesImgLunch = document.querySelectorAll(".lunch > .recipe-image > img");
const slideImagesImgDinner = document.querySelectorAll(".dinner > .recipe-image > img");

const previousButton = document.querySelector("#previous-recipe");
const nextButton = document.querySelector("#next-recipe");

let counterBreakfast = 0;
let counterLunch = 0;
let counterDinner = 0;

var sizeWidth = slideImagesImgBreakfast[0].clientWidth;
var sizeHeight = slideImagesImgBreakfast[0].clientHeight;





var y = 0;
for (var i = 0; i< slideImagesImgBreakfast.length; i++) {
	if (y == slideImagesImgBreakfast.length) {
		y = 0;
	}
	slideImagesImgBreakfast[i].style.left = y * sizeWidth + "px";
	y++;
}


var y = 0;
for (var i = 0; i< slideImagesImgLunch.length; i++) {
	if (y == slideImagesImgLunch.length) {
		y = 0;
	}
	slideImagesImgLunch[i].style.left = y * sizeWidth + "px";
	y++;
}


var y = 0;
for (var i = 0; i< slideImagesImgDinner.length; i++) {
	if (y == slideImagesImgDinner.length) {
		y = 0;
	}
	slideImagesImgDinner[i].style.left = y * sizeWidth + "px";
	y++;
}


function next() {
	if (document.querySelector("#breakfast").classList.contains("highlight")) {
		counterBreakfast++;
		for (var i = 0; i< slideImagesImgBreakfast.length; i++)
	{
		slideImagesImgBreakfast[i].style.transform = "translateX(" + (-sizeWidth * counterBreakfast) + "px)";
	}

	if (counterBreakfast == slideImagesImgBreakfast.length) {
		for (var i = 0; i< slideImagesImgBreakfast.length; i++)
	{
		slideImagesImgBreakfast[i].style.transform = "translateX(0)";
		counterBreakfast = 0;
	}
	}
	}

	if (document.querySelector("#lunch").classList.contains("highlight")) {
		counterLunch++;
		for (var i = 0; i< slideImagesImgLunch.length; i++)
	{
		slideImagesImgLunch[i].style.transform = "translateX(" + (-sizeWidth * counterLunch) + "px)";
	}

	if (counterLunch == slideImagesImgLunch.length) {
		for (var i = 0; i< slideImagesImgLunch.length; i++)
	{
		slideImagesImgLunch[i].style.transform = "translateX(0)";
		counterLunch = 0;
	}
	}
	}

	if (document.querySelector("#dinner").classList.contains("highlight")) {
		counterDinner++;
		for (var i = 0; i< slideImagesImgDinner.length; i++)
	{
		slideImagesImgDinner[i].style.transform = "translateX(" + (-sizeWidth * counterDinner) + "px)";
	}

	if (counterDinner == slideImagesImgDinner.length) {
		for (var i = 0; i< slideImagesImgDinner.length; i++)
	{
		slideImagesImgDinner[i].style.transform = "translateX(0)";
		counterDinner = 0;
	}
	}
	}
	

}

function previous() {
	if (document.querySelector("#breakfast").classList.contains("highlight")) {
		counterBreakfast--;
	for (var i = 0; i< slideImagesImgBreakfast.length; i++)
	{
		slideImagesImgBreakfast[i].style.transform = "translateX(" + (-sizeWidth * counterBreakfast) + "px)";
	}

	if (counterBreakfast == -1) {
		for (var i = 0; i< slideImagesImgBreakfast.length; i++)
	{
		slideImagesImgBreakfast[i].style.transform = "translateX(" + ((-slideImagesImgBreakfast.length+1) * sizeWidth) + "px)";
		counterBreakfast = slideImagesImgBreakfast.length-1;
	}
	}
	}

	if (document.querySelector("#lunch").classList.contains("highlight")) {
		counterLunch--;
	for (var i = 0; i< slideImagesImgLunch.length; i++)
	{
		slideImagesImgLunch[i].style.transform = "translateX(" + (-sizeWidth * counterLunch) + "px)";
	}

	if (counterLunch == -1) {
		for (var i = 0; i< slideImagesImgLunch.length; i++)
	{
		slideImagesImgLunch[i].style.transform = "translateX(" + ((-slideImagesImgLunch.length+1) * sizeWidth) + "px)";
		counterLunch = slideImagesImgLunch.length-1;
	}
	}
	}

	if (document.querySelector("#dinner").classList.contains("highlight")) {
		counterDinner--;
	for (var i = 0; i< slideImagesImgDinner.length; i++)
	{
		slideImagesImgDinner[i].style.transform = "translateX(" + (-sizeWidth * counterDinner) + "px)";
	}

	if (counterDinner == -1) {
		for (var i = 0; i< slideImagesImgDinner.length; i++)
	{
		slideImagesImgDinner[i].style.transform = "translateX(" + ((-slideImagesImgDinner.length+1) * sizeWidth) + "px)";
		counterDinner = slideImagesImgDinner.length-1;
	}
	}
	}


}



let toggle = 1;

function displayInformation() {
	if (document.querySelector("#breakfast").classList.contains("highlight")) {
		if (toggle == 1) {
		var x = document.querySelector(".recipe-information-0-" + counterBreakfast);
		var y = document.querySelectorAll(".dropdown");
		x.style.height = "100%";
		toggle = 0;
		y[0].innerHTML = "Close <br> &Delta;";
	}
	else if (toggle == 0) {
		var x = document.querySelector(".recipe-information-0-" + counterBreakfast);
		var y = document.querySelectorAll(".dropdown");
		x.style.height = "0%";
		toggle = 1;
		y[0].innerHTML = "Recipe Information<br>&#8711;";

	}
	}
	if (document.querySelector("#lunch").classList.contains("highlight")) {
		if (toggle == 1) {
		var x = document.querySelector(".recipe-information-1-" + counterLunch);
		var y = document.querySelectorAll(".dropdown");
		x.style.height = "100%";
		toggle = 0;
		y[1].innerHTML = "Close <br> &Delta;";
	}
	else if (toggle == 0) {
		var x = document.querySelector(".recipe-information-1-" + counterLunch);
		var y = document.querySelectorAll(".dropdown");
		x.style.height = "0%";
		toggle = 1;
		y[1].innerHTML = "Recipe Information<br>&#8711;";

	}
	}

	if (document.querySelector("#dinner").classList.contains("highlight")) {
		if (toggle == 1) {
		var x = document.querySelector(".recipe-information-2-" + counterDinner);
		var y = document.querySelectorAll(".dropdown");
		x.style.height = "100%";
		toggle = 0;
		y[2].innerHTML = "Close <br> &Delta;";
	}
	else if (toggle == 0) {
		var x = document.querySelector(".recipe-information-2-" + counterDinner);
		var y = document.querySelectorAll(".dropdown");
		x.style.height = "0%";
		toggle = 1;
		y[2].innerHTML = "Recipe Information<br>&#8711;";

	}
	}
	
}


document.querySelector("#breakfast").classList.add("highlight")
window.addEventListener("scroll", () => {
	var scrollpos = window.scrollY
	var breakfastNav = document.querySelector("#breakfast")
	var lunchNav = document.querySelector("#lunch")
	var dinnerNav = document.querySelector("#dinner")

	if (scrollpos < sizeHeight * 0.9) {
		breakfastNav.classList.remove("highlight")
		lunchNav.classList.remove("highlight")
		dinnerNav.classList.remove("highlight")
		breakfastNav.classList.add("highlight")
	 	return
	} 
	else if (scrollpos < sizeHeight * 1.9) {
		breakfastNav.classList.remove("highlight")
		lunchNav.classList.remove("highlight")
		dinnerNav.classList.remove("highlight")
		lunchNav.classList.add("highlight")
	 	return
	}
	else if (scrollpos < sizeHeight * 2.9) {
		breakfastNav.classList.remove("highlight")
		lunchNav.classList.remove("highlight")
		dinnerNav.classList.remove("highlight")
		dinnerNav.classList.add("highlight")
	 	return
	} 

})

document.addEventListener('keydown', (e) => {
	if(e.code === "ArrowDown") {
		if(toggle ==1) {
			displayInformation()
		}

  }
  	if(e.code === "ArrowUp") {
		if(toggle ==0) {
			displayInformation()
		}

  }


  	else if (e.code === "ArrowRight") {
  		if(toggle == 1){

  			next()
  		}
  }
  	else if(e.code === "ArrowLeft") {
  		if(toggle == 1){


  		previous()
  	}
  }
 

});









