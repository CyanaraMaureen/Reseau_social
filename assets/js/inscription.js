document.getElementById("inscription-form").addEventListener("submit", function(e){
  
  e.preventDefault();
  const nom = document.getElementById("lastname").value;
  const prenom = document.getElementById("firstname").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;


  fetch('../../api/inscription.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nom, prenom, email, password })
})

.then(res => res.json())
.then(data => {
  alert(data.message);
  if(data.success){
    window.location.href = "vérification.php"; 
  }
});

});





