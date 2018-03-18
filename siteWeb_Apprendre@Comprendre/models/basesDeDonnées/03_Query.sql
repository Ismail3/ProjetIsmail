/*
mysql> show tables;
+-----------------------------------+
| Tables_in_db_apprendreAcomprendre |
+-----------------------------------+
| Cours                             |
| Eleve                             |
| Enseignant                        |
| Enseigner                         |
| Matiere                           |
| Message                           |
| NiveauEtude                       |
| Personne                          |
| Ressource                         |
| SeanceCours                       |
| TypeRessource                     |
+-----------------------------------+
11 rows in set (0,00 sec)
*/

/*
  Élèves

mysql> desc Personne;
+------------------+--------------+------+-----+-------------------+----------------+
| Field            | Type         | Null | Key | Default           | Extra          |
+------------------+--------------+------+-----+-------------------+----------------+
| id               | int(11)      | NO   | PRI | NULL              | auto_increment |
| nom              | varchar(255) | YES  |     | NULL              |                |
| prenom           | varchar(255) | YES  |     | NULL              |                |
| email            | varchar(255) | YES  |     | NULL              |                |
| date_naissance   | date         | YES  |     | NULL              |                |
| mot_de_passe     | varchar(255) | YES  |     | NULL              |                |
| date_inscription | datetime     | YES  |     | CURRENT_TIMESTAMP |                |
+------------------+--------------+------+-----+-------------------+----------------+
7 rows in set (0,00 sec)

mysql> desc Eleve;
+--------------+---------+------+-----+---------+----------------+
| Field        | Type    | Null | Key | Default | Extra          |
+--------------+---------+------+-----+---------+----------------+
| id           | int(11) | NO   | PRI | NULL    | auto_increment |
| id_personne  | int(11) | NO   | MUL | NULL    |                |
| niveau_etude | int(11) | YES  | MUL | NULL    |                |
+--------------+---------+------+-----+---------+----------------+
3 rows in set (0,00 sec)

mysql> desc NiveauEtude;
+-------+--------------+------+-----+---------+----------------+
| Field | Type         | Null | Key | Default | Extra          |
+-------+--------------+------+-----+---------+----------------+
| id    | int(11)      | NO   | PRI | NULL    | auto_increment |
| nom   | varchar(255) | YES  |     | NULL    |                |
+-------+--------------+------+-----+---------+----------------+
2 rows in set (0,00 sec)
 */


/*
  Connexion utilisateur
*/

-- Connexion personne
SELECT id , type_personne
FROM Personne P
WHERE P.email='garsha.guillaume@exmpmail.com'
      and P.mot_de_passe='password'
;


-- Profil eleve
SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,NE.nom as niveau_etude
FROM Eleve E, NiveauEtude NE, Personne P
WHERE E.id_personne = P.id
      and E.niveau_etude = NE.id
      and P.id = 999
;

-- Profil enseignant
SELECT P.id as id,P.nom as nom,prenom,email,date_naissance
FROM Enseignant E, Personne P
WHERE E.id_personne = P.id
      and P.id = 1001
;



/*
  Inscription utilisateur
*/
INSERT INTO Personne (nom, prenom, email, date_naissance, mot_de_passe)
VALUES ('SOSSE ALAOUI','Ismail','ismail34alaoui@gmail.com','1989-04-22','password')
;

SELECT id
FROM Personne
WHERE email = 'ismail34alaoui@gmail.com'
;

INSERT INTO Eleve (id_personne)
VALUES (1100)
;

INSERT INTO Enseignant (id_personne)
VALUES (1100)
;


/*
  Profil
 */


-- Profil Enseignant

SELECT P.id as id,P.nom as nom,prenom,email,date_naissance
FROM Enseignant E, Personne P
WHERE E.id_personne = P.id
      and P.id = 1001
;

UPDATE Personne
SET nom='MENARD', prenom='MENARD',email='ibraheem.menard@exmpmail.com',date_naissance='1974-03-26'
WHERE id=1001
;

-- Profil Eleve

SELECT

/*
  Tableau de bord Enseignant;
 */


-- Matière enseigner
SELECT E.enseignant, M.nom as matiere, NE.nom as niveau_etude, max(NE.id) as id_niveau_etude
FROM Enseigner E, Matiere M, NiveauEtude NE
WHERE E.enseignant = 1099 and E.matiere = M.id and E.niveau_etude = NE.id
ORDER BY matiere
;

-- Liste des cours
SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur, C.matiere, C.niveau_etude_min, C.niveau_etude_max, M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom
FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax
WHERE C.id_auteur = 1001 and M.id = C.matiere and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
ORDER BY date_creation DESC
LIMIT 10;

-- Liste des seances Proposition

SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
P.nom as nom_participant,P.prenom as prenom_participant,P.email as email_participant,P.date_naissance as date_naissance_participant, P.type_personne as type_personne_participant
FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
WHERE C.id_auteur = 1001 and M.id = C.matiere
and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
and S.proposition_cours = C.id and P.id = S.participant
ORDER BY date_realisation DESC
LIMIT 10;

-- Liste des seances Demande

SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
P.nom as nom_auteur,P.prenom as prenom_auteur,P.email as email_auteur,P.date_naissance as date_naissance_auteur, P.type_personne as type_personne_auteur
FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
WHERE S.participant = 1001 and M.id = C.matiere
and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
and S.proposition_cours = C.id and P.id = C.id_auteur
ORDER BY date_realisation DESC
LIMIT 10;

/*
  Liste des élèves
*/
SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,NE.nom as niveau_etude
FROM Eleve E, NiveauEtude NE, Personne P
WHERE E.id_personne = P.id and E.niveau_etude = NE.id
LIMIT 10
;



