<?php
$client_id = "";
$voiture_id = "";
$date_debut = "";
$date_fin = "";
$compteur_debut = "";
$compteur_fin = "";
$id_location = "";

$Message_erreur = "";
$succes = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST["client_id"];
    $voiture_id = $_POST["voiture_id"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $compteur_debut = $_POST["compteur_debut"];
    $compteur_fin = $_POST["compteur_fin"];
    if (isset($_POST["id_location"])) {
        $id_location = $_POST["id_location"];
    }

    do {
        if (empty($client_id) || empty($voiture_id) || empty($date_debut) || empty($date_fin) || empty($compteur_debut) || empty($compteur_fin)) {
            $Message_erreur = "Veuillez saisir tous les champs";
            break;
        }

        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root', '');
            $date_ajd = date("Y-m-d");

            if (empty($id_location)) {
                $requete = "INSERT INTO Location (date_debut, date_fin, compteur_debut, compteur_fin, id_client, id_voiture, date_creation) 
                            VALUES ('$date_debut', '$date_fin', '$compteur_debut', '$compteur_fin', '$client_id', '$voiture_id', '$date_ajd')";
                $connexion->exec($requete);
                $succes = "Location ajoutée avec succès";
            } else {
                $requete = "UPDATE Location 
                            SET date_debut = '$date_debut', date_fin = '$date_fin', compteur_debut = '$compteur_debut', compteur_fin = '$compteur_fin', id_client = '$client_id', id_voiture = '$voiture_id', date_modification = '$date_ajd'
                            WHERE id_location = '$id_location'";
                $connexion->exec($requete);
                $succes = "Location modifiée avec succès";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }

        $client_id = "";
        $voiture_id = "";
        $date_debut = "";
        $date_fin = "";
        $compteur_debut = "";
        $compteur_fin = "";
        $id_location = "";

        header("location: /projet_php/flashMCqueen_loc/page_location.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter/Modifier Location</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-sm">
        <h2 class="text-center">Nouvelle Location</h2>
        <?php
        if (!empty($Message_erreur)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$Message_erreur<strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id_location" value="<?php echo $id_location; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Client ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="client_id" value="<?php echo $client_id ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Voiture ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="voiture_id" value="<?php echo $voiture_id ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Début</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_debut" value="<?php echo $date_debut ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Fin</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_fin" value="<?php echo $date_fin ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Compteur Début</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="compteur_debut" value="<?php echo $compteur_debut ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Compteur Fin</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="compteur_fin" value="<?php echo $compteur_fin ?>">
                </div>
            </div>
            <?php
            if (!empty($succes)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$succes<strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/projet_php/flashMCqueen_loc/page_location.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
