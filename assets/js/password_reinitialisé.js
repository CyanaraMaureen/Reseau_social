
 const email = new URLSearchParams(window.location.search).get("email");
 const token = new URLSearchParams(window.location.search).get("token");


document.getElementById("reset-form").addEventListener("submit", function(e) {
            e.preventDefault();

            const password = document.getElementById("new-password").value;
            const confirm = document.getElementById("confirm-password").value;
           
            if (password !== confirm) {
                alert("Les mots de passe ne correspondent pas.");
                return;
            }

            fetch('../../api/password_reinitialisé.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: email, 
                    token: token,
                    password: password
                })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    window.location.href = "connexion.php";
                }
            });
        });
    