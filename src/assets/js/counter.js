let counterDisplay = document.querySelector(".counter-display");
let handlePlus = document.getElementById("handleplus");
let handleMin = document.getElementById("handlemin");
let harga = document.getElementById("harga");
const cart = document.getElementById("count-cart");
let btnCart = document.querySelector(".btn-tocart");
let textCart = document.queryCommandValue(".title-cart");
let count = 1;
let updateHarga = count * parseInt(harga.textContent);
cart.textContent = textCart;
updateCount();
handlePlus.addEventListener("click", function () {
	const hasil = new Intl.NumberFormat("id-ID");
	const concuren = hasil.format(count++ * updateHarga++ * 2);
	harga.textContent = concuren;
	updateCount();
});
handleMin.classList.toggle("hidden");

btnCart.addEventListener("click", function () {
	cart.textContent = count;
});

function updateCount() {
	counterDisplay.innerHTML = count;
}
