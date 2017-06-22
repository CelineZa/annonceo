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

INSERT INTO annonce(titre, description, prix, photo, pays, ville, adresse, cp, membre_id, photo_id, categorie_id, date_enregistrement) VALUES
('Samsung galaxy 8', 'Vend smartphone occasion comme neuf', 650, 'http://www.pierre-morange.fr/wp-content/uploads/Samsung-Galaxy-8.jpg', 'France', 'Paris', '3 rue Sébastopol', '75012', '4', '', '5', now() ),
('iPhone 6', 'Débloqué et état correct', 600, 'http://fr.ubergizmo.com/wp-content/uploads/2016/01/ios-9-3-mode-affichage-nuit.jpg', 'France', 'Paris', '16 du du Tage', '75013', '5', '', '5', now() ),
('Nokia 3310', 'Pour collection', 50, 'https://sd-cdn.fr/wp-content/uploads/2017/02/10171299-16581930.jpg', 'France', 'Paris', '3 rue de la Roquette', '75011', '6', '', '5', now() ),
('Samsung A3 2016', 'Je vends mon smartphone', 150, 'https://fscl01.fonpit.de/userfiles/6727621/image/2016/Samsung-Galaxy-A3/AndroidPIT-Samsung-Galaxy-A3-2016-2-w782.jpg', 'France', 'Paris', '44 rue des Ternes', '75008', '7', '', '5', now() ),
('iPad air', 'Légères rayures', 260, 'http://img.igen.fr/2014/10/macgpic-1414139350-14370387389319-op.jpg', 'France', 'Paris', '1 plade d\'Italie', '75013', '8', '', '5', now() ),
('tamagotchi', 'Jouet vintage en parfait état', 80, 'http://static.hitek.fr/img/actualite/2017/04/11/fb_57081-01-tamagotchi-making-comeback-20-years.jpeg', 'France', 'Paris', '1 plade d\'Italie', '75013', '8', '', '5', now() ),
('tamagotchi', 'Jouet vintage coloris rouge', 60, 'http://www.wikihow.com/images/2/22/Awaken-Your-Inner-Tamagotchi-Obsession-Step-15.jpg', 'France', 'Paris', '1 plade d\'Italie', '75013', '8', '', '5', now() ),
('tamagotchi', 'Elevez un dinosaure', 70, 'http://i220.photobucket.com/albums/dd185/JC1andTC1DinkieLog/DinoBanner.jpg', 'France', 'Paris', '1 plade d\'Italie', '75013', '8', '', '5', now() ),
('SuperNintendo + 1jeu', 'Console vintage en bon état', 120, 'http://www.jeuxactu.com/datas/constructeurs/n/i/nintendo/vn/nintendo-58639887e52b7.jpg', 'France', 'Paris', '19 rue de Bercy', '75012', '9', '', '5', now() ),
('Gameboy color', 'Coloris jaune', 90, 'https://i.ytimg.com/vi/OoBGyxlobw8/maxresdefault.jpg', 'France', 'Paris', '19 rue de Bercy', '75012', '9', '', '5', now() ),
('Tetris gameboy color', 'Le jeu mythique !', 25, 'https://images-na.ssl-images-amazon.com/images/I/71nszXEf9eL._SX342_.jpg', 'France', 'Paris', '19 rue de Bercy', '75012', '9', '', '5', now() ),
('Joli arrosoir', 'Long bec', 30, 'https://www.bonjourbibiche.com/395/arrosoir-interieur-vert-wild-wolf.jpg', 'France', 'Paris', '8 square victoria', '75006', '10', '', '9', now() ),
('Pot pour bonsai', 'Idéal pour un bonsai de 5-6 ans', 16, 'http://www.paris-bonsai.com/media/catalog/product/cache/5/image/9df78eab33525d08d6e5fb8d27136e95/i/m/img_4471.jpg', 'France', 'Paris', '8 square victoria', '75006', '10', '', '9', now() ),
('Pot pour bonsai', 'En porcelaine', 42, 'http://www.jardibonsai.com/im/articles/PotOval08-30-1.jpg', 'France', 'Paris', '8 square victoria', '75006', '10', '', '9', now() ),
('Bottes de jardinage femme', 'Taille 37', 10, 'https://www.decathlon.fr/media/811/8110751/classic_b86b5ba325a74bf3b5980633bd7d9e85.jpg', 'France', 'Paris', '8 square victoria', '75006', '10', '', '9', now() );