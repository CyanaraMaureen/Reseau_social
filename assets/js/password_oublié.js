document.getElementById("forgot-form").addEventListener("submit", function(e) {
                e.preventDefault();
                const email = document.getElementById("email").value. trim();
                if (!email || !email.includes("@")) {
                    alert("Veuillez entrer une addresse email valide.");
                    return;
                }

                fetch('../../api/password_oublié.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email })
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                    if(data.link){
                        window.location.href = data.link;
                    }
                });
            });
