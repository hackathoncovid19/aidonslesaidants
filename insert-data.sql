/*
 source :
 - generation du mot de passe : https://argon2.online/
   * mdp  : p@$$w0rd
   * salt : rFO8oOrhjC1Q5qsP

 - generation des données
    * https://www.generatedata.com/?lang=fr#t1
*/

SELECT 'suppression des données' AS message;
DELETE FROM ticket;
DELETE FROM user;

SELECT 'insertion donnée user' AS message;
INSERT INTO user
  (id,username,password,roles)
VALUES
  (1, "muriel.user", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"
ROLE_USER\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (2, "maura.user", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"
ROLE_USER\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (3, "emmanuel.user", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"
ROLE_USER\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (4, "nes.user", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"
ROLE_USER\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (5, "samuel.user", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"
ROLE_USER\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (6, "guillaume.user", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"
ROLE_USER\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (7, "marion.user", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"
ROLE_USER\";}");

INSERT INTO user
  (id,username,password,roles)
VALUES
  (8, "muriel.admin", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"
ROLE_ADMIN\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (9, "maura.admin", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"
ROLE_ADMIN\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (10, "emmanuel.admin", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"
ROLE_ADMIN\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (11, "nes.admin", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"
ROLE_ADMIN\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (12, "samuel.admin", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"
ROLE_ADMIN\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (13, "guillaume.admin", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"
ROLE_ADMIN\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (14, "marion.admin", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"
ROLE_ADMIN\";}");

SELECT 'insertion donnée ticket' AS message;
INSERT INTO ticket
  (id,user_id,title,description,postcode,creation_date,assigned_Date,resolved_Date,contact)
VALUES
  (1, 5, "Demande de prêt de vélo pour se rendre à l'hôpital", "Besoin d'un vélo pour ma femme chirurgienne pour qu'elle puisse se rendre à l'hôpital tous les matins à 9h. Merci d'avance de nous contacter à antoine.theret@gmail.com. Nous nous organiserons pour mettre le vélo à disposition en respectant les règles barrières d'hygiène. ", "75017", "2020-03-21 15:49:14 ", NULL, NULL, "antoine.theret@gmail.com");
INSERT INTO ticket
  (id,user_id,title,description,postcode,creation_date,assigned_Date,resolved_Date,contact)
VALUES
  (2, 2, "Demande d'aide pour amener un chat chez le vétérinaire", "Mon mari est infirmier et m'a fait remonter la demande d'un de ces collègues pour amener son chat chez le vétérinaire, je ne peux pas me déplacer car je dois garder les enfants mais je m'occupe de faire le lien avec le collègues de mon mari. ", "78360", "2020-03-22 15:49:14 ", NULL, NULL, "alexi.michelin@gmail.com");
INSERT INTO ticket
  (id,user_id,title,description,postcode,creation_date,assigned_Date,resolved_Date,contact)
VALUES
  (3, 4, "Demande d'aide pour amener un chien chez le vétérinaire", "Mon mari est infirmier et m'a fait remonter la demande d'un de ces collègues pour amener son chat chez le vétérinaire, je ne peux pas me déplacer car je dois garder les enfants mais je m'occupe de faire le lien avec le collègues de mon mari. ",
    "78360", "2020-03-18 15:49:14 ", "2020-03-19 15:49:14 ", "2020-03-21 15:49:14 ", "alexi.michelin@gmail.com");
INSERT INTO ticket
  (id,user_id,title,description,postcode,creation_date,assigned_Date,resolved_Date,contact)
VALUES
  (4, 2, "Besoin d'une application pour gérer les temps d'attente dans les urgences", "Merci de me contacter pour plus d'info", "", "2020-03-18 15:49:14 ", "2020-03-19 15:49:14 ", NULL, "0667089997");
