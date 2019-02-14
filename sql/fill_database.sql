-- AJOUT DE DONNEES
-- ****************

-- Survey questions
-- Contenu
INSERT INTO question_type (libelle, type) VALUES ("Le contenu du cours est satisfaisant pour mon orientation professionnelle.", "Contenu");
INSERT INTO question_type (libelle, type) VALUES ("J’ai compris les objectifs et l’importance de ce cours.", "Contenu");
INSERT INTO question_type (libelle, type) VALUES ("J’ai compris le programme de ce cours.", "Contenu");
INSERT INTO question_type (libelle, type) VALUES ("Je sais ce que je dois apprendre et sur quoi je serais jugé à l’examen.", "Contenu");
INSERT INTO question_type (libelle, type) VALUES ("Les ressources n´ecessaires me semblent appropriées et disponibles.", "Contenu");
-- Déroulement
INSERT INTO question_type (libelle, type) VALUES ("Le cours est bien équilibré entre éléments de théorie, exemples et applications.", "Deroulement");
INSERT INTO question_type (libelle, type) VALUES ("J'ai compris quels sont les objectifs de chaque séance.", "Deroulement");
INSERT INTO question_type (libelle, type) VALUES ("Le déroulement des cours, TD, TP reflète la difficulté et l'importance des sujets traités.", "Deroulement");
INSERT INTO question_type (libelle, type) VALUES ("Le travail en cours, TD, TP prépare correctement à l'examen.", "Deroulement");
INSERT INTO question_type (libelle, type) VALUES ("Le volume horaire reflète l'importance de la matière.", "Deroulement");
-- Activités (TD, TP, projet)
INSERT INTO question_type (libelle, type) VALUES ("Je sais quelles sont les activités que l'on attend de moi.", "TD_TP_Projet");
INSERT INTO question_type (libelle, type) VALUES ("J'ai compris quels sont les critères et directives de ces activités.", "TD_TP_Projet");
INSERT INTO question_type (libelle, type) VALUES ("Je sais quels sont les objectifs évalués par ces activités.", "TD_TP_Projet");
INSERT INTO question_type (libelle, type) VALUES ("Ces activités sont ordonnées en fonction de leur difficulté croissante", "TD_TP_Projet");
INSERT INTO question_type (libelle, type) VALUES ("Ces activités me permettent de vérifier ma progression.", "TD_TP_Projet");
-- Présentation
INSERT INTO question_type (libelle, type) VALUES ("L'enseignant présente la matière de façon claire et structurée.", "Presentation");
INSERT INTO question_type (libelle, type) VALUES ("Les supports de cours me sont utiles.", "Presentation");
INSERT INTO question_type (libelle, type) VALUES ("L'enseignant s'assure que les notions sont bien assimilées.", "Presentation");
INSERT INTO question_type (libelle, type) VALUES ("L'enseignant semble soucieux d'améliorer son cours.", "Presentation");
INSERT INTO question_type (libelle, type) VALUES ("L'enseignant est suffisamment disponible", "Presentation");
