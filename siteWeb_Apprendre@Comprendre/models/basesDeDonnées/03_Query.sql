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

 SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,NE.nom as niveau_etude
 FROM Eleve E, NiveauEtude NE, Personne P
 WHERE E.id_personne = P.id and E.niveau_etude = NE.id
 LIMIT 10
 ;



