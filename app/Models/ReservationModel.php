<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'creneau_id', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    /**
     * Récupère toutes les réservations d'un utilisateur
     */
    public function getUserReservations($userId)
    {
        return $this->select('reservations.*, slots.date, slots.time_start, slots.time_end')
            ->join('slots', 'reservations.slot_id = slots.id')
            ->where('reservations.user_id', $userId)
            ->findAll();
    }

    /**
     * Crée une nouvelle réservation
     */
    public function createReservation($userId, $slotId)
    {
        $db = \Config\Database::connect();

        try {
            $db->transStart();

            // Vérifier que le créneau a de la place
            $slot = $db->table('slots')->where('id', $slotId)->get()->getRow();
            
            if (!$slot || $slot->available_places <= 0) {
                return ['success' => false, 'message' => 'Créneau complet'];
            }

            // Vérifier que l'utilisateur n'a pas déjà réservé ce créneau
            $existing = $this->where('user_id', $userId)
                ->where('slot_id', $slotId)
                ->first();
            
            if ($existing) {
                return ['success' => false, 'message' => 'Réservation déjà existante'];
            }

            // Créer la réservation
            $this->insert([
                'user_id' => $userId,
                'slot_id' => $slotId,
                'status' => 'confirmed'
            ]);

            // Décrémenter les places disponibles
            $db->table('slots')
                ->where('id', $slotId)
                ->update(['available_places' => $slot->available_places - 1]);

            $db->transComplete();

            return ['success' => true, 'message' => 'Réservation confirmée'];
        } catch (\Exception $e) {
            $db->transRollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Annule une réservation
     */
    public function cancelReservation($reservationId, $userId)
    {
        $db = \Config\Database::connect();

        try {
            $db->transStart();

            // Vérifier que la réservation appartient à l'utilisateur
            $reservation = $this->where('id', $reservationId)
                ->where('user_id', $userId)
                ->first();

            if (!$reservation) {
                return ['success' => false, 'message' => 'Réservation introuvable'];
            }

            // Mettre à jour le statut
            $this->update($reservationId, ['status' => 'cancelled']);

            // Réincrémenter les places disponibles
            $db->table('slots')
                ->where('id', $reservation['slot_id'])
                ->update(['available_places' => \DB::raw('available_places + 1')]);

            $db->transComplete();

            return ['success' => true, 'message' => 'Réservation annulée'];
        } catch (\Exception $e) {
            $db->transRollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
