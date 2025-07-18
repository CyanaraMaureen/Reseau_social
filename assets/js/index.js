document.addEventListener("DOMContentLoaded", ()=>{
    const user = JSON.parse(sessionStorage.getItem("user"));
    if(!user){
        window.location.href = "../../vues/clients/connexion.php";
        return;
    }

document.getElementById("user-display").textContent = `Bienvenue, ${user.prenom} ${user.nom}`;
});