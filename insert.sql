INSERT INTO categorie(titre, motscles) VALUES
('Emploi', 'offre d\'emploi'),
('Véhicule','voiture, moto, bateau, vélo, équipement'),
('Immobilier','vente, location, colocation, bureau, logement'),
('Vacances','camping, hôtel, hôte'),
('Multimedia','jeux vidéos, informatique, image, son, smartphone'),
('Loisirs','film, musique, livre'),
('Matériel','outillage, fourniture de bureau'),
('Services','prestation de services, événement'),
('Maison','meuble, électroménager, bricolage, jardinage'),
('Vêtements','jeans, chemise, robe, jupe, chaussures'),
('Autre','divers');

INSERT INTO membre(pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement) VALUES
('celine', 'pass', 'zanier', 'celine', '0120504060', 'celinezanier@email.com', 'f', 1, now() ),
('guillaume', 'pass', 'druet', 'guillaume', '0140802010', 'guillaumedruet@email.com', 'm', 1, now() ),
('xuan', 'pass', 'nguyen', 'xuan', '0145784512', 'xuannguyen@email.com', 'f', 1, now() ),
('annarose', 'pass', 'rose', 'anna', '0356457889', 'anarose@yahoo.fr', 'f', 0, now() ),
('katie','pass', 'collins', 'katie', '0504129584', 'kate@voila.fr', 'f', 0, now() ),
('simone', 'pass', 'segoli', 'simone', '0698784556', 'simone@hotmail.fr', 'f', 0, now() ),
('barnes', 'pass', 'bone', 'barnes', '0745890214', 'bbone@gmail.com', 'm', 0, now() ),
('sully', 'pass', 'smart', 'sully', '0756124582', 'sullie@orange.com', 'm', 0, now() ),
('romeo', 'pass', 'rhino', 'roméo', '0165892030',  'rhinoromeo@yahoo.com', 'm', 0, now() ),
('juliet', 'pass', 'jones', 'juliet', '0745180214', 'juliet@hotmail.com', 'f', 0, now() ),
('morty', 'pass', 'moutarde', 'morty', '0145968701', 'morty@yahoo.com', 'm', 0, now() );