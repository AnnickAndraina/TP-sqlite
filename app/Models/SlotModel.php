<?php

namespace App\Models;

use CodeIgniter\Model;

class SlotModel extends Model
{
    protected $table = 'slots';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['date', 'time_start', 'time_end', 'total_places', 'available_places', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    /**
     * Récupère tous les créneaux disponibles
     */
    public function getAvailableSlots()
    {
        return $this->where('status', 'available')
            ->where('available_places >', 0)
            ->where('date >=', date('Y-m-d'))
            ->orderBy('date ASC')
            ->orderBy('time_start ASC')
            ->findAll();
    }

    /**
     * Récupère les créneaux d'une date spécifique
     */
    public function getSlotsByDate($date)
    {
        return $this->where('date', $date)
            ->where('status', 'available')
            ->orderBy('time_start ASC')
            ->findAll();
    }

    /**
     * Crée un nouveau créneau
     */
    public function createSlot($data)
    {
        return $this->insert($data);
    }
}
