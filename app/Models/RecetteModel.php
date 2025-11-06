<?php
namespace App\Models;

use CodeIgniter\Model;

class RecetteModel extends Model
{
    protected $table = 'T_E_RECETTE_REC';
    protected $primaryKey = 'REC_ID';
    protected array $casts = array(
        'REC_ID'               => 'int',
        'REC_DUREE'            => 'int',
        'REC_ACTIVE'           => 'int-bool',
        'REC_CREATEDAT'        => 'datetime',
        'REC_LISTE_USTENSILE'  => 'json-array',
        'REC_NB_PERSONNE_BASE' => 'int',
        'REC_TAGLIST'          => '?json-array',
    );

    /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {
        $this->allowedFields = array(
            "REC_NOM",
            "REC_DUREE",
            "REC_PHOTO",
            "REC_LISTE_USTENSILE",
            "REC_NB_PERSONNE_BASE",
            "REC_TAGLIST",
        );
        $this->allowEmptyInserts();
    }

    public function findAllActive($bActive=1){
        return $this->where('REC_ACTIVE', $bActive)->findAll();
    }

    public function findAllRecetteFromListId(array $aAllIdRecette): ?array
    {
        return $this->whereIn("REC_ID", $aAllIdRecette)
            ->get()->getResultArray();
    }
}