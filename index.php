<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>jaime les chibres</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo"><h1>FCmcqueen</h1></div>
        <ul class="menu">
            <li><a href="#" class="active">Accueil</a></li>
            <li><a href="#">Ajouter voiture</a></li>
            <li><a href="#" class="fa-solid fa-car"></a></li>
            <li><a href="#" class="fa-solid fa-user-plus"></a></li>
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
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Locauto</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo"><h1>FCmcqueen</h1></div>
        <ul class="menu">
            <li><a href="#" class="active">Accueil</a></li>
            <li><a href="#">Ajouter voiture</a></li>
            <li><a href="#" class="fa-solid fa-car"></a></li>
            <li><a href="#" class="fa-solid fa-user-plus"></a></li>
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
            <div class="fiche_produit">
                <div class="img"><img src="image/honda_civic.png" alt="honda_civic">
                <div class="marque">Honda</div>
                <div class="modele">Hatchback</div>
                <div class="contenu_2">
                    <div class="prix">300 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
            <div class="fiche_produit">
                <div class="img"><img src="image/BMW-M4.jpg" alt="BMW_M4">
                <div class="marque">BMW</div>
                <div class="modele">M4</div>
                <div class="contenu_2">
                    <div class="prix">600 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
            <div class="fiche_produit">
                <div class="img"><img src="image/BMW_serie4.jpg" alt="BMW_serie_4">
                <div class="marque">BMW</div>
                <div class="modele">série 4</div>
                <div class="contenu_2">
                    <div class="prix">500 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
            <div class="fiche_produit">
                <div class="img"><img src="image/Ford-mustang-GT.jpg" alt="Ford_mustang_GT">
                <div class="marque">Ford</div>
                <div class="modele">Mustang</div>
                <div class="contenu_2">
                    <div class="prix">500 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
            <div class="fiche_produit">
                <div class="img"><img src="image/lambo-aventador.jpg" alt="lamborgini_aventador">
                <div class="marque">Lamborgini</div>
                <div class="modele">Aventador</div>
                <div class="contenu_2">
                    <div class="prix">1200 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
            <div class="fiche_produit">
                <div class="img"><img src="image/Audi-RS7.jpg" alt="Audi_RS7">
                <div class="marque">Audi</div>
                <div class="modele">RS7</div>
                <div class="contenu_2">
                    <div class="prix">700 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
            <div class="fiche_produit">
                <div class="img"><img src="image/RL_octane.jpg" alt="octane_rocket_league">
                <div class="marque">Rocket League</div>
                <div class="modele">Octane</div>
                <div class="contenu_2">
                    <div class="prix">1000 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
            <div class="fiche_produit">
                <div class="img"><img src="image/Fiat-500.jpg" alt="Fiat_500">
                <div class="marque">Fiat</div>
                <div class="modele">500</div>
                <div class="contenu_2">
                    <div class="prix">200 euros par mois</div>
                    <button class="modification">modifier</button>
                </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html> -->