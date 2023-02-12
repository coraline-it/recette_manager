-- Requêtes de création BDD et tables --`

DROP DATABASE IF EXISTS recette_blog; -- commande servant juste au début de la création de la BDD

CREATE DATABASE IF NOT EXISTS recette_blog;

USE recette_blog;

CREATE TABLE IF NOT EXISTS membre (
                                      idMembre BIGINT(20) AUTO_INCREMENT NOT NULL UNIQUE,
                                      pseudo VARCHAR(100) NOT NULL UNIQUE,
                                      nom VARCHAR(150) NOT NULL,
                                      email VARCHAR(255) NOT NULL,
                                      mdp VARCHAR(255) NOT NULL ,
                                      date_inscription DATETIME NOT NULL,

                                      PRIMARY KEY (idMembre)

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categorie (
                                         idCategorie BIGINT(20) AUTO_INCREMENT NOT NULL UNIQUE,
                                         nom VARCHAR(255) NOT NULL,

                                         PRIMARY KEY (idCategorie)

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS recette (
                                       idRecette BIGINT(20) AUTO_INCREMENT NOT NULL UNIQUE,
                                       titre VARCHAR(255) NOT NULL,
                                       description VARCHAR(255) NOT NULL,
                                       photo LONGBLOB NULL,
                                       date_creation DATETIME NOT NULL,
                                       idMembre BIGINT(20) NOT NULL,

                                       PRIMARY KEY (idRecette),

                                       CONSTRAINT FK_recette_idMembre
                                           FOREIGN KEY (idMembre)
                                               REFERENCES membre(idMembre)

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categorie_recette (
                                                 idCategorie_recette BIGINT(20) AUTO_INCREMENT NOT NULL UNIQUE,
                                                 idRecette BIGINT(20) NOT NULL,
                                                 idCategorie BIGINT(20) NOT NULL,

                                                 PRIMARY KEY (idCategorie_recette),

                                                 CONSTRAINT FK_categorie_recette_idRecette
                                                     FOREIGN KEY (idRecette)
                                                         REFERENCES recette(idRecette),

                                                 CONSTRAINT FK_categorie_recette_idCategorie
                                                     FOREIGN KEY (idCategorie)
                                                         REFERENCES categorie(idCategorie)

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS ingredient (
                                          idIngredient BIGINT(20) AUTO_INCREMENT NOT NULL UNIQUE,
                                          nom VARCHAR(255) NOT NULL,
                                          quantite INT(11) NOT NULL,
                                          unite VARCHAR(10) NOT NULL,
                                          idRecette BIGINT(20) NOT NULL,

                                          PRIMARY KEY (idIngredient),

                                          CONSTRAINT FK_ingredient_idRecette
                                              FOREIGN KEY (idRecette)
                                                  REFERENCES recette(idRecette)
                                                    ON DELETE CASCADE

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS commentaire (
                                           idCommentaire BIGINT(20) AUTO_INCREMENT NOT NULL UNIQUE,
                                           contenu VARCHAR(255) NOT NULL,
                                           dateCreation DATETIME NOT NULL,
                                           note INT(11),
                                           idRecette BIGINT(20) NOT NULL,
                                           idMembre BIGINT(20) NOT NULL,

                                           PRIMARY KEY (idCommentaire),

                                           CONSTRAINT FK_commentaire_idRecette
                                               FOREIGN KEY (idRecette)
                                                   REFERENCES recette(idRecette),

                                           CONSTRAINT  FK_commentaire_idMembre
                                               FOREIGN KEY (idMembre)
                                                   REFERENCES membre(idMembre)

) ENGINE=InnoDB;

-- Fin requêtes de création BDD et tables --

-- Requêtes d'insertion enregistrements dans les tables --
INSERT INTO membre (pseudo, nom, email, mdp, date_inscription)
VALUES ('sbouillet', 'bouillet', 'sbouillet@bouillet.fr', 'food', now());

INSERT INTO categorie (nom)
VALUES ("entree"),
       ("plat"),
       ("dessert");

INSERT INTO recette (titre, description, photo, date_creation, idMembre)
VALUES ("Tartiflette",
        "La tartiflette savoyarde est un gratin de pommes de terre avec du Reblochon fondu dessus",
        "tartiflette.jpg",now(),1),
       ("Velouté de carottes au cumin", "Un velouté de carotte au cumin",
        "veloute-de-carotte-aucumin.jpg",now(),1);

INSERT INTO ingredient (nom, quantite, unite, idRecette)
VALUES ("Pommes de terre",750,"g",1),
       ("Reblochon",1,"u",1),
       ("Lardons",200,"g",1),
       ("Crème fraiche épaisse",3,"cs",1),
       ("Oignons",2,"u",1),
       ("Beurre",2,"u",1),
       ("Sel",1,"cc",1),
       ("Poivre",1,"p",1),
       ("Carotte",800,"g",2),
       ("Oignons",1,"u",2),
       ("Bouillon de volaille",1,"l",2),
       ("Cumin",1,"cs",2),
       ("Crème fraîche épaisse",2,"cs",2),
       ("Huile d'olive",2,"cs",2),
       ("Sel",1,"cc",2),
       ("Poivre",1,"p",2);

INSERT INTO categorie_recette (idRecette, idCategorie)
VALUES (1,2),
       (2,1);

INSERT INTO commentaire (contenu, dateCreation, note, idRecette, idMembre)
VALUES ("Super recette réconfortante",now(),9,1,1),
       ("Recette simple et gourmande, jamais déçu par une tartiflette :D",now(),8,1,1),
       ("Bon, une bonne découverte",now(),7,2,1),
       ("Pas très savoureux, gras pour pas grand chose",now(),4,2,1);

-- Fin requêtes d'insertion enregistrements dans les tables --

-- Requêtes de recherches dans la BDD --

-- 1) Afficher le nombre de membres
SELECT COUNT(*) AS nb_de_membre FROM membre;

-- 2) Afficher le titre des recettes, et le nom du membre qui a été précédemment créé
SELECT r.titre, m.nom FROM recette as r, membre as m ORDER BY m.nom, date_inscription DESC;

-- 3) Afficher le nom, la quantité, l’unité des ingrédients de la recette Tartiflette
SELECT i.nom, i.quantite, i.unite FROM ingredient i, recette r WHERE r.titre LIKE "%Tartiflette";

-- 4) Afficher l’id et le titre des recettes de la catégorie Plat principal
SELECT r.idRecette, r.titre FROM recette r, categorie c, categorie_recette cr
WHERE r.idRecette = cr.idRecette AND cr.idCategorie = c.idCategorie
  AND c.nom LIKE "%Plat principal%";

-- 5) Afficher l’auteur, le contenu et la note des commentaires de la recette du Velouté de carottes au cumin
SELECT c.idMembre, c.contenu, c.note FROM commentaire c, recette r, membre m
WHERE  c.idRecette = r.idRecette AND c.idMembre = m.idMembre
  AND r.titre LIKE "%Velouté%";

-- 6) Afficher la moyenne des notes pour les 2 recettes (utiliser la fonction AVG)
SELECT AVG(c.note) moyenne, r.titre
FROM commentaire c, recette r
WHERE c.idRecette = r.idRecette
GROUP BY r.idRecette;

-- Fin requêtes de recherches dans la BDD --

