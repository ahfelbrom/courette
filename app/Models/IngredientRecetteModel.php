<?php
namespace App\Models;

use CodeIgniter\Model;

class IngredientRecetteModel extends Model
{
    protected $table = 'T_J_INGREDIENTRECETTE_IGE';
    protected $primaryKey = 'IGE_ID';
    protected array $casts = array(
        'IGE_ID'     => 'int',
        'REC_ID'     => 'int',
        'ING_ID'     => 'int',
        'IGE_NOMBRE' => 'int',
    );

    /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {
        $this->allowedFields = array(
            "REC_ID",
            "ING_ID",
            "IGE_NOMBRE",
        );
    }

    public function findAllByRecette(int $idRecette): array
    {
        return $this->where('REC_ID', $idRecette)->findAll();
    }
}