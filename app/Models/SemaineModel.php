<?php
namespace App\Models;

use CodeIgniter\Model;

class SemaineModel extends Model
{
    protected $table = 'T_E_SEMAINE_SEM';
    protected $primaryKey = 'SEM_ID';
    protected array $casts = array(
        'SEM_ID'         => 'int',
        'SEM_NUMERO'     => 'int',
        'SEM_YEAR'       => 'int',
        'SEM_LISTEREPAS' => 'json-array',
    );

    /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {
        $this->allowedFields = array(
            "SEM_NUMERO",
            "SEM_YEAR",
            "SEM_LISTEREPAS",
        );
    }

    public function findThisWeek(): ?array
    {
        return $this->where("SEM_NUMERO", date('W'))
            ->where("SEM_YEAR", date('Y'))
            ->get()->getRowArray();
    }
}