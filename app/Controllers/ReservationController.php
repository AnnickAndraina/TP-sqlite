<?php

namespace App\Controllers;

class ReservationController extends BaseController
{
    /**
     * Affiche les créneaux disponibles
     */
    public function availableSlots(): string
    {
        // Données de test - avec noms de clés attendus par la vue
        $creneaux = [
            [
                'id' => 1,
                'ressource_nom' => 'Salle Réunion A',
                'ressource_type' => 'salle',
                'date' => '2026-05-20',
                'time_start' => '12:00:00',
                'time_end' => '13:00:00',
                'available_places' => 10
            ],
            [
                'id' => 2,
                'ressource_nom' => 'Salle Lunch',
                'ressource_type' => 'cafeteria',
                'date' => '2026-05-20',
                'time_start' => '13:00:00',
                'time_end' => '14:00:00',
                'available_places' => 15
            ],
            [
                'id' => 3,
                'ressource_nom' => 'Atelier Cuisine',
                'ressource_type' => 'atelier',
                'date' => '2026-05-21',
                'time_start' => '14:00:00',
                'time_end' => '16:00:00',
                'available_places' => 8
            ],
            [
                'id' => 4,
                'ressource_nom' => 'Terrasse',
                'ressource_type' => 'outdoor',
                'date' => '2026-05-21',
                'time_start' => '18:00:00',
                'time_end' => '19:00:00',
                'available_places' => 20
            ]
        ];
        
        return view('reservations/available_slots', ['slots' => $creneaux]);
    }

    /**
     * Affiche les réservations de l'utilisateur
     */
    public function myReservations(): string
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $reservations = [
            [
                'id' => 1,
                'ressource_nom' => 'Salle Réunion A',
                'date_debut' => '2026-05-20 12:00:00',
                'date_fin' => '2026-05-20 13:00:00',
                'status' => 'confirmed'
            ]
        ];
        
        return view('reservations/my_reservations', ['reservations' => $reservations]);
    }

    /**
     * Crée une nouvelle réservation
     */
    public function createReservation()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Non authentifié']);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Réservation confirmée']);
    }

    /**
     * Annule une réservation
     */
    public function cancelReservation()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Non authentifié']);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Réservation annulée']);
    }
}
