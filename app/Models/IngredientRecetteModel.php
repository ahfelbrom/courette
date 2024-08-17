<?php
namespace App\Models;

use CodeIgniter\Model;

class IngredientRecetteModel extends Model
{
    protected $table = 'T_J_INGREDIENTRECETTE_IGE';
    protected $primaryKey = 'IGE_ID';
    private $alias = "IGE";
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

    public function findAllIngredientByRecette(int $idRecette): array
    {
        // le paramètre "true" du from permet d'ignorer l'utilisation de la table par défaut utilisée par le model
        // ça permet d'éviter de dupliquer la table
        $this->where('REC_ID', $idRecette)
            ->from($this->table . " " . $this->alias, true)
            ->join("T_E_INGREDIENT_ING ING", "{$this->alias}.ING_ID = ING.ING_ID");
        $aResult = $this->get()->getResultArray();

        return $aResult;
    }
}