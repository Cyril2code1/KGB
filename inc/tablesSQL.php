<?php
$tablesSQL=[
'DROP TABLE IF EXISTS specialities;',
'CREATE TABLE specialities(
   id_speciality INT AUTO_INCREMENT,
   name VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_speciality),
   UNIQUE(name)
);',

'DROP TABLE IF EXISTS administrators;',
'CREATE TABLE administrators(
   id_admin CHAR(36),
   admin_lastname VARCHAR(50) NOT NULL,
   admin_firstname VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL,
   creation_date DATE NOT NULL,
   PRIMARY KEY(id_admin),
   UNIQUE(email)
);',

'DROP TABLE IF EXISTS geo;',
'CREATE TABLE geo(
   id_geo INT AUTO_INCREMENT,
   country VARCHAR(50) NOT NULL,
   nationality VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_geo),
   UNIQUE(country),
   UNIQUE(nationality)
);',

'DROP TABLE IF EXISTS civils;',
'CREATE TABLE civils(
   id_civil CHAR(36),
   last_name VARCHAR(50) NOT NULL,
   first_name VARCHAR(50) NOT NULL,
   birth_date DATE NOT NULL,
   id_geo INT NOT NULL,
   PRIMARY KEY(id_civil),
   FOREIGN KEY(id_geo) REFERENCES geo(id_geo)
);',

'DROP TABLE IF EXISTS hideouts;',
'CREATE TABLE hideouts(
   code CHAR(36),
   address VARCHAR(255) NOT NULL,
   type VARCHAR(50) NOT NULL,
   id_geo INT NOT NULL,
   PRIMARY KEY(code),
   FOREIGN KEY(id_geo) REFERENCES geo(id_geo)
);',

'DROP TABLE IF EXISTS missions;',
'CREATE TABLE missions(
   id_mission CHAR(36),
   title VARCHAR(50) NOT NULL,
   description TEXT NOT NULL,
   code_name VARCHAR(50) NOT NULL,
   statut VARCHAR(50) NOT NULL,
   type VARCHAR(50) NOT NULL,
   start_date DATE NOT NULL,
   end_date DATE,
   id_speciality INT NOT NULL,
   id_geo INT NOT NULL,
   PRIMARY KEY(id_mission),
   FOREIGN KEY(id_speciality) REFERENCES specialities(id_speciality),
   FOREIGN KEY(id_geo) REFERENCES geo(id_geo)
);',

'DROP TABLE IF EXISTS agents;',
'CREATE TABLE agents(
   identification_code CHAR(10),
   id_civil CHAR(36) NOT NULL,
   PRIMARY KEY(identification_code),
   UNIQUE(id_civil),
   FOREIGN KEY(id_civil) REFERENCES civils(id_civil)
);',

'DROP TABLE IF EXISTS agentSkills;',
'CREATE TABLE agentSkills(
   id_speciality INT,
   identification_code CHAR(10),
   PRIMARY KEY(id_speciality, identification_code),
   FOREIGN KEY(id_speciality) REFERENCES specialities(id_speciality),
   FOREIGN KEY(identification_code) REFERENCES agents(identification_code)
);',

'DROP TABLE IF EXISTS activities;',
'CREATE TABLE activities(
   id_mission CHAR(36),
   identification_code CHAR(10),
   PRIMARY KEY(id_mission, identification_code),
   FOREIGN KEY(id_mission) REFERENCES missions(id_mission),
   FOREIGN KEY(identification_code) REFERENCES agents(identification_code)
);',

'DROP TABLE IF EXISTS fallbacks;',
'CREATE TABLE fallbacks(
   code CHAR(36),
   id_mission CHAR(36),
   PRIMARY KEY(code, id_mission),
   FOREIGN KEY(code) REFERENCES hideouts(code),
   FOREIGN KEY(id_mission) REFERENCES missions(id_mission)
);',

'DROP TABLE IF EXISTS targets;',
'CREATE TABLE targets(
   id_civil CHAR(36),
   id_mission CHAR(36),
   code_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_civil, id_mission),
   FOREIGN KEY(id_civil) REFERENCES civils(id_civil),
   FOREIGN KEY(id_mission) REFERENCES missions(id_mission)
);',

'DROP TABLE IF EXISTS contacts;',
'CREATE TABLE contacts(
   id_civil CHAR(36),
   id_mission CHAR(36),
   code_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_civil, id_mission),
   FOREIGN KEY(id_civil) REFERENCES civils(id_civil),
   FOREIGN KEY(id_mission) REFERENCES missions(id_mission)
);',

// create an admin default account for the first log, password_hash("Admin", PASSWORD_DEFAULT);
"INSERT INTO administrators (id_admin, admin_lastname, admin_firstname, email, password, creation_date)
VALUES(
    'e74891e4-c80e-4341-858f-0ff8f09f6a5e',
    'Admin',
    'Admin',
    'admin@void.ru',
    '$2y$10$1Nw8f/seghj3V3SRSOZXReoumMsb7UziRgIXWsS4u3.G.KC/oTPim',
    current_date
    );",


// more datas

"INSERT INTO `geo` (`id_geo`, `country`, `nationality`) VALUES
(1, 'Yougoslavie', 'yougoslave'),
(2, 'Afghanistan', 'afghane'),
(3, 'Albanie', 'albanaise'),
(4, 'Angola', 'angolaise'),
(5, 'Argentine', 'argentine'),
(6, 'Australie', 'australienne'),
(7, 'Autriche', 'autrichienne'),
(8, 'Barbade', 'barbadienne'),
(9, 'Belgique', 'belge'),
(10, 'Bhoutan', 'bhoutanaise'),
(11, 'Bolivie', 'bolivienne'),
(12, 'Bulgarie', 'bulgare'),
(13, 'Cambodge', 'cambodgienne'),
(14, 'Cameroun', 'camerounaise'),
(15, 'Canada', 'canadienne'),
(16, 'Tchad', 'tchadienne'),
(17, 'Chili', 'chilienne'),
(18, 'Colombie', 'colombienne'),
(19, 'Croatie', 'croate'),
(20, 'Cuba', 'cubaine'),
(21, 'Chypre', 'chypriote'),
(22, 'Danemark', 'danoise'),
(23, 'Djibouti', 'djiboutienne'),
(24, 'Dominique', 'dominicaine'),
(25, 'Estonie', 'estonienne'),
(26, 'Fidji', 'fidjienne'),
(27, 'Finlande', 'finlandaise'),
(28, 'Gabon', 'gabonaise'),
(29, 'Allemagne', 'allemande'),
(30, 'Guyane', 'guyanaise'),
(31, 'Honduras', 'hondurienne'),
(32, 'Islande', 'Islandaise'),
(33, 'Iran', 'Iranienne'),
(34, 'Irak', 'irakienne'),
(35, 'Irlande', 'irlandaise'),
(36, 'Italie', 'Italienne'),
(37, 'Japon', 'japonaise'),
(38, 'Jordanie', 'jordanienne'),
(39, 'Laos', 'laotienne'),
(40, 'Lettonie', 'lettonne'),
(41, 'Liban', 'libanaise'),
(42, 'Luxembourg', 'luxembourgeoise'),
(43, 'Madagascar', 'malgache'),
(44, 'Malawi', 'malawite'),
(45, 'Mali', 'malienne'),
(46, 'Malte', 'maltaise'),
(47, 'Martinique', 'martiniquaise'),
(48, 'Mauritanie', 'mauritanienne'),
(49, 'Mexique', 'mexicaine'),
(50, 'Moldavie', 'moldave'),
(51, 'Mongolie', 'mongol'),
(52, 'Maroc', 'marocaine'),
(53, 'Nicaragua', 'nicaraguayenne'),
(54, 'Niger', 'nigerienne'),
(55, 'Pakistan', 'pakistanaise'),
(56, 'Pologne', 'polonaise'),
(57, 'Portugal', 'portugaise'),
(58, 'Porto Rico', 'portoricaine'),
(59, 'Qatar', 'qatari'),
(60, 'Roumanie', 'roumaine'),
(61, 'Russie', 'russe'),
(62, 'Rwanda', 'rwandaise'),
(63, 'Serbie', 'serbe'),
(64, 'Slovaquie', 'slovaque'),
(65, 'Espagne', 'espagnole'),
(66, 'Soudan', 'soudanaise'),
(67, 'Suisse', 'suisse'),
(68, 'Syrie', 'syrienne'),
(69, 'Togo', 'togolaise'),
(70, 'Tunisie', 'tunisienne'),
(71, 'Turquie', 'turque'),
(72, 'Ouganda', 'ougandaise'),
(73, 'Ukraine', 'ukrainienne'),
(74, 'Royaume-Uni', 'britannique'),
(75, 'Vietnam', 'vietnamienne');",

"INSERT INTO `civils` (`id_civil`, `last_name`, `first_name`, `birth_date`, `id_geo`) VALUES
('15003e81-f56f-11ec-95d7-d493900031d9', 'Ryan', 'James', '1955-05-24', 74),
('270c4221-f56c-11ec-95d7-d493900031d9', 'Tomic', 'Ema', '1968-12-24', 19),
('410df551-f56d-11ec-95d7-d493900031d9', 'Sato', 'Haruki', '1998-12-01', 37),
('64905245-f56d-11ec-95d7-d493900031d9', 'Kaczmarek', 'Mishko', '1982-05-26', 56),
('663012b9-f56c-11ec-95d7-d493900031d9', 'Kjelsen', 'Tristan', '1992-05-10', 22),
('822a667f-f56d-11ec-95d7-d493900031d9', 'Komarov', 'Milena', '1989-09-18', 61),
('8f4610a5-f56c-11ec-95d7-d493900031d9', 'Meraz', 'Esteban', '1972-09-17', 65),
('a183eb3e-f56d-11ec-95d7-d493900031d9', 'Chung', 'Phi', '1997-11-07', 75),
('a7a6df25-f56b-11ec-95d7-d493900031d9', 'Conroy', 'Renee', '1994-02-09', 6),
('c08aa830-f56c-11ec-95d7-d493900031d9', 'Hjattarson', 'Karla', '2001-06-04', 32),
('ccaf0a6c-f56d-11ec-95d7-d493900031d9', 'Eberhart', 'Klaus', '1999-04-15', 29),
('d4dc1ceb-f56b-11ec-95d7-d493900031d9', 'Fowler', 'Nicole', '1985-10-27', 74),
('dfcf029a-f6c7-11ec-95d7-d493900031d9', 'Vokkri', 'Goran', '1960-05-24', 1),
('e6366d3e-f56c-11ec-95d7-d493900031d9', 'Genovesi', 'Davidi', '1957-04-08', 36),
('f3ea414f-f56b-11ec-95d7-d493900031d9', 'Sinclair', 'Victoria', '1995-02-14', 6);",

"INSERT INTO `hideouts` (`code`, `address`, `type`, `id_geo`) VALUES
('5b08cd67-f6e6-11ec-95d7-d493900031d9', 'Sed eu efficitur dolor id faucibus leo Duis feugiat justo sed nisl condimentum', 'entrepot', 1),
('7a77c00b-f6e6-11ec-95d7-d493900031d9', 'Curabitur rutrum elit sit amet orci imperdiet fringilla In mattis nisl ultrices mollis', 'appartement', 1),
('b2c7264a-f6e6-11ec-95d7-d493900031d9', 'Donec vel felis congue gravida arcu nec egestas lacus', 'bateau', 15);",

"INSERT INTO `specialities` (`id_speciality`, `name`) VALUES
(10, 'armes à feu'),
(4, 'combat rapproché'),
(8, 'dialectes chinois'),
(1, 'diplomatie'),
(2, 'furtivité'),
(14, 'génie mécanique'),
(3, 'hacking'),
(9, 'intervention médicale en milieu hostile'),
(13, 'nageur de combat'),
(11, 'physique appliquée'),
(7, 'pickpocket'),
(6, 'pilotage automobile'),
(12, 'sniper'),
(5, 'survie en milieu hostile');",

"INSERT INTO `missions` (`id_mission`, `title`, `description`, `code_name`, `statut`, `type`, `start_date`, `end_date`, `id_speciality`, `id_geo`) VALUES
('f4606519-f44d-11ec-b584-d493900031d9', 'Il faut localiser Ryan', 'Dernier survivant de sa fratrie, tous agents et morts en service dans la même période, Ryan semble être retenu prisonnier en Yougoslavie. Il faut le localiser avant de lancer une mission de sauvetage pour le ramener à sa famille.', 'Foupouda', 'terminée', 'renseignement', '1975-07-08', '1975-07-23', 1, 1),
('f4906519-f44d-11ec-b584-d493900031d9', 'Il faut sauver Ryan', 'Ryan est sequestré au château Danijel de Konak, il faut le sortir du château et le ramener en vie ', 'Espoir pour Ryan', 'échec', 'extraction', '1975-07-24', '1975-08-05', 2, 1);
",

"INSERT INTO `agents` (`identification_code`, `id_civil`) VALUES
('hhs58gf45f', '822a667f-f56d-11ec-95d7-d493900031d9'),
('4reh468fer', 'a7a6df25-f56b-11ec-95d7-d493900031d9'),
('44fe6846gr', 'ccaf0a6c-f56d-11ec-95d7-d493900031d9');",

"INSERT INTO `agentskills` (`id_speciality`, `identification_code`) VALUES
(3, '44fe6846gr'),
(4, '44fe6846gr'),
(2, '4reh468fer'),
(8, '4reh468fer'),
(1, 'hhs58gf45f'),
(2, 'hhs58gf45f');0",

"INSERT INTO `activities` (`id_mission`, `identification_code`) VALUES
('f4906519-f44d-11ec-b584-d493900031d9', '44fe6846gr'),
('f4906519-f44d-11ec-b584-d493900031d9', '4reh468fer'),
('f4606519-f44d-11ec-b584-d493900031d9', 'hhs58gf45f');",

"INSERT INTO `contacts` (`id_civil`, `id_mission`, `code_name`) VALUES
('a183eb3e-f56d-11ec-95d7-d493900031d9', 'f4606519-f44d-11ec-b584-d493900031d9', 'Gazelle'),
('d4dc1ceb-f56b-11ec-95d7-d493900031d9', 'f4606519-f44d-11ec-b584-d493900031d9', 'Colibri'),
('dfcf029a-f6c7-11ec-95d7-d493900031d9', 'f4606519-f44d-11ec-b584-d493900031d9', 'Phoenix'),
('dfcf029a-f6c7-11ec-95d7-d493900031d9', 'f4906519-f44d-11ec-b584-d493900031d9', 'Phoenix'),
('f3ea414f-f56b-11ec-95d7-d493900031d9', 'f4906519-f44d-11ec-b584-d493900031d9', 'Troie');",

"INSERT INTO `targets` (`id_civil`, `id_mission`, `code_name`) VALUES
('15003e81-f56f-11ec-95d7-d493900031d9', 'f4606519-f44d-11ec-b584-d493900031d9', 'agent Ryan'),
('15003e81-f56f-11ec-95d7-d493900031d9', 'f4906519-f44d-11ec-b584-d493900031d9', 'agent Ryan');",

"INSERT INTO `fallbacks` (`code`, `id_mission`) VALUES
('5b08cd67-f6e6-11ec-95d7-d493900031d9', 'f4606519-f44d-11ec-b584-d493900031d9'),
('7a77c00b-f6e6-11ec-95d7-d493900031d9', 'f4906519-f44d-11ec-b584-d493900031d9');"

];