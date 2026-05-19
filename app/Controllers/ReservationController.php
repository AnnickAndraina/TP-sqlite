<?php

namespace App\Controllers;

class ReservationController extends BaseController
{
    public function availableSlots(): string
    {
        $creneaux = [
            ['id'=>1,'ressource_nom'=>'Salle Réunion A','ressource_type'=>'Salle','date'=>'2026-05-20','time_start'=>'09:00:00','time_end'=>'10:00:00','available_places'=>10],
            ['id'=>2,'ressource_nom'=>'Studio Créatif','ressource_type'=>'Studio','date'=>'2026-05-20','time_start'=>'14:00:00','time_end'=>'16:00:00','available_places'=>5],
            ['id'=>3,'ressource_nom'=>'Atelier Cuisine','ressource_type'=>'Atelier','date'=>'2026-05-21','time_start'=>'08:00:00','time_end'=>'09:30:00','available_places'=>8],
            ['id'=>4,'ressource_nom'=>'Terrasse','ressource_type'=>'Outdoor','date'=>'2026-05-22','time_start'=>'18:00:00','time_end'=>'19:00:00','available_places'=>20]
        ];

        $stats = [
            'total_seances' => 24,
            'derniere_reservation' => '18 Mai 2026',
            'taux_presence' => 92
        ];

        return view('reservations/available_slots', [
            'slots' => $creneaux,
            'stats' => $stats
        ]);
    }

    public function myReservations(): string
    {
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

    public function createReservation()
    {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Réservation confirmée avec succès'
        ]);
    }

    public function cancelReservation()
    {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Réservation annulée'
        ]);
    }
}
