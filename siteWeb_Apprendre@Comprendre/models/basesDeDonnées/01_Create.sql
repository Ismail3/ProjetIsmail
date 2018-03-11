DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS SeanceCours;
DROP TABLE IF EXISTS Cours;
DROP TABLE IF EXISTS Eleve;
DROP TABLE IF EXISTS Enseigner;
DROP TABLE IF EXISTS Enseignant;
DROP TABLE IF EXISTS Personne;
DROP TABLE IF EXISTS Ressource;
DROP TABLE IF EXISTS TypeRessource;
DROP TABLE IF EXISTS NiveauEtude;
DROP TABLE IF EXISTS Matiere;

CREATE TABLE Matiere (
  id  INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255),
  CONSTRAINT PK_Matiere PRIMARY KEY (id)
);

CREATE TABLE NiveauEtude (
  id  INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255),
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
  id          INT NOT NULL AUTO_INCREMENT,
  id_personne INT NOT NULL,
  description TEXT,
  CONSTRAINT PK_Enseignant PRIMARY KEY (id),
  CONSTRAINT FK_Enseignant_Personne FOREIGN KEY (id_personne)
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
  REFERENCES Personne (id)
);


CREATE TABLE Eleve (
  id           INT NOT NULL AUTO_INCREMENT,
  id_personne  INT NOT NULL,
  niveau_etude INT,
  CONSTRAINT PK_Eleve PRIMARY KEY (id),
  CONSTRAINT FK_Eleve_Personne FOREIGN KEY (id_personne)
  REFERENCES Personne (id),
  CONSTRAINT FK_Eleve_NiveauEtude FOREIGN KEY (niveau_etude)
  REFERENCES NiveauEtude (id)
);

CREATE TABLE Cours (
  id               INT NOT NULL AUTO_INCREMENT,
  nom              VARCHAR(255),
  description      TEXT,
  tarif            FLOAT,
  date_creation    DATETIME     DEFAULT CURRENT_TIMESTAMP,
  id_auteur        INT,
  matiere          INT,
  niveau_etude_min INT,
  niveau_etude_max INT,
  CONSTRAINT PK_Cours PRIMARY KEY (id),
  CONSTRAINT FK_Cours_Auteur FOREIGN KEY (id_auteur)
  REFERENCES Personne (id),
  CONSTRAINT FK_Cours_Matiere FOREIGN KEY (matiere)
  REFERENCES Matiere (id),
  CONSTRAINT FK_Cours_NiveauEtudeMin FOREIGN KEY (niveau_etude_min)
  REFERENCES NiveauEtude (id),
  CONSTRAINT FK_Cours_NiveauEtudeMax FOREIGN KEY (niveau_etude_max)
  REFERENCES NiveauEtude (id)
);

CREATE TABLE SeanceCours (
  date_inscription  DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_realisation  DATETIME,
  proposition_cours INT,
  participant       INT,
  duree             INT,
  etat              INT,
  CONSTRAINT PK_SeanceCours PRIMARY KEY (proposition_cours, participant, date_realisation),
  CONSTRAINT FK_SeanceCours_Cours FOREIGN KEY (proposition_cours)
  REFERENCES Cours (id),
  CONSTRAINT FK_SeanceCours_Personne FOREIGN KEY (participant)
  REFERENCES Personne (id)
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

DESC SeanceCours;
DESC Cours;
DESC Eleve;
DESC Enseigner;
DESC Enseignant;
DESC NiveauEtude;
DESC Matiere;
DESC Ressource;
DESC TypeRessource;
DESC Message;
