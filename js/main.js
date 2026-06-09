const loginButton = document.getElementById("login");

loginButton.addEventListener("click", () => {
    try {
        window.location.href = "./views/login.html";
    } catch (error) {
        console.log(error);
    }
})