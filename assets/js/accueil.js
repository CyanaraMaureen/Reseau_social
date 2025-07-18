//code js pour recuperer les articles


    document.addEventListener("DOMContentLoaded" , () =>{
    fetch("../../api/recuperer_article.php")
        .then(res => res.json())
        .then(articles => {
            const zone = document.getElementById("fil_actualite");
            zone.innerHTML = ""; //vide le conteneur

            articles.forEach(article => {
                const bloc = document.createElement("div");
                bloc.classList.add( "mb-3" , "article");

                const imageArticle = article.image ? `<img src="../../assets/images/${article.image}" alt="Image d'article" class="image-article">`: `<img src="" alt="Image d'article" class="image-article" style="display: none;">`;
                
                bloc.innerHTML = `<div class="card-body d-flex auteur">
            <img src="../../assets/images/${article.photo_profil}" alt="Photo de profil" class="rounded-circle photo-profil"> 
            <span class="card-title mb-1 nom-prenom">${article.nom} ${article.prenom}</span>
            <span class="text-muted small date"> ${article.date_creation}</span>                                                 
        </div>
       
        <div class="description">${article.contenu}</div>
          ${imageArticle}
     
            <div class="mt-2 actions">
            <button class="btn btn-sm btn-outline-danger like"> <i class="fas fa-heart"></i> ${article.likes}</button>
            <button class="btn btn-sm btn-outline-secondary dislike"> <i class="fas fa-thumbs-down"></i> ${article.dislikes}</button>
            <button class="btn btn-sm btn-outline-dark commenter "data-id="${article.id}"> <i class="fas fa-comment"></i> Commentaires</button>
        </div>
       
        <div class="mt-3 zone-commentaires" style ="display: none;" > 
            <div class="mb-3 commentaires" >
               
            </div>
       
            <div class="mt-3 ajout-commentaire">
              <textarea name="com" placeholder="Ajouter un commentaire" class="champ-commentaire" rows="5" cols="60" ></textarea> 
                <button class="btn btn-primary envoyer-commentaire">Envoyer</button>
            </div>
        </div>`;

//code js pour voir les commentaires    

    bloc.querySelector(".commenter").addEventListener("click",(e) => {
        const articleId = e.target.dataset.id || e.target.getAttribute("data-id");
        const zoneCommentaires = bloc.querySelector(".zone-commentaires");

    if(zoneCommentaires.style.display === "none" || zoneCommentaires.style.display === ""){
         zoneCommentaires.style.display = "block";
    
        const listeCommentaires = zoneCommentaires.querySelector(".commentaires");
        listeCommentaires.innerHTML = "Chargement...";

        fetch(`../../api/voir_commentaire.php?article_id=${articleId}`)
            .then(res => res.json())
            .then(data => {
                listeCommentaires.innerHTML ="";

                if(data.length ===0 ){
                    listeCommentaires.innerHTML = "<p class ='text-muted'>Aucun commentaire. Soyez le premier à commenter !</p>"
                    return;
                }

                data.forEach(com => {
                    const div = document.createElement("div");
                    div.classList.add("mb-2");
                    div.innerHTML = `<div class="fw-bold">${com.nom} ${com.prenom}</div>
                    <div>${com.contenu}</div>
                    <div class="text-muted">${com.date_creation}</div> `;

                    listeCommentaires.appendChild(div);
                
                });
           
            })

            .catch(err => {
                listeCommentaires.innerHTML = "<p class ='text-danger'>Erreur !</p>";
                console.error("Erreur JS :", err);
            });
    }else{
        zoneCommentaires.style.display = "none";
    }
        });



        // Gérer l'envoi de commentaire sans recharger
        const boutonEnvoyer = bloc.querySelector(".envoyer-commentaire");
        boutonEnvoyer.addEventListener("click", () => {
        const champCommentaire = bloc.querySelector(".champ-commentaire");
        const contenu = champCommentaire.value.trim();
        const articleId = article.id;

        if (!contenu) {
            alert("Veuillez écrire un commentaire.");
            return;
        }

        fetch("../../api/ajouter_commentaire.php", {
            method: "POST",
            headers: {
            "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `contenu=${encodeURIComponent(contenu)}&article_id=${articleId}`
        })
            .then(res => res.json())
            .then(data => {
            if (data.success) {
                //  Ajouter le nouveau commentaire à la liste
                const zoneCommentaires = bloc.querySelector(".zone-commentaires");
                
                const listeCommentaires = zoneCommentaires.querySelector(".commentaires");
                
                fetch(`../../api/voir_commentaire.php?article_id=${articleId}`)
                    .then(res => res.json())
                    .then(data => {
                        listeCommentaires.innerHTML = "";

                        if(data.length === 0){
                            listeCommentaires.innerHTML = "<p class ='text-muted'>Aucun commentaire. Soyez le premier à commenter !</p>";
                            return;
                        }
                        data.forEach(com => {
                            const div = document.createElement("div");
                            div.classList.add("mb-2");
                            div.innerHTML = `<div class="fw-bold">${com.nom} ${com.prenom} </div>
                            <div>${com.contenu}</div>
                            <div class="text-muted">${com.date_creation}</div>`;

                        listeCommentaires.appendChild(div);
                        });

                        champCommentaire.value = "";
                    })

                .catch(err => {
                    listeCommentaires.innerHTML = "<p class='text-danger'>Erreur !</p>";
                    console.error("Erreur JS :", err);

                }); 
                
            } else {
                alert("Erreur : " + data.message);
            }
            })
            .catch(err => {
            alert("Erreur réseau.");
            console.error(err);
            });
        });



        //code pour gérer les likes et dislikes

        const boutonLike = bloc.querySelector(".like");
        const boutonDislike = bloc.querySelector(".dislike");

            function actualiserLikes(){
                
                fetch(`../../api/voir_reaction.php?article_id=${article.id}`)
                    .then(res => res.json())
                    .then(data => {
                        boutonLike.innerHTML = `<i class="fas fa-heart"></i> ${data.likes}`;
                        boutonDislike.innerHTML= `<i class="fas fa-thumbs-down"></i> ${data.dislikes}`;

                        boutonLike.classList.toggle("active", data.aime === "like");
                        boutonDislike.classList.toggle("active", data.aime === "dislike");
                    });
            }
            
            boutonLike.addEventListener("click", () =>{
                fetch("../../api/liker_article.php", {
                    method: "POST",
                    headers:{
                        "Content-Type" : "application/x-www-form-urlencoded"
                    },
                    body: `article_id=${article.id}&type=like`             
                   }).then(() => actualiserLikes());
            });


            boutonDislike.addEventListener("click", () =>{
                fetch("../../api/liker_article.php", {
                    method: "POST",
                    headers:{
                        "Content-Type" : "application/x-www-form-urlencoded"
                    },
                    body: `article_id=${article.id}&type=dislike`             
                   }).then(() => actualiserLikes());
            });

        actualiserLikes();
           
                zone.appendChild(bloc);
    });
       
     })
       .catch(error => {
        console.error("Erreur lors du chargement des articles : ", error)
    });
    
});

//code js pour publier un article 


document.addEventListener("DOMContentLoaded", () => {
    
const formulaire = document.getElementById("form-article");

if(!formulaire){
    console.error("Formulaire non trouve ");
    return;
}

formulaire.addEventListener("submit", (e) => {
    e.preventDefault();

    const donneesFormulaire = new FormData(formulaire);
    
    fetch("../../api/publier_article.php", {
        method: "POST",
        body: donneesFormulaire
    })
    .then(res => res.json())
    .then(data => {
        if (data.success){
            alert("Article publié !");
            e.target.reset();

            fetch("../../api/recuperer_article.php")
        .then(res => res.json())
        .then(articles => {
            const zone = document.getElementById("fil_actualite");
            zone.innerHTML = ""; //vide le conteneur

            articles.forEach(article => {
                const bloc = document.createElement("div");
                bloc.classList.add( "mb-3" , "article");

                const imageArticle = article.image ? `<img src="../../assets/images/${article.image}" alt="Image d'article" class="image-article">`: `<img src="" alt="Image d'article" class="image-article" style="display: none;">`;
                
                bloc.innerHTML = `<div class="card-body d-flex auteur">
            <img src="../../assets/images/${article.photo_profil}" alt="Photo de profil" class="rounded-circle photo-profil"> 
            <span class="card-title mb-1 nom-prenom">${article.nom} ${article.prenom}</span>
            <span class="text-muted small date"> ${article.date_creation}</span>                                                 
        </div>
       
        <div class="description">${article.contenu}</div>
          ${imageArticle}
     
            <div class="mt-2 actions">
            <button class="btn btn-sm btn-outline-danger like"> <i class="fas fa-heart"></i> ${article.likes}</button>
            <button class="btn btn-sm btn-outline-secondary dislike"> <i class="fas fa-thumbs-down"></i> ${article.dislikes}</button>
            <button class="btn btn-sm btn-outline-dark commenter "data-id="${article.id}"> <i class="fas fa-comment"></i> Commentaires</button>
        </div>
       
        <div class="mt-3 zone-commentaires" style ="display: none;" > 
            <div class="mb-3 commentaires" >
               
            </div>
       
            <div class="mt-3 ajout-commentaire">
              <textarea name="com" placeholder="Ajouter un commentaire" class="champ-commentaire" rows="5" cols="60" ></textarea> 
                <button class="btn btn-primary envoyer-commentaire">Envoyer</button>
            </div>
        </div>`;
           
                zone.appendChild(bloc);
    });
       
     })
        } else {
            alert("Erreur : " + data.message);
        }
    })
    .catch(error => console.error("Erreur JS:", error));
});

});


//code js pour voir les commentaires à l'intérieur du code pour recuperer les articles
