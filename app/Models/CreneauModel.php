<?php

namespace App\Models;

use CodeIgniter\Model;

class CreneauModel extends Model
{
    protected $table = 'creneaux';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['ressource_id', 'date_debut', 'date_fin', 'places_dispo', 'actif'];

    /**
     * Récupère tous les créneaux actifs
     */
    public function getActiveCreneaux()
    {
        return $this->where('actif', 1)
            ->where('date_debut >', date('Y-m-d H:i:s'))
            ->orderBy('date_debut ASC')
            ->findAll();
    }

    /**
     * Récupère les créneaux d'une ressource
     */
    public function getCreneauxByRessource($ressourceId)
    {
        return $this->where('ressource_id', $ressourceId)
            ->where('actif', 1)
            ->orderBy('date_debut ASC')
            ->findAll();
    }

    /**
     * Récupère les créneaux avec la ressource
     */
    public function getCreneauxWithRessource()
    {
        return $this->select('creneaux.*, ressources.nom as ressource_nom, ressources.type as ressource_type')
            ->join('ressources', 'creneaux.ressource_id = ressources.id')
            ->where('creneaux.actif', 1)
            ->where('creneaux.date_debut >', date('Y-m-d H:i:s'))
            ->orderBy('creneaux.date_debut ASC')
            ->findAll();
    }
}
