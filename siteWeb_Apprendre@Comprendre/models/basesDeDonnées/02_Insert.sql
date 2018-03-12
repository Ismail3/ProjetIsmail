LOAD DATA INFILE "personne_eleve.csv" IGNORE
INTO TABLE Personne
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY ''
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id,nom,prenom,email,date_naissance,mot_de_passe,date_inscription);


LOAD DATA INFILE "niveauEtude.csv" IGNORE
INTO TABLE NiveauEtude
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY ''
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id, nom);

LOAD DATA INFILE "eleve.csv" IGNORE
INTO TABLE Eleve
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY ''
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id_personne,niveau_etude);


LOAD DATA INFILE "personne_enseignant.csv" IGNORE
INTO TABLE Personne
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY ''
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id,nom,prenom,email,date_naissance,mot_de_passe,date_inscription);

LOAD DATA INFILE "enseignant.csv" IGNORE
INTO TABLE Enseignant
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY ''
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id_personne,description);

LOAD DATA INFILE "matiere.csv" IGNORE
INTO TABLE Matiere
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY '"'
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id, nom);

LOAD DATA INFILE "cours_enseignant.csv" IGNORE
INTO TABLE Cours
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY '"'
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id,nom,description,tarif,date_creation,id_auteur,matiere,niveau_etude_min,niveau_etude_max);

LOAD DATA INFILE "seance_cours_enseignant.csv" IGNORE
INTO TABLE SeanceCours
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY '"'
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(date_inscription,date_realisation,proposition_cours,participant,duree,etat);


LOAD DATA INFILE "cours_eleve.csv" IGNORE
INTO TABLE Cours
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY '"'
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id,nom,description,tarif,date_creation,id_auteur,matiere,niveau_etude_min,niveau_etude_max);


LOAD DATA INFILE "seance_cours_eleve.csv" IGNORE
INTO TABLE SeanceCours
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY ''
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(date_inscription,date_realisation,proposition_cours,participant,duree,etat);

LOAD DATA INFILE "enseigner.csv" IGNORE
INTO TABLE Enseigner
COLUMNS TERMINATED BY ','
OPTIONALLY ENCLOSED BY ''
ESCAPED BY ''
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(matiere,niveau_etude,enseignant);






/*

https://dev.mysql.com/doc/refman/5.7/en/load-data.html


13.2.6 LOAD DATA INFILE Syntax
LOAD DATA [LOW_PRIORITY | CONCURRENT] [LOCAL] INFILE 'file_name'
    [REPLACE | IGNORE]
    INTO TABLE
    [PARTITION (partition_name [, partition_name] ...)]
    [CHARACTER SET charset_name]
    [{FIELDS | COLUMNS}
        [TERMINATED BY 'string']
        [[OPTIONALLY] ENCLOSED BY 'char']
        [ESCAPED BY 'char']
    ]
    [LINES
        [STARTING BY 'string']
        [TERMINATED BY 'string']
    ]
    [IGNORE number {LINES | ROWS}]
    [(col_name_or_user_var
        [, col_name_or_user_var] ...)]
    [SET col_name={expr | DEFAULT},
        [, col_name={expr | DEFAULT}] ...]
The LOAD DATA INFILE statement reads rows from a text file into a table at a very high speed. LOAD DATA INFILE is the complement of SELECT ... INTO OUTFILE. (See Section 13.2.9.1, “SELECT ... INTO Syntax”.) To write data from a table to a file, use SELECT ... INTO OUTFILE. To read the file back into a table, use LOAD DATA INFILE. The syntax of the FIELDS and LINES clauses is the same for both statements. Both clauses are optional, but FIELDS must precede LINES if both are specified.
*/