
const usuario = document.getElementById("usuario");
const password = document.getElementById("password");
const submit = document.getElementById("submit");
const cancelar = document.getElementById("cancelar");

cancelar.addEventListener("click", (event) => {
    event.preventDefault();
    
    try {
        window.location.href = "../index.html";
    } catch (err) {
        console.log(err);
    }
});