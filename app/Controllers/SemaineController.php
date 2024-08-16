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
        if (isset($thisSemaine) && !empty($thisSemaine)) {
            $aAllIdRecetteSelected = json_decode($thisSemaine['SEM_LISTEREPAS']);
            $recetteModel = model("RecetteModel");
            $aAllInfosRecetteOfSemaine = $recetteModel->findAllRecetteFromListId($aAllIdRecetteSelected);
        }

        parent::setJsFiles(array(
            //base_url("js/semaine/preparation.js")
        ));
        return parent::showView('semaine/this_week', array(
            "thisSemaine"               => $thisSemaine,
            "aAllInfosRecetteOfSemaine" => $aAllInfosRecetteOfSemaine
        ));
    }
}
