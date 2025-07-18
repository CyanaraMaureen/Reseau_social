function checkSession(redirectIfMissing = true) {
    const user = 
    JSON.parse(sessionStorage.getItem("user"));
    if(!user && redirectIfMissing){
        alert("veuillez vous connecter d'abord");
        window.location.href = "connexion.php";
    }
    return user;
}
function getUser(){
return
JSON.parse(sessionStorage.getItem("user"));
}
function déconnexion(){
    sessionStorage.clear();
    window.location.href="connexion.php";
}