/*
 source :
 - generation du mot de passe : https://argon2.online/
   * mdp  : p@$$w0rd
   * salt : rFO8oOrhjC1Q5qsP

 - generation des données
    * https://www.generatedata.com/?lang=fr#t1
*/


DELETE FROM ticket;
DELETE FROM user;

INSERT INTO user
  (id,username,password,roles)
VALUES
  (1, "alaid.tech", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:9:\"ROLE_USER\";}");
INSERT INTO user
  (id,username,password,roles)
VALUES
  (2, "njmbmegcskmsndac", "$argon2id$v=19$m=65536,t=4,p=1$UHA1dVpYLlFsdTNoSTRZLg$+kZvbxK7OZ9muOJHZQ73peJFve4O8XSU05wUubhHGYs", "a:1:{i:0;s:10:\"ROLE_ADMIN\";}");


  INSERT INTO ticket
    (`id`,`user_id`,`status`,`title`,`description`,`postcode`,`contact`,`rgpd_accepted`,`creation_date`,`assigned_date`,`resolved_date`)
  VALUES
    (1,1,3,'Demande d\'aide pour amener un chat chez le vétérinaire','Ma femme est chirurgienne et m\'a fait remonter la demande d\'un de ces collègues pour amener son chat chez le vétérinaire, je ne peux pas me déplacer car je dois garder les enfants mais je m\'occupe de faire le lien avec le collègue de ma femme. ','78360','alexis.jtt@gmail.com',1,'2020-03-24 21:47:19',NULL,NULL);

  INSERT INTO ticket
    (`id`,`user_id`,`status`,`title`,`description`,`postcode`,`contact`,`rgpd_accepted`,`creation_date`,`assigned_date`,`resolved_date`)
  VALUES
    (2,1,3,'Demande d\'aide pour amener un chien chez le vétérinaire','Mon mari est infirmier et m\'a fait remonter la demande d\'une de ces collègues pour amener son chat chez le vétérinaire, je ne peux pas me déplacer car je dois garder les enfants mais je m\'occupe de faire le lien avec la collègue de mon mari.','78500','christian.thrt@gmail.com',1,'2020-03-27 21:47:19',NULL,'2020-03-25 00:00:27');

  INSERT INTO ticket
    (`id`,`user_id`,`status`,`title`,`description`,`postcode`,`contact`,`rgpd_accepted`,`creation_date`,`assigned_date`,`resolved_date`)
  VALUES
    (3,1,3,'Besoin d\'une application en ligne pour partager de gros volumes d’images d\'échographie de patients infectés','Merci de me contacter pour plus d\'informations.',NULL,'0699999999',1,'2020-03-24 21:47:19',NULL,NULL);

  INSERT INTO ticket
    (`id`,`user_id`,`status`,`title`,`description`,`postcode`,`contact`,`rgpd_accepted`,`creation_date`,`assigned_date`,`resolved_date`)
  VALUES
    (4,1,3,'Besoin d\'une webcam pour téléconsultation','Ma femme est médecin généraliste et nous ne sommes plus capable de faire de commandes en ligne pour une webcam. Quelqu\'un pourrait nous en envoyer une svp ? Merci d\'avance. ','78360','antoine.lsgn@gmail.com',1,'2020-03-24 21:47:19',NULL,NULL);

  INSERT INTO ticket
    (`id`,`user_id`,`status`,`title`,`description`,`postcode`,`contact`,`rgpd_accepted`,`creation_date`,`assigned_date`,`resolved_date`)
  VALUES
    (5,1,3,'Mon mari infirmier à domicile à besoin d\'un vélo pour se rendre chez ses patients','Mon mari infirmier à domicile à besoin d\'un vélo pour se rendre chez ses patients. Merci d\'avance de me contacter au plus vite, nous nous organiserons pour mettre le vélo à sa disposition en respectant les règles barrières d\'hygiène.','75017','remikoci@gmail.com',1,'2020-03-24 23:26:23','2020-03-27 23:28:40',NULL);

  INSERT INTO ticket
    (`id`,`user_id`,`status`,`title`,`description`,`postcode`,`contact`,`rgpd_accepted`,`creation_date`,`assigned_date`,`resolved_date`)
  VALUES
    (6,1,3,'Besoin d\'une application en ligne pour partager de gros volumes d’images d\'échographie de patients infectés','Merci de me contacter pour plus d\'informations',NULL,'0709090909',1,'2020-03-27 23:27:49',NULL,NULL);

  INSERT INTO ticket
    (`id`,`user_id`,`status`,`title`,`description`,`postcode`,`contact`,`rgpd_accepted`,`creation_date`,`assigned_date`,`resolved_date`)
  VALUES
    (7,1,3,'Ma soeur infirmière est dans l\'incapacité d\'aller chercher ses courses','Bonjour,\r\nMa soeur infirmière fait ses courses en ligne mais n\'a plus le temps d\'aller les chercher au drive de son magasin. J\'aimerai pouvoir l\'aider mais je ne suis pas véhiculer. N\'hésitez pas à m\'appeler au numéro de téléphone ci-joint.\r\nMerci pour elle !','75015','0799999999',1,'2020-03-27 23:41:05',NULL,NULL);
