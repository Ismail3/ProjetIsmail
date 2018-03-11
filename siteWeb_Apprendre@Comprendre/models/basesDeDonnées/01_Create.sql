DROP TABLE IF EXISTS SeanceDemandeCours;
DROP TABLE IF EXISTS SeancePropositionCours;
DROP TABLE IF EXISTS DemandeCours;
DROP TABLE IF EXISTS PropositionCours;
DROP TABLE IF EXISTS Eleve;
DROP TABLE IF EXISTS Enseigner;
DROP TABLE IF EXISTS Personne;
DROP TABLE IF EXISTS Enseignant;
DROP TABLE IF EXISTS Ressource;
DROP TABLE IF EXISTS TypeRessource;
DROP TABLE IF EXISTS NiveauEtude;
DROP TABLE IF EXISTS Matiere;
DROP TABLE IF EXISTS Message;

CREATE TABLE Matiere (
  id  INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255),
  CONSTRAINT PK_Matiere PRIMARY KEY (id)
);

CREATE TABLE NiveauEtude (
  id    INT NOT NULL AUTO_INCREMENT,
  nom   VARCHAR(255),
  value INT NOT NULL,
  CONSTRAINT PK_NiveauEtude PRIMARY KEY (id)
);

CREATE TABLE Personne (
  id               INT NOT NULL AUTO_INCREMENT,
  nom              VARCHAR(255),
  prenom           VARCHAR(255),
  date_naissance   DATE,
  mot_de_passe     VARCHAR(255),
  date_inscription DATETIME     DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT PK_Personne PRIMARY KEY (id)
);


CREATE TABLE Enseignant (
  id              INT NOT NULL AUTO_INCREMENT,
  idPersonne      INT NOT NULL,
  description TEXT,
  CONSTRAINT PK_Enseignant PRIMARY KEY (id),
  CONSTRAINT FK_Enseignant_Personne FOREIGN KEY (idPersonne)
  REFERENCES Personne (id)
);


CREATE TABLE Enseigner (
  matiere      INT,
  niveau_etude INT,
  enseignant   INT,
  CONSTRAINT PK_Matiere PRIMARY KEY (matiere, niveau_etude, enseignant),
  CONSTRAINT FK_Enseigner_Matiere FOREIGN KEY (matiere)
  REFERENCES Matiere (id),
  CONSTRAINT FK_Enseigner_Niveau FOREIGN KEY (niveau_etude)
  REFERENCES NiveauEtude (id),
  CONSTRAINT FK_Enseigner_Engseignant FOREIGN KEY (enseignant)
  REFERENCES Enseignant (id)
);


CREATE TABLE Eleve (
  id           INT NOT NULL AUTO_INCREMENT,
  idPersonne   INT NOT NULL,
  niveau_etude INT,
  CONSTRAINT PK_Eleve PRIMARY KEY (id),
  CONSTRAINT FK_Eleve_Personne FOREIGN KEY (idPersonne)
  REFERENCES Personne (id),
  CONSTRAINT FK_Eleve_NiveauEtude FOREIGN KEY (niveau_etude)
  REFERENCES NiveauEtude (id)
);

CREATE TABLE PropositionCours (
  id               INT NOT NULL AUTO_INCREMENT,
  nom              VARCHAR(255),
  description      TEXT,
  tarif            FLOAT,
  date_proposition DATETIME     DEFAULT CURRENT_TIMESTAMP,
  id_auteur        INT,
  matiere          INT,
  niveau_etude     INT,
  CONSTRAINT PK_PropositionCours PRIMARY KEY (id),
  CONSTRAINT FK_PropositionCours_Auteur FOREIGN KEY (id_auteur)
  REFERENCES Enseignant (id),
  CONSTRAINT FK_PropositionCours_Matiere FOREIGN KEY (matiere)
  REFERENCES Matiere (id),
  CONSTRAINT FK_PropositionCours_NiveauEtude FOREIGN KEY (niveau_etude)
  REFERENCES NiveauEtude (id)
);

CREATE TABLE SeancePropositionCours (
  date_inscription  DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_realisation  DATETIME,
  proposition_cours INT,
  eleve             INT,
  duree             INT,
  etat              INT,
  CONSTRAINT PK_SeancePropositionCours PRIMARY KEY (proposition_cours, eleve, date_realisation),
  CONSTRAINT FK_SeancePropositionCours_Cours FOREIGN KEY (proposition_cours)
  REFERENCES PropositionCours (id),
  CONSTRAINT FK_SeancePropositionCours_Eleve FOREIGN KEY (eleve)
  REFERENCES Eleve (id)
);

CREATE TABLE DemandeCours (
  id           INT NOT NULL AUTO_INCREMENT,
  nom          VARCHAR(255),
  description  TEXT,
  tarif        FLOAT,
  date_demande DATETIME     DEFAULT CURRENT_TIMESTAMP,
  id_auteur    INT,
  matiere      INT,
  niveau_etude INT,
  CONSTRAINT PK_DemandeCours PRIMARY KEY (id),
  CONSTRAINT FK_DemandeCours_Auteur FOREIGN KEY (id_auteur)
  REFERENCES Eleve (id),
  CONSTRAINT FK_DemandeCours_Matiere FOREIGN KEY (matiere)
  REFERENCES Matiere (id),
  CONSTRAINT FK_DemandeCours_NiveauEtude FOREIGN KEY (niveau_etude)
  REFERENCES NiveauEtude (id)
);

CREATE TABLE SeanceDemandeCours (
  date_inscription  DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_realisation  DATETIME,
  proposition_cours INT,
  enseignant        INT,
  duree             INT,
  etat              INT,
  CONSTRAINT PK_SeanceDemandeCours PRIMARY KEY (proposition_cours, enseignant, date_realisation),
  CONSTRAINT FK_SeanceDemandeCours_Cours FOREIGN KEY (proposition_cours)
  REFERENCES DemandeCours (id),
  CONSTRAINT FK_SeanceDemandeCours_Enseignant FOREIGN KEY (enseignant)
  REFERENCES Enseignant (id)
);

CREATE TABLE TypeRessource (
  id  INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255),
  CONSTRAINT PK_TypeRessource PRIMARY KEY (id)
);

CREATE TABLE Ressource (
  id             INT NOT NULL AUTO_INCREMENT,
  nom            VARCHAR(255),
  description    TEXT,
  type_ressource INT,
  image          VARCHAR(255),
  CONSTRAINT PK_Ressource PRIMARY KEY (id),
  CONSTRAINT FK_Ressource_TypeRessource FOREIGN KEY (type_ressource)
  REFERENCES TypeRessource (id)
);


CREATE TABLE Message (
  id          INT NOT NULL AUTO_INCREMENT,
  value       TEXT,
  expediteur  INT,
  receveur    INT,
  date_envoie DATETIME     DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT PK_Message PRIMARY KEY (id),
  CONSTRAINT FK_Message_Expediteur FOREIGN KEY (expediteur)
  REFERENCES Personne (id),
  CONSTRAINT FK_Message_Receveur FOREIGN KEY (receveur)
  REFERENCES Personne (id)
);

SHOW TABLES;

DESC SeanceDemandeCours;
DESC SeancePropositionCours;
DESC DemandeCours;
DESC PropositionCours;
DESC Eleve;
DESC Enseigner;
DESC Enseignant;
DESC NiveauEtude;
DESC Matiere;
DESC Ressource;
DESC TypeRessource;
DESC Message;
