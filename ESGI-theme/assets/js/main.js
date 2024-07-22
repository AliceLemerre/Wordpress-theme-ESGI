window.onload = () => {
	ajaxifyLinks();
};

const getPage = function (page) {
	// fetch GET
	// action=load_posts // paged=page
	fetch(esgiValues.ajaxURL + "?action=load_posts&paged=" + page).then(
		(response) => {
			// A la réponse : mise à jour de la page
			response.text().then((text) => {
				document.getElementById("list-wrapper").innerHTML = text;
				ajaxifyLinks();
			});
		}
	);
};

const ajaxifyLinks = () => {
	const pageLinks = document.querySelectorAll(".page-numbers");
	pageLinks.forEach(function (elem) {
		elem.addEventListener("click", (e) => {
			e.preventDefault();
			const currentPage = Number(
				document.querySelector(".page-numbers.current").innerHTML
			);
			var target;
			if (e.target.classList.contains("next")) {
				target = currentPage + 1;
			} else if (e.target.classList.contains("prev")) {
				target = currentPage - 1;
			} else {
				target = Number(e.target.innerHTML);
			}
			getPage(target);
		});
	});
};


document.addEventListener('DOMContentLoaded', () => {


const openButton = document.getElementById("open-button");
const closeButton = document.getElementById("close-button");
const menuOpen = document.getElementById("menu-open");

openButton.addEventListener("click", () => {
	menuOpen.style.top = "0";
});

closeButton.addEventListener("click", () => {
	menuOpen.style.top = "-100%";
});

});
/*
const inputSearch = document.querySelector('#s');
if (inputSearch) {
	inputSearch.value = '';
	inputSearch.placeholder = 'Search for...';
}*/