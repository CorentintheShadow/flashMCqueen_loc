
--Table Type de client--
CREATE TABLE Type_de_client (
    id_type_de_client INT NOT NULL,
    libelle VARCHAR(100) NOT NULL,
    CONSTRAINT Type_de_client_PK PRIMARY KEY (id_type_de_client)
);

--Table client--
CREATE TABLE Client (
    id_client INT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresse VARCHAR(100) NOT NULL,
    id_type_de_client INT NOT NULL,
    CONSTRAINT Client_PK PRIMARY KEY (id_client),
    CONSTRAINT Client_Type_de_client_FK FOREIGN KEY (id_type_de_client) REFERENCES Type_de_client(id_type_de_client)
);

--Table option voiture--
CREATE TABLE Option_voiture (
    id_option INT NOT NULL,
    libelle VARCHAR(100) NOT NULL,
    CONSTRAINT Option_PK PRIMARY KEY (id_option)
);

--Table catégorie de voiture--
CREATE TABLE Categorie (
    id_categorie INT(1) NOT NULL,
    libelle VARCHAR(50) NOT NULL,
    CONSTRAINT Categorie_PK PRIMARY KEY (id_categorie)
);

--Table marqque de voiture--
CREATE TABLE Marque (
    id_marque INT NOT NULL,
    libelle VARCHAR(50) NOT NULL,
    CONSTRAINT Marque_PK PRIMARY KEY (id_marque)
);

--Table modele de voiture--
CREATE TABLE Modele (
    id_modele INT NOT NULL,
    libelle VARCHAR(50) NOT NULL,
    id_categorie INT(1) NOT NULL,
    id_marque INT NOT NULL,
    CONSTRAINT Modele_PK PRIMARY KEY (id_modele),
    CONSTRAINT Modele_Categorie_FK FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie),
    CONSTRAINT Modele_Marque_FK FOREIGN KEY (id_marque) REFERENCES Marque(id_marque)
);

--Table Peinture d'anime--
CREATE TABLE PeintureAnime (
    id_peinture INT NOT NULL,
    libelle VARCHAR(100) NOT NULL,
    artiste VARCHAR(100),
    date_creation DATE,
    CONSTRAINT PeintureAnime_PK PRIMARY KEY (id_peinture)
);

--Table voiture--
CREATE TABLE Voiture (
    id_voiture INT NOT NULL,
    immatriculation VARCHAR(50) NOT NULL,
    compteur INT NOT NULL,
    prix INT NOT NULL,
    image varchar(20) NOT NULL,
    id_modele INT NOT NULL,
    id_peinture INT,
    CONSTRAINT Voiture_PK PRIMARY KEY (id_voiture),
    CONSTRAINT Voiture_Modele_FK FOREIGN KEY (id_modele) REFERENCES Modele(id_modele),
    CONSTRAINT Voiture_Peinture_FK FOREIGN KEY (id_peinture) REFERENCES PeintureAnime(id_peinture)
);

--Table location de voiture--
CREATE TABLE Location (
    id_location INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    compteur_debut INT NOT NULL,
    compteur_fin INT NOT NULL,
    id_client INT NOT NULL,
    id_voiture INT NOT NULL,
    CONSTRAINT Location_PK PRIMARY KEY (id_location),
    CONSTRAINT Location_Client_FK FOREIGN KEY (id_client) REFERENCES Client(id_client),
    CONSTRAINT Location_Voiture_FK FOREIGN KEY (id_voiture) REFERENCES Voiture(id_voiture)
);


CREATE TABLE choix (
    id_option INT NOT NULL,
    id_location INT NOT NULL,
    CONSTRAINT choix_PK PRIMARY KEY (id_option, id_location),
    CONSTRAINT choix_Option_FK FOREIGN KEY (id_option) REFERENCES Option_voiture(id_option),
    CONSTRAINT choix_Location_FK FOREIGN KEY (id_location) REFERENCES Location(id_location)
);