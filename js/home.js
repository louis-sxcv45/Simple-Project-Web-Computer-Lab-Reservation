const body = document.querySelector("body"),
	sidebar = body.querySelector("nav"),
	toggle = body.querySelector(".toggle"),
	searchBtn = body.querySelector(".search-box"),
	modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
	sidebar.classList.toggle("close");
});

searchBtn.addEventListener("click", () => {
	sidebar.classList.remove("close");
});

var cardRooms = document.querySelectorAll(".card-icon");

cardRooms.forEach(function(cardRooms){
	cardRooms.addEventListener('click',function(){
		var destination = this.getAttribute("data-href");
		window.location.href = destination;
	});
});


const toTop = document.querySelector(".add-room");

window.addEventListener("scroll", () => {
    if (window.pageYOffset > 100) {
        toTop.classList.add("inactive");
    } else {
        toTop.classList.remove("inactive");
    }
});

function showForm(){
	var createForm = document.getElementById('create');
	createForm.style.display = (createForm.style.display == 'none') ? 'block' : 'none';
}