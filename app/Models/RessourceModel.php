<?php

namespace App\Models;

use CodeIgniter\Model;

class RessourceModel extends Model
{
    protected $table = 'ressources';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'type', 'capacite', 'description'];

    /**
     * Récupère toutes les ressources
     */
    public function getAllRessources()
    {
        return $this->findAll();
    }

    /**
     * Récupère une ressource par ID
     */
    public function getRessourceById($id)
    {
        return $this->find($id);
    }
}
