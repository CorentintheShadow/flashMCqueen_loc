<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajouter des clients</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo" class="container-sm"><h1>FCmcqueen</h1></div>
        <ul class="menu">
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Ajouter voiture</a></li>
            <li><a href="#" class="fa-solid fa-car"></a></li>
            <li><a href="#" class="fa-solid fa-user-plus" style="color: #ff0000;"></a></li>
        </ul>
    </nav>
    <div class="container-sm">
    <h1 class="text-center"> liste des clients </h1>
        <table class="table">
            <thead>
                 <tr>
                    <th scope="col">id_client</th>
                    <th scope="col">nom</th>
                    <th scope="col">prenom</th>
                    <th scope="col">adresse</th>
                    <th scope="col">id_type_de_client</th>
                 </tr>
            </thead>   
            <tbody>
                <?php
                    try {
                        $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root', '');

                            $requete = 'SELECT *
                                        FROM client';

                                $resultat = $connexion->query($requete);
                    
                                    if ($resultat) {
                                            while ($ligne = $resultat->fetch()) {
                                                 echo '
                                                        <tr>
                                                            <th scope="row">' . htmlspecialchars($ligne["id_client"]) . '</th>
                                                            <td>' . htmlspecialchars($ligne["nom"]) . '</td>
                                                            <td>' . htmlspecialchars($ligne["prenom"]) . '</td>
                                                            <td>' . htmlspecialchars($ligne["adresse"]) . '</td>
                                                            <td>' . htmlspecialchars($ligne["id_type_de_client"]) . '</td>
                                                                <td>
                                                                    <a href="/" class="btn btn-primary btn-sm">Modifier</a>
                                                                    <a href="/" class="btn btn-danger btn-sm">Supprimer</a>
                                                                </td>
                                                        </tr>';
                                                                                }
                                                    }
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage() . "<br/>";
                                die();
                                                        }
                ?>
            </tbody>
        </table>
            <button type="button" href='/' class="btn btn-primary">Nouveau client</button>
    </div>
</body>
</html>