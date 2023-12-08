function togglePassword() {
    var eyeicon = document.getElementById("eyeicon");
    var password = document.getElementById("password");

    if (password.type === "password") {
        password.type = "text";
        eyeicon.innerHTML = '<span class="material-symbols-outlined">visibility_off</span>';
    } else {
        password.type = "password";
        eyeicon.innerHTML = '<span class="material-symbols-outlined">visibility</span>';
    }
}

function closeuser() {
    const username = document.querySelector(".user");
    const closeUsername = document.getElementById("closeUsername");

    if (username.value.length <= 0) {
        document.body.classList.remove("active");
        closeUsername.style.display = "none";
    } else {
        document.body.classList.add("active");
        closeUsername.style.display = "flex";
    }

    closeUsername.addEventListener("click", () => {
        username.value = "";
        document.body.classList.remove("active");
        closeUsername.style.display = "none";
    });
}

function closepass(){
    const password = document.querySelector(".pass");
    const closePassword = document.getElementById("closePassword");

    if (password.value.length <= 0) {
        document.body.classList.remove("active_2");
        closePassword.style.display = "none";
    } else {
        document.body.classList.add("active_2");
        closePassword.style.display = "flex";
    }

    closePassword.addEventListener("click", () => {
        password.value = "";
        document.body.classList.remove("active_2");
        closePassword.style.display = "none";
    });
}





