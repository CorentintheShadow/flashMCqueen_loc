<?php

$nom = "";
$prenom = "";
$adresse = "";
$type_de_client = "";

$Message_erreur = "";
$succes = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) { // verifier si la requete est de type post
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"]; // si oui; recupération des données de la methode post et insertion dans la base de données
    $adresse = $_POST["adresse"];
    $type_de_client = $_POST["Type_de_client"];

    do{ if ( empty($nom) || empty($prenom) || empty($adresse) || empty($type_de_client)) {
        $Message_erreur = "veuillez saisir tous les champs";
        break;
    }


try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root','');
    $requete = "INSERT  INTO client (nom, prenom, adresse, id_type_de_client)" . 
    "VALUES ('$nom','$prenom','$adresse ','$type_de_client')";
    $resultat = $connexion->query($requete);
    }
    catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
    }

            //rénitialiser les champs aprés avoir ajouter le nouveau client 

            $nom = "";
            $prenom = "";
            $adresse = "";
            $type_de_client = "";

            $succes = "client ajouté avec succes";

            header("location: /projet_php/flashMCqueen_loc/page_client.php"); //fonction qui redirige vers un chemin
            exit;

            }while (false);

        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>créer client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class= "container-sm">
        <h2 class="text-center">Nouveau client</h2>
        <?php
        if (!empty($Message_erreur)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role ='alert'>
                <strong>$Message_erreur<strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"; // pop up qui d'alerte qui donne un message d'erreur
        }
        
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prenom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value=" <?php echo $prenom ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adresse" value="<?php echo $adresse ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Type de client</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Type_de_client" value="<?php echo $type_de_client ?>">
                </div>
            </div>
            <?php
            if (!empty($succes)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role ='alert'>
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
                <a  class="btn btn-outline-primary" href="#" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>