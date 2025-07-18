const user = JSON.parse(sessionStorage.getItem("user"));

if(user && user.email){

fetch("../../api/vérification.php",{
    method: "POST",
    headers:{"Content-Type":"application/json"},
    body:JSON.stringify({email: user.email})
})
.then(res=> res.json())
.then(data=>{
    alert(data.message);
})
.catch(err => {
    console.error("Erreur JS:", err);
});

}




