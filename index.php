<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>LOCAUTO</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo"><h1>FCmcqueen</h1></div>
        <ul class="menu">
            <li><a href="/projet_php/flashMCqueen_loc/index.php" class="active">Accueil</a></li>
            <li><a href="#">Ajouter voiture</a></li>
            <li><a href="#" class="fa-solid fa-car"></a></li>
            <li><a href="/projet_php/flashMCqueen_loc//page_client.php" class="fa-solid fa-user-plus"></a></li>
        </ul>
    </nav>
    <section class="contenu">
        <h1>Ajouter voiture</h1>
        <p>Ajouter de nouvelles voitures afin d'avoir plus de clients!! Merci!!!</p>
        <button>AJOUTER</button>
        <img src="image/voiture_sportive.png" alt="honda_civic" class="imageposition">
    </section>

    <h1 class="produits_titre"> Nos Voitures</h1>
    <section class="section_produits">
        <div class="produits">
            <?php
                try {
                    $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root', '');
                    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $requete = 'SELECT 
                                    m.libelle AS Marque, 
                                    mo.libelle AS Modele, 
                                    v.prix, 
                                    v.image
                                FROM 
                                    Voiture v
                                JOIN 
                                    Modele mo ON v.id_modele = mo.id_modele
                                JOIN 
                                    Marque m ON mo.id_marque = m.id_marque';

                    $resultat = $connexion->query($requete);
                    
                    if ($resultat) {
                        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                                <div class="fiche_produit">
                                    <div class="img">
                                        <img src="image/' . htmlspecialchars($ligne["image"]) . '" alt="image de la voiture">
                                        <div class="marque">' . htmlspecialchars($ligne["Marque"]) . '</div>
                                        <div class="modele">' . htmlspecialchars($ligne["Modele"]) . '</div>
                                        <div class="contenu_2">
                                            <div class="prix">' . htmlspecialchars($ligne["prix"]) . ' euros par mois</div>
                                            <button class="modification">modifier</button>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage() . "<br/>";
                    die();
                }
            ?>
        </div>
    </section>
</body>
</html>