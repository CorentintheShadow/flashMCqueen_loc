<?php
    $id = "";
    $immatriculation = "";
    $compteur = "";
    $prix = "";
    $image = "";
    $id_modele = "";
    $id_peinture = "";

    $Message_erreur = "";
    $succes = "";

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        // montrer les données des clients
        if( !isset($_GET["id"])) { // verifier si id est present sur l'url sinon retour à l'acceuil
            header("location: /projet_php/flashMCqueen_loc/page_client.php");
            exit;
        }
        $id = $_GET["id"];
        $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root','');
        $requete = "SELECT * 
            from voiture 
            where  id_voiture = $id";
        $resultat = $connexion->query($requete);
        $ligne = $resultat->fetch();
        // if (!$ligne){
        //     header("location: /projet_php/flashMCqueen_loc/page_client.php");
        //     exit;
        // }
        $immatriculation = $ligne["immatriculation"]; // assigner leurs valeurs afin de les modifier 
        $compteur = $ligne["compteur"];
        $prix = $ligne["prix"];
        $image = $ligne["image"];
        $id_modele = $ligne["id_modele"];
        $id_peinture = $ligne["id_peinture"];
    }
    else {
        // sinon on met à jour les données du client
        $id = $_POST["id"];
        $immatriculation = $_POST["immatriculation"];
        $compteur = $_POST["compteur"];
        $prix = $_POST["prix"];
        $image = $_POST["image"];
        $id_modele = $_POST["id_modele"];
        $id_peinture = $_POST["id_peinture"];

        if ( empty($immatriculation) || empty($compteur) || empty($prix) || empty($image) || empty($id_modele) || empty($id_peinture)) {
            $Message_erreur = "veuillez saisir tous les champs";
            //die();
        }
        else try {
        $connexion = new PDO('mysql:host=localhost;dbname=locauto_php', 'root','');

        $requete = "UPDATE voiture " .
        "SET immatriculation = '$immatriculation',compteur = '$compteur',prix = '$prix',image = '$image',id_modele = '$id_modele',id_peinture = '$id_peinture'" .
        "WHERE id_client = $id";

        $resultat = $connexion->query($requete);
        $succes = "voiture mise à jour !!!";
        header("location: /projet_php/flashMCqueen_loc/index.php");
        }

        catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
            }

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
        <h2 class="text-center">Modifier la voiture</h2>
        <?php
        if (!empty($Message_erreur)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role ='alert'>
                <strong>$Message_erreur<strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        
        ?>
        <form method="post">
            <input type="hidden" name = "id"; value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">immatriculation</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="immatriculation" value="<?php echo $immatriculation ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">compteur</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="compteur" value=" <?php echo $compteur ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">prix</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prix" value="<?php echo $prix ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">image</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="image" value="<?php echo $image ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">id_modele</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_modele" value="<?php echo $id_modele ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">id_peinture</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_peinture" value="<?php echo $id_peinture ?>">
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
                <a  class="btn btn-outline-primary" href="/projet_php/flashMCqueen_loc//index.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>