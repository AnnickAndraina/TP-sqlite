<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\SlotModel;

class ReservationController extends BaseController
{
    protected $reservationModel;
    protected $slotModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->slotModel = new SlotModel();
    }

    /**
     * Affiche les créneaux disponibles
     */
    public function availableSlots(): string
    {
        $slots = $this->slotModel->getAvailableSlots();
        
        return view('reservations/available_slots', ['slots' => $slots]);
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

        $reservations = $this->reservationModel->getUserReservations($userId);
        
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

        $slotId = (int) $this->request->getPost('slot_id');

        $result = $this->reservationModel->createReservation($userId, $slotId);

        return $this->response->setJSON($result);
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

        $reservationId = (int) $this->request->getPost('reservation_id');

        $result = $this->reservationModel->cancelReservation($reservationId, $userId);

        return $this->response->setJSON($result);
    }

    /**
     * Voir les détails d'un créneau
     */
    public function slotDetails($slotId)
    {
        $slot = $this->slotModel->find($slotId);

        if (!$slot) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('reservations/slot_details', ['slot' => $slot]);
    }
}
