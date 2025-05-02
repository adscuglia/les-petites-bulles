// efface scotch a propos 

window.addEventListener("scroll", () => {
	const scotchHaut = document.querySelector("#scotchHaut");
	// test quand window est a + de 1100
	if (window.innerWidth >= 1200 && window.scrollY > 30) {
		scotchHaut.style.visibility = "visible";
	}
	else {
		scotchHaut.style.visibility = "hidden";
	}
})

if (window.innerWidth >= 1200 && window.scrollY > 30) {
	scotchHaut.style.visibility = "visible";
}
else {
	scotchHaut.style.visibility = "hidden";
}