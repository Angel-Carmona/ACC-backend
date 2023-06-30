const signInBtn = document.getElementById("signIn");
const signInBtn2 = document.getElementById("signIn2");
const signInBtn2Up = document.getElementById("signUp2");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

signInBtn.addEventListener("click", () => {
	container.classList.remove("right-panel-active");
});

signInBtn2.addEventListener("click", () => {
	container.classList.remove("right-panel-active");
});

signInBtn2Up.addEventListener("click", () => {
	container.classList.add("right-panel-active");
});

signUpBtn.addEventListener("click", () => {
	container.classList.add("right-panel-active");
});

//fistForm.addEventListener("submit", (e) => e.preventDefault());
secondForm.addEventListener("submit", (e) => {
	// e.preventDefault();
	console.log(e);
});


const mensajeLogin = document.querySelector(".errorMensaje");
if (mensajeLogin) {
	setTimeout(() => {
		mensajeLogin.classList.add("opacy-0");
	}, 5000);
}

$('.myLoad').slideUp('slow');
$('body').removeClass('no-loaded');

window.onload = () => {
	setTimeout(() => {
		$('input').val('');
	}, 12);
};
