document.getElementById("login-form").addEventListener("submit", function(e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    fetch('../../api/connexion.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email , password: password })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            sessionStorage.setItem("user", JSON.stringify(data.user));
            window.location.href = "../../index.html"; //redirigé vers le dashboard aprrès qu'il soit connecté
        }
    });
});
