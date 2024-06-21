<?php
$prix = "",
$marque = "";
$modele = "";
$annee = "";
$immatriculation = "";

$Message_erreur = "";
$succes = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) { // verifier si la requete est de type post
    $marque = $_POST["marque"];
    $modele = $_POST["modele"]; // si oui; recupération des données de la methode post et insertion dans la base de données
    $annee = $_POST["annee"];
    $immatriculation = $_POST["immatriculation"];

    do { 
        if ( empty($marque) || empty($modele) || empty($annee) || empty($immatriculation) ) {
            $Message_erreur = "Veuillez saisir tous les champs";
            break;
        }

        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root', '');
            $requete = "INSERT INTO voiture (marque, modele, annee, immatriculation)" . 
                       "VALUES ('$marque','$modele','$annee','$immatriculation')";
            $resultat = $connexion->query($requete);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }

        // Réinitialiser les champs après avoir ajouté la nouvelle voiture
        $prix = "",
        $marque = "";
        $modele = "";
        $annee = "";
        $immatriculation = "";

        $succes = "Voiture ajoutée avec succès";

        header("location: /projet_php/flashMCqueen_loc/page_voiture.php"); // fonction qui redirige vers un chemin
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Voiture</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-sm">
        <h2 class="text-center">Nouvelle Voiture</h2>
        <?php
        if (!empty($Message_erreur)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$Message_erreur<strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"; // pop-up d'alerte qui donne un message d'erreur
        }
        ?>
        <form method="post">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prix</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prix" value="<?php echo $prix ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Marque</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="marque" value="<?php echo $marque ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Modèle</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="modele" value="<?php echo $modele ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Année</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="annee" value="<?php echo $annee ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Immatriculation</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="immatriculation" value="<?php echo $immatriculation ?>">
                </div>
            </div>
            <?php
            if (!empty($succes)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$succes<strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/projet_php/flashMCqueen_loc/page_voiture.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
