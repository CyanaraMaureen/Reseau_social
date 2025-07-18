function déconnexion() {
    fetch("../../api/déconnexion.php", {
        method:"POST"
    })
    .then(res=> res.json())
    .then(data=> {
        console.log(data.message);
        sessionStorage.clear();
        window.location.href="connexion.php";
    });
}