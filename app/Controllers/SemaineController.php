<?php

namespace App\Controllers;

class SemaineController extends BaseController
{
    public function index(): string
    {
        $recetteModel = model("RecetteModel");

        parent::setJsFiles(array(
            base_url("js/semaine/preparation.js")
        ));
        return parent::showView('semaine/preparation', array(
            "aAllRecette" => $recetteModel->findAllActive()
        ));
    }

    public function showSemaine(): string
    {
        $semaineModel = model("SemaineModel");
        $thisSemaine = $semaineModel->findThisWeek();

        $aAllInfosRecetteOfSemaine = array();
        $aAllIngredientNeededForSemaine = array();
        if (isset($thisSemaine) && !empty($thisSemaine)) {
            $aAllIdRecetteSelected = json_decode($thisSemaine['SEM_LISTEREPAS']);
            $recetteModel = model("RecetteModel");
            $ingredientRecetteModel = model("IngredientRecetteModel");
            $aAllInfosRecetteOfSemaine = $recetteModel->findAllRecetteFromListId($aAllIdRecetteSelected);

            foreach ($aAllInfosRecetteOfSemaine as $aRecette) {
                $aAllIngredientOfRecette = $ingredientRecetteModel->findAllIngredientByRecette($aRecette['REC_ID']);
                foreach($aAllIngredientOfRecette as $aIngredient) {
                    if (!isset($aAllIngredientNeededForSemaine[$aIngredient['ING_ID']])) {
                        $aAllIngredientNeededForSemaine[$aIngredient['ING_ID']] = array(
                            "NOMBRE" => $aIngredient['IGE_NOMBRE'],
                            "UNITE" => $aIngredient['ING_UNITE'],
                            "NOM" => $aIngredient['ING_NOM']
                        );
                    } else {
                        $aAllIngredientNeededForSemaine[$aIngredient['ING_ID']]['NOMBRE'] += $aIngredient['IGE_NOMBRE'];
                    }
                }
            }
        }

        parent::setJsFiles(array(
            base_url("js/semaine/this_week.js")
        ));
        return parent::showView('semaine/this_week', array(
            "thisSemaine"                    => $thisSemaine,
            "aAllInfosRecetteOfSemaine"      => $aAllInfosRecetteOfSemaine,
            "aAllIngredientNeededForSemaine" => $aAllIngredientNeededForSemaine
        ));
    }
}
