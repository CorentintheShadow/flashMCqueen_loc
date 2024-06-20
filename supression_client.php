<?php
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        try {
        $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root','');

        $requete = "DELETE FROM client WHERE id_client = ".$id."";

        $resultat = $connexion->query($requete);
        $ligne = $resultat->fetch();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
        }
    }

    header("location: /projet_php/flashMCqueen_loc/page_client.php"); //fonction qui redirige vers un chemin
    exit;
?>