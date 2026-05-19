-- ====================================
-- SCHÉMA DE BASE DE DONNÉES COMPLÈTE
-- ====================================

-- Table 1: USERS (Utilisateurs)
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table 2: RESSOURCES (Ressources/Equipements)
CREATE TABLE IF NOT EXISTS ressources (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    capacite INTEGER NOT NULL,
    description TEXT
);

-- Table 3: CRENEAUX (Créneaux horaires)
CREATE TABLE IF NOT EXISTS creneaux (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ressource_id INTEGER NOT NULL,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    places_dispo INTEGER NOT NULL,
    actif BOOLEAN DEFAULT 1,
    FOREIGN KEY (ressource_id) REFERENCES ressources(id)
);

-- Table 4: RESERVATIONS (Réservations)
CREATE TABLE IF NOT EXISTS reservations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    creneau_id INTEGER NOT NULL,
    status VARCHAR(50) DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (creneau_id) REFERENCES creneaux(id)
);

-- ====================================
-- DONNÉES DE TEST
-- ====================================

-- Insérer des utilisateurs
INSERT OR IGNORE INTO users (nom, email, password, role) VALUES
('Admin', 'admin@foodswipe.com', 'admin123', 'admin'),
('Jean Dupont', 'jean.dupont@email.com', 'password123', 'client'),
('Marie Martin', 'marie.martin@email.com', 'password123', 'client'),
('Pierre Bernard', 'pierre.bernard@email.com', 'password123', 'client');

-- Insérer des ressources
INSERT OR IGNORE INTO ressources (nom, type, capacite, description) VALUES
('Salle Réunion A', 'salle', 10, 'Salle de réunion avec tableau blanc'),
('Salle Lunch', 'cafeteria', 30, 'Espace déjeuner principal'),
('Atelier Cuisine', 'atelier', 8, 'Atelier cuisine avec équipement complet'),
('Terrasse', 'outdoor', 20, 'Terrasse extérieure panoramique');

-- Insérer des créneaux
INSERT OR IGNORE INTO creneaux (ressource_id, date_debut, date_fin, places_dispo, actif) VALUES
(1, '2026-05-20 12:00:00', '2026-05-20 13:00:00', 10, 1),
(1, '2026-05-20 13:00:00', '2026-05-20 14:00:00', 10, 1),
(2, '2026-05-20 12:00:00', '2026-05-20 13:30:00', 30, 1),
(2, '2026-05-20 13:30:00', '2026-05-20 15:00:00', 30, 1),
(3, '2026-05-21 14:00:00', '2026-05-21 16:00:00', 8, 1),
(3, '2026-05-21 16:00:00', '2026-05-21 18:00:00', 8, 1),
(4, '2026-05-21 18:00:00', '2026-05-21 19:00:00', 20, 1),
(1, '2026-05-22 12:00:00', '2026-05-22 13:00:00', 10, 1),
(3, '2026-05-22 14:30:00', '2026-05-22 16:30:00', 8, 1),
(4, '2026-05-22 19:00:00', '2026-05-22 20:00:00', 20, 1);

-- Insérer quelques réservations
INSERT OR IGNORE INTO reservations (user_id, creneau_id, status) VALUES
(2, 1, 'confirmed'),
(3, 1, 'confirmed'),
(2, 3, 'confirmed'),
(4, 7, 'en_attente');
