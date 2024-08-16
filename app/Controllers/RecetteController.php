<?php

namespace App\Controllers;

class RecetteController extends BaseController
{
    public function index(): string
    {
        $recetteModel = model("RecetteModel");

        parent::setJsFiles(array(
            base_url("js/recette/liste.js")
        ));
        return parent::showView('recette/index', array(
            "aAllRecette" => $recetteModel->findAllActive()
        ));
    }

    public function detail(int $id):string
    {
        helper("h_utils_helper");
        $recetteModel    = model("RecetteModel");
        $ingredientModel = model("IngredientModel");
        $igeModel = model("IngredientRecetteModel");
        $etapeModel = model("EtapeModel");

        $aInfosRecette  = $recetteModel->find($id);
        $aAllIngredient = array_group_by_key($ingredientModel->findAllActive(), "ING_ID");
        $aAllIngredientOfRecette = $igeModel->findAllByRecette($id);
        $aAllEtapeOfRecette = $etapeModel->findAllByRecette($id);

        parent::setJsFiles(array(
            base_url("js/recette/detail.js")
        ));
        return parent::showView('recette/detail', array(
            "title"                   => $aInfosRecette['REC_NOM'],
            "aInfosRecette"           => $aInfosRecette,
            "aAllIngredient"          => $aAllIngredient,
            "aAllIngredientOfRecette" => $aAllIngredientOfRecette,
            "aAllEtapeOfRecette"      => $aAllEtapeOfRecette,
        ));
    }
}
