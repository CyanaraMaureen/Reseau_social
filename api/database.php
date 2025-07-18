<?php 
    try {
 $pdo = new PDO('mysql:host=localhost;dbname=reseau_social;charset=utf8','root', '');   //ne pas oublier de rediriger vers reseau_social.Ceci c'est juste pour tester mon propre code
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 echo "Erreur de connexion : " . $e->getMessage();
}
   
?>