-- Création de la base
CREATE DATABASE IF NOT EXISTS offres_stage;
USE offres_stage;

-- Création de la table
CREATE TABLE IF NOT EXISTS offres (
    id INT PRIMARY KEY,
    offer VARCHAR(255),
    status ENUM('Pending', 'Rejected', 'Accepted')
);

-- Insertion des données
INSERT INTO offres (id, offer, status) VALUES
(1, 'Stage - Administrateur Système et Réseau H/F', 'Rejected'),
(2, 'Stage - Analyste Cybersécurité', 'Pending'),
(3, 'Stage - Ingénieur en Intelligence Artificielle', 'Rejected'),
(4, 'Stage - Chef de Projet Digital', 'Rejected'),
(5, 'Stage - Développeur Mobile iOS/Android', 'Pending'),
(6, 'Stage - Consultant en Stratégie', 'Accepted'),
(7, 'Stage - Graphiste UI/UX Designer', 'Rejected'),
(8, 'Stage - Ingénieur DevOps', 'Accepted'),
(9, 'Stage - Data Analyst', 'Accepted'),
(10, 'Stage - Simulation en Laboratoire', 'Rejected'),
(11, 'Stage - Analyste Financier', 'Rejected'),
(12, 'Stage - Ingénieur en Systèmes Embarqués', 'Accepted'),
(13, 'Stage - Data Scientist', 'Rejected'),
(14, 'Stage - Développeur Web Full-Stack', 'Rejected'),
(15, 'Stage - Consultant Marketing Digital', 'Pending'),
(16, 'Stage - Développeur Blockchain', 'Pending'),
(17, 'Stage - Chargé de Communication', 'Pending'),
(18, 'Stage - Ingénieur Cloud & DevOps', 'Rejected'),
(19, 'Stage - Responsable Énergies Renouvelables', 'Accepted'),
(20, 'Stage - Consultant Supply Chain', 'Accepted');

-- Création de la table des utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL UNIQUE,
    motDePasse VARCHAR(255) NOT NULL
);

-- Insertion de 10 utilisateurs
INSERT INTO utilisateurs (email, motDePasse) VALUES
('alice@example.com', 'password1'),
('bob@example.com', 'password2'),
('carla@example.com', 'password3'),
('david@example.com', 'password4'),
('emma@example.com', 'password5'),
('felix@example.com', 'password6'),
('gina@example.com', 'password7'),
('hugo@example.com', 'password8'),
('iris@example.com', 'password9'),
('julien@example.com', 'password10');

