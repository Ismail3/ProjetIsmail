DROP TABLE IF EXISTS SeanceDemandeCours;
DROP TABLE IF EXISTS SeancePropositionCours;
DROP TABLE IF EXISTS DemandeCours;
DROP TABLE IF EXISTS PropositionCours;
DROP TABLE IF EXISTS Eleve;
DROP TABLE IF EXISTS Enseigner;
DROP TABLE IF EXISTS Enseignant;
DROP TABLE IF EXISTS TypeEnseignant;
DROP TABLE IF EXISTS NiveauEtude;
DROP TABLE IF EXISTS Matiere;
DROP TABLE IF EXISTS Filiaire;

CREATE TABLE Filiaire (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    CONSTRAINT PK_Filiaire PRIMARY KEY (id)
);

CREATE TABLE Matiere (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    CONSTRAINT PK_Matiere PRIMARY KEY (id)
);

CREATE TABLE NiveauEtude (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    CONSTRAINT PK_NiveauEtude PRIMARY KEY (id)
);

CREATE TABLE TypeEnseignant (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    CONSTRAINT PK_TypeEnseignant PRIMARY KEY (id)
);

CREATE TABLE Enseignant (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    prenom varchar(255),
    date_naissance date,
    mot_de_passe int,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    type_enseignant int,
    CONSTRAINT PK_Enseignant PRIMARY KEY (id),
    CONSTRAINT FK_Enseignant_TypeEnseignant FOREIGN KEY (type_enseignant)
    REFERENCES TypeEnseignant(id)
);


CREATE TABLE Enseigner (
    matiere int,
    niveau_etude int,
    enseignant int,
    CONSTRAINT PK_Matiere PRIMARY KEY (matiere,niveau_etude,enseignant),
    CONSTRAINT FK_Enseigner_Matiere FOREIGN KEY (matiere)
    REFERENCES Matiere(id),
    CONSTRAINT FK_Enseigner_Niveau FOREIGN KEY (niveau_etude)
    REFERENCES NiveauEtude(id),
    CONSTRAINT FK_Enseigner_Engseignant FOREIGN KEY (enseignant)
    REFERENCES Enseignant(id)
);


CREATE TABLE Eleve (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    prenom varchar(255),
    date_naissance date,
    mot_de_passe int,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    niveau_etude int,
    filiaire INT,
    CONSTRAINT PK_Enseignant PRIMARY KEY (id),
    CONSTRAINT FK_Eleve_Filiaire FOREIGN KEY (filiaire)
    REFERENCES Matiere(id),
    CONSTRAINT FK_Eleve_NiveauEtude FOREIGN KEY (niveau_etude)
    REFERENCES NiveauEtude(id)
);

CREATE TABLE PropositionCours (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    description text,
    tarif float,
    date_proposition DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_auteur int,
    matiere int,
    niveau_etude int,
    CONSTRAINT PK_PropositionCours PRIMARY KEY (id),
    CONSTRAINT FK_PropositionCours_Auteur FOREIGN KEY (id_auteur)
    REFERENCES Enseignant(id),
    CONSTRAINT FK_PropositionCours_Matiere FOREIGN KEY (matiere)
    REFERENCES Matiere(id),
    CONSTRAINT FK_PropositionCours_NiveauEtude FOREIGN KEY (niveau_etude)
    REFERENCES NiveauEtude(id)
);

CREATE TABLE SeancePropositionCours (
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_realisation DATETIME,
    proposition_cours int,
    eleve int,
    duree int,
    etat int,
    CONSTRAINT PK_SeancePropositionCours PRIMARY KEY (proposition_cours,eleve,date_realisation),
    CONSTRAINT FK_SeancePropositionCours_Cours FOREIGN KEY (proposition_cours)
    REFERENCES PropositionCours(id),
    CONSTRAINT FK_SeancePropositionCours_Eleve FOREIGN KEY (eleve)
    REFERENCES Eleve(id)
);

CREATE TABLE DemandeCours (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255),
    description text,
    tarif float,
    date_demande DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_auteur int,
    matiere int,
    niveau_etude int,
    CONSTRAINT PK_DemandeCours PRIMARY KEY (id),
    CONSTRAINT FK_DemandeCours_Auteur FOREIGN KEY (id_auteur)
    REFERENCES Eleve(id),
    CONSTRAINT FK_DemandeCours_Matiere FOREIGN KEY (matiere)
    REFERENCES Matiere(id),
    CONSTRAINT FK_DemandeCours_NiveauEtude FOREIGN KEY (niveau_etude)
    REFERENCES NiveauEtude(id)
);

CREATE TABLE SeanceDemandeCours (
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_realisation DATETIME,
    proposition_cours int,
    enseignant int,
    duree int,
    etat int,
    CONSTRAINT PK_SeanceDemandeCours PRIMARY KEY (proposition_cours,enseignant,date_realisation),
    CONSTRAINT FK_SeanceDemandeCours_Cours FOREIGN KEY (proposition_cours)
    REFERENCES DemandeCours(id),
    CONSTRAINT FK_SeanceDemandeCours_Enseignant FOREIGN KEY (enseignant)
    REFERENCES Enseignant(id)
);

show tables;

DESC SeanceDemandeCours;
DESC SeancePropositionCours;
DESC DemandeCours;
DESC PropositionCours;
DESC Eleve;
DESC Enseigner;
DESC Enseignant;
DESC TypeEnseignant;
DESC NiveauEtude;
DESC Matiere;
DESC Filiaire;
