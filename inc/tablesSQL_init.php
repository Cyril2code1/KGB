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
    );"
];