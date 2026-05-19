<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    /**
     * Dashboard administrateur - Affiche les stats
     */
    public function dashboard()
    {
        $session = session();
        
        // Vérifier que l'utilisateur est admin (pour testing, accepter aussi pas de session)
        // $isAdmin = $session->get('role') === 'admin';
        // if (!$isAdmin) return redirect()->to('/');

        // Données de test for dashboard
        $stats = [
            'total_users' => 45,
            'total_reservations' => 123,
            'reservations_today' => 12,
            'reservations_pending' => 8,
            'total_resources' => 6,
            'occupancy_rate' => 0.78, // 78%
        ];

        $recent_reservations = [
            ['id' => 1, 'user_email' => 'user@test.com', 'ressource' => 'Salle Réunion A', 'date' => '2026-05-20 12:00', 'status' => 'confirmed'],
            ['id' => 2, 'user_email' => 'demo@example.com', 'ressource' => 'Salle Lunch', 'date' => '2026-05-20 13:00', 'status' => 'pending'],
            ['id' => 3, 'user_email' => 'john@test.com', 'ressource' => 'Atelier Cuisine', 'date' => '2026-05-21 14:00', 'status' => 'confirmed'],
        ];

        return view('admin/dashboard', [
            'stats' => $stats,
            'recent_reservations' => $recent_reservations
        ]);
    }

    // ============ GESTION DES CRENEAUX ============

    /**
     * Liste tous les créneaux
     */
    public function listCreneaux()
    {
        // Pour testing, pas de vérification de session
        // $session = session();
        // if ($session->get('role') !== 'admin') {
        //     return redirect()->to('/');
        // }

        $creneaux = [
            ['id' => 1, 'ressource' => 'Salle Réunion A', 'date' => '2026-05-20', 'time' => '12:00-13:00', 'places' => 10, 'available' => 8, 'active' => true],
            ['id' => 2, 'ressource' => 'Salle Lunch', 'date' => '2026-05-20', 'time' => '13:00-14:00', 'places' => 15, 'available' => 5, 'active' => true],
            ['id' => 3, 'ressource' => 'Atelier Cuisine', 'date' => '2026-05-21', 'time' => '14:00-16:00', 'places' => 8, 'available' => 3, 'active' => true],
            ['id' => 4, 'ressource' => 'Terrasse', 'date' => '2026-05-21', 'time' => '18:00-19:00', 'places' => 20, 'available' => 20, 'active' => false],
        ];

        return view('admin/creneaux/list', ['creneaux' => $creneaux]);
    }

    /**
     * Formulaire de création de créneau
     */
    public function createCreneauForm()
    {
        $ressources = [
            ['id' => 1, 'name' => 'Salle Réunion A', 'type' => 'salle'],
            ['id' => 2, 'name' => 'Salle Lunch', 'type' => 'cafeteria'],
            ['id' => 3, 'name' => 'Atelier Cuisine', 'type' => 'atelier'],
            ['id' => 4, 'name' => 'Terrasse', 'type' => 'outdoor'],
        ];

        return view('admin/creneaux/create', ['ressources' => $ressources]);
    }

    /**
     * Crée un créneau
     */
    public function storeCreneauForm()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        // Récupérer les données du formulaire
        $ressource_id = $this->request->getPost('ressource_id');
        $date = $this->request->getPost('date');
        $time_start = $this->request->getPost('time_start');
        $time_end = $this->request->getPost('time_end');
        $places = $this->request->getPost('places');

        // Simuler la création (en BD il serait créé ici)
        $message = "Créneau créé avec succès!";

        return redirect()->to('/admin/creneaux')->with('success', $message);
    }

    /**
     * Formulaire d'édition de créneau
     */
    public function editCreneauForm($id)
    {
        $creneau = [
            'id' => $id,
            'ressource_id' => 1,
            'ressource' => 'Salle Réunion A',
            'date' => '2026-05-20',
            'time_start' => '12:00',
            'time_end' => '13:00',
            'places' => 10,
            'available' => 8,
        ];

        $ressources = [
            ['id' => 1, 'name' => 'Salle Réunion A', 'type' => 'salle'],
            ['id' => 2, 'name' => 'Salle Lunch', 'type' => 'cafeteria'],
        ];

        return view('admin/creneaux/edit', ['creneau' => $creneau, 'ressources' => $ressources]);
    }

    /**
     * Met à jour un créneau
     */
    public function updateCreneauForm($id)
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        // Récupérer les données
        $date = $this->request->getPost('date');
        $time_start = $this->request->getPost('time_start');
        $time_end = $this->request->getPost('time_end');
        $places = $this->request->getPost('places');

        return redirect()->to('/admin/creneaux')->with('success', 'Créneau mis à jour avec succès!');
    }

    /**
     * Supprime un créneau
     */
    public function deleteCreneauForm($id)
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        return redirect()->to('/admin/creneaux')->with('success', 'Créneau supprimé avec succès!');
    }

    // ============ GESTION DES RÉSERVATIONS ============

    /**
     * Liste toutes les réservations
     */
    public function listReservations()
    {
        $reservations = [
            ['id' => 1, 'user' => 'John Doe', 'email' => 'john@test.com', 'resource' => 'Salle Réunion A', 'date' => '2026-05-20 12:00', 'status' => 'confirmed', 'created' => '2026-05-19 09:00'],
            ['id' => 2, 'user' => 'Jane Smith', 'email' => 'jane@test.com', 'resource' => 'Salle Lunch', 'date' => '2026-05-20 13:00', 'status' => 'pending', 'created' => '2026-05-19 10:30'],
            ['id' => 3, 'user' => 'Bob Johnson', 'email' => 'bob@test.com', 'resource' => 'Atelier Cuisine', 'date' => '2026-05-21 14:00', 'status' => 'confirmed', 'created' => '2026-05-19 11:15'],
            ['id' => 4, 'user' => 'Alice Brown', 'email' => 'alice@test.com', 'resource' => 'Terrasse', 'date' => '2026-05-21 18:00', 'status' => 'cancelled', 'created' => '2026-05-19 08:45'],
        ];

        return view('admin/reservations/list', ['reservations' => $reservations]);
    }

    /**
     * Change le statut d'une réservation
     */
    public function changeReservationStatus($id)
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Non autorisé']);
        }

        $new_status = $this->request->getPost('status');

        if (!in_array($new_status, ['pending', 'confirmed', 'cancelled'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Statut invalide']);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Statut mis à jour: ' . $new_status
        ]);
    }

    // ============ GESTION DES RESSOURCES ============

    /**
     * Liste toutes les ressources
     */
    public function listRessources()
    {
        $ressources = [
            ['id' => 1, 'name' => 'Salle Réunion A', 'type' => 'salle', 'capacity' => 10, 'description' => 'Salle de réunion avec projecteur'],
            ['id' => 2, 'name' => 'Salle Lunch', 'type' => 'cafeteria', 'capacity' => 15, 'description' => 'Espace déjeuner'],
            ['id' => 3, 'name' => 'Atelier Cuisine', 'type' => 'atelier', 'capacity' => 8, 'description' => 'Atelier culinaire complet'],
            ['id' => 4, 'name' => 'Terrasse', 'type' => 'outdoor', 'capacity' => 20, 'description' => 'Terrasse extérieure'],
            ['id' => 5, 'name' => 'Salle Yoga', 'type' => 'salle', 'capacity' => 12, 'description' => 'Salle de yoga'],
            ['id' => 6, 'name' => 'Gym', 'type' => 'salle', 'capacity' => 30, 'description' => 'Salle de fitness'],
        ];

        return view('admin/ressources/list', ['ressources' => $ressources]);
    }

    /**
     * Formulaire d'ajout de ressource
     */
    public function createRessourceForm()
    {
        $types = ['salle', 'cafeteria', 'atelier', 'outdoor', 'gym', 'court'];

        return view('admin/ressources/create', ['types' => $types]);
    }

    /**
     * Crée une ressource
     */
    public function storeRessource()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        return redirect()->to('/admin/ressources')->with('success', 'Ressource créée avec succès!');
    }

    // ============ GESTION DES UTILISATEURS ============

    /**
     * Liste tous les utilisateurs inscrits
     */
    public function listUsers()
    {
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@test.com', 'created' => '2026-05-01', 'reservations' => 3],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@test.com', 'created' => '2026-05-02', 'reservations' => 2],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@test.com', 'created' => '2026-05-05', 'reservations' => 5],
            ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@test.com', 'created' => '2026-05-10', 'reservations' => 1],
            ['id' => 5, 'name' => 'Charlie White', 'email' => 'charlie@test.com', 'created' => '2026-05-15', 'reservations' => 2],
        ];

        return view('admin/users/list', ['users' => $users]);
    }
}
