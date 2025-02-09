<?php

namespace App\Controllers;

class SemaineController extends BaseController
{
    public function index(): string
    {
        $recetteModel = model("RecetteModel");
        $semaineModel = model("SemaineModel");
        helper("h_utils_helper");

        $strNumWeekAndYear = ($this->request->getGet("num_week") !==null?$this->request->getGet("num_week"):date('W/Y'));
        $aExplodedWeek = explode("/", $strNumWeekAndYear);
        $aAllRepasChosenThisWeek = $semaineModel->findThisWeek($aExplodedWeek);
        $aAllInfosRepas = isset($aAllRepasChosenThisWeek['SEM_LISTEREPAS'])
            ?array_group_by_key($recetteModel->findAllRecetteFromListId(json_decode($aAllRepasChosenThisWeek['SEM_LISTEREPAS'])), "REC_ID")
            :null
        ;

        parent::setJsFiles(array(
            base_url("js/semaine/preparation.js")
        ));
        return parent::showView('semaine/preparation', array(
            "aAllRecette"    => $recetteModel->findAllActive(),
            "aAllInfosRepas" => $aAllInfosRepas
        ));
    }

    public function showSemaine(): string
    {
        $semaineModel = model("SemaineModel");
        $strNumWeekAndYear = ($this->request->getGet("num_week") !==null?$this->request->getGet("num_week"):date('W/Y'));
        $aExplodedWeek = explode("/", $strNumWeekAndYear);
        $thisSemaine = $semaineModel->findThisWeek($aExplodedWeek);
        $aWeeksMove = $this->_generateLastAndNextWeek($aExplodedWeek);

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
            "aWeeksMove"                     => $aWeeksMove,
            "strDateDebutSemaine"            => $aWeeksMove['actualWeekDay'],
            "thisSemaine"                    => $thisSemaine,
            "aAllInfosRecetteOfSemaine"      => $aAllInfosRecetteOfSemaine,
            "aAllIngredientNeededForSemaine" => $aAllIngredientNeededForSemaine
        ));
    }

    private function _generateLastAndNextWeek($aExplodedWeek):array
    {
        $aReturn = [];

        // en premier, on crée la datetime correspondant à la semaine
        $dto = new \DateTime();
        $dto->setISODate($aExplodedWeek[1], $aExplodedWeek[0]);
        $aReturn["actualWeekDay"] = $dto->format('d/m/Y');
        $aReturn["actual"] = $dto->format('W/Y');
        // ensuite, on enlève une semaine pour générer la date de la semaine d'avant
        $dto->sub(new \DateInterval("P1W"));
        $aReturn["before"] = $dto->format('W/Y');
        // enfin, on rajoute deux semaines pour générer la date de la semaine d'après
        // on place le curseur à la fin de la semaine pour gérer les semaines entre deux ans
        $dto->add(new \DateInterval("P2W"));
        $dto->add(new \DateInterval("P6D"));
        $aReturn["after"] = $dto->format('W/Y');

        return $aReturn;
    }
}
