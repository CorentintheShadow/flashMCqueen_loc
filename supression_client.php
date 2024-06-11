<?php
    if(isset($_GET["id"])) {
        $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root','');

        $requete = "DELETE FROM client WHERE id = $id";

        $resultat = $connexion->query($requete);
    }

header("location : "); //fonction qui redirige vers un chemin
exit;
?>