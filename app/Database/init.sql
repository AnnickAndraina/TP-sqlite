-- ====================================
-- SCHÉMA DE BASE DE DONNÉES (4 TABLES)
-- ====================================

-- Table 1: USERS (Utilisateurs)
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'client' CHECK(role IN ('client', 'admin')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table 2: RESOURCES (Ressources)
CREATE TABLE IF NOT EXISTS resources (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    type TEXT NOT NULL,
    capacite INTEGER NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table 3: CRENEAUX (Créneaux horaires)
CREATE TABLE IF NOT EXISTS creneaux (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    places_dispo INTEGER NOT NULL,
    resource_id INTEGER,
    status TEXT DEFAULT 'available' CHECK(status IN ('available', 'full', 'cancelled')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (resource_id) REFERENCES resources(id)
);

-- Table 4: RESERVATIONS (Réservations)
CREATE TABLE IF NOT EXISTS reservations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    creneau_id INTEGER NOT NULL,
    status TEXT DEFAULT 'pending' CHECK(status IN ('pending', 'confirmed', 'cancelled')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (creneau_id) REFERENCES creneaux(id),
    UNIQUE(user_id, creneau_id)
);

-- ====================================
-- DONNÉES DE TEST
-- ====================================

-- Insérer des utilisateurs de test
INSERT OR IGNORE INTO users (nom, email, password, role) VALUES
('Admin', 'admin@foodswipe.com', '$2y$10$N9qo8uLOickgx2ZMRZoHyK5UjLjQ5xKm6L8K0zzLpzOZ0O0Kd5kAG', 'admin'),
('Jean Dupont', 'jean.dupont@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoHyK5UjLjQ5xKm6L8K0zzLpzOZ0O0Kd5kAG', 'client'),
('Marie Martin', 'marie.martin@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoHyK5UjLjQ5xKm6L8K0zzLpzOZ0O0Kd5kAG', 'client'),
('Pierre Bernard', 'pierre.bernard@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoHyK5UjLjQ5xKm6L8K0zzLpzOZ0O0Kd5kAG', 'client');

-- Insérer les ressources
INSERT OR IGNORE INTO resources (nom, type, capacite, description) VALUES
('Salle Réunion A', 'salle', 10, 'Salle de réunion avec tableau blanc'),
('Salle Lunch', 'cafeteria', 30, 'Espace déjeuner principal'),
('Atelier Cuisine', 'atelier', 8, 'Atelier cuisine avec équipement complet'),
('Terrasse', 'outdoor', 20, 'Terrasse extérieure panoramique');

-- Insérer les créneaux disponibles
INSERT OR IGNORE INTO creneaux (date_debut, date_fin, places_dispo, resource_id, status) VALUES
('2026-05-20 12:00:00', '2026-05-20 13:00:00', 2, 1, 'available'),
('2026-05-20 13:00:00', '2026-05-20 14:00:00', 3, 1, 'available'),
('2026-05-20 12:00:00', '2026-05-20 13:30:00', 15, 2, 'available'),
('2026-05-20 13:30:00', '2026-05-20 15:00:00', 15, 2, 'available'),
('2026-05-21 14:00:00', '2026-05-21 16:00:00', 8, 3, 'available'),
('2026-05-21 16:00:00', '2026-05-21 18:00:00', 8, 3, 'available'),
('2026-05-21 18:00:00', '2026-05-21 19:00:00', 20, 4, 'available'),
('2026-05-22 12:00:00', '2026-05-22 13:00:00', 2, 1, 'available'),
('2026-05-22 14:30:00', '2026-05-22 16:30:00', 8, 3, 'available'),
('2026-05-22 19:00:00', '2026-05-22 20:00:00', 10, 4, 'available');

-- Insérer quelques réservations de test
INSERT OR IGNORE INTO reservations (user_id, creneau_id, status) VALUES
(2, 1, 'confirmed'),
(3, 1, 'confirmed'),
(2, 3, 'confirmed'),
(4, 7, 'pending');
