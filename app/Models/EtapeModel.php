<?php
namespace App\Models;

use CodeIgniter\Model;

class EtapeModel extends Model
{
    protected $table = 'T_E_ETAPERECETTE_ETR';
    protected $primaryKey = 'ETR_ID';
    protected array $casts = array(
        'ETR_ID'    => 'int',
        'REC_ID'    => 'int',
        'ETR_ORDRE' => 'int',
        'ETR_DUREE' => 'float',
    );

    /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {
        $this->allowedFields = array(
            "REC_ID",
            "ETR_DUREE",
            "ETR_ORDRE",
            "ETR_DESCRIPTION",
        );
    }

    public function findAllByRecette(int $idRecette): array
    {
        return $this->where("REC_ID", $idRecette)->findAll();
    }

    public function findLastEtapeOfRecette(int $idRecette): array
    {
        return $this->where("REC_ID", $idRecette)
                ->orderBy("ETR_ORDRE", "DESC")
                ->get()->getRowArray();
    }
}