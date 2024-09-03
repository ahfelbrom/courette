<?php
namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
    protected $table = 'T_E_INGREDIENT_ING';
    protected $primaryKey = 'ING_ID';
    protected array $casts = array(
        'ING_ID'              => 'int',
        'ING_ACTIVE'          => 'int-bool',
        'ING_CREATEDAT'       => 'datetime',
        'ING_LISTEMOISSAISON' => 'json-array',
    );

    /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {
        $this->allowedFields = array(
            "ING_NOM",
            "ING_UNITE",
            "ING_LISTEMOISSAISON",
            "ING_ACTIVE",
        );
    }

    public function findAllActive(int $bActive=1){
        return $this->where('ING_ACTIVE', $bActive)
            ->orderBy("ING_NOM")->findAll();
    }

    public function findAllIdActive(int $bActive=1){
        $this->where('ING_ACTIVE', $bActive);

        return $this->findColumn("ING_ID");
    }
}