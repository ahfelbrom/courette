<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
// voir plus tard si on peut bloquer le controller uniquement pour des requêttes envoyées en ajax
class AjaxController extends BaseController
{
    public function addRecette():Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "J'ai rine reçu",
        );
        if (!empty($this->request->getPost())) {
            if ($this->__validateRecetteForm()) {
                $recetteModel = model("RecetteModel");
                $aParamsInsert = array(
                    "REC_NOM"              => $this->request->getPost("REC_NOM"),
                    "REC_DUREE"            => $this->request->getPost("REC_DUREE"),
                    "REC_PHOTO"            => "Not implemented yet",
                    "REC_LISTE_USTENSILE"  => $this->request->getPost("REC_LISTEUSTENSILE"),
                    "REC_NB_PERSONNE_BASE" => $this->request->getPost("REC_NBPERSONNE"),
                );

                $intInsertedRecette = $recetteModel->insert($aParamsInsert);
                if ($intInsertedRecette) {
                    $aReturn['success'] = true;
                    $aReturn['error_message'] = "";
                    // pour le moment j'envoie pas les datas car je vais recharger la page
                } else {
                    $aReturn['error_message'] = "Un problème est survenu lors de l'insertion de la recette";
                }
            } else {
                // si getErrors est pas valide, une vérif à la main n'est pas passée
                if (!empty($this->validator->getErrors())) {
                    $aReturn['error_message'] = "Merci de vérifier les erreurs du formulaire.";
                    $aReturn["form_errors"]   = $this->validator->getErrors();
                } else {
                    $aReturn['error_message'] = "Merci de ne pas modifier la liste des ustensiles.";
                }
            }
        }
//        var_dump($this->request->getPost());
//        die;
        return $this->response->setJSON($aReturn);
    }

    private function __validateRecetteForm():bool
    {
        $aAllRules = array(
            "REC_NOM"            => "required",
            "REC_LISTEUSTENSILE" => "required",
            "REC_NBPERSONNE"     => "required",
            "REC_DUREE"          => "required",
        );
        $bFormIsValid = $this->validateData($this->request->getPost(), $aAllRules);

        if ($bFormIsValid) {
            // on ne vérifie la liste des ustensiles QUE si les validations précédentes
            // sont passées.
            foreach($this->request->getPost("REC_LISTEUSTENSILE") as $strNameUstensile) {
                if (!in_array($strNameUstensile, array_keys(ALL_USTENSILE))){
                    $bFormIsValid = false;
                }
            }
        }

        return $bFormIsValid;
    }

    public function editRecette():Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "NOT IMPLEMENTED YET",
        );

        if (!empty($this->request->getPost())) {
            if ($this->__validateRecetteForm()) {
                $recetteModel = model("RecetteModel");
                // TODO : get recette before trying to update it
                $aParamsUpdate = array(
                    "REC_NOM"              => $this->request->getPost("REC_NOM"),
                    "REC_DUREE"            => $this->request->getPost("REC_DUREE"),
                    "REC_PHOTO"            => "Not implemented yet",
                    "REC_LISTE_USTENSILE"  => $this->request->getPost("REC_LISTEUSTENSILE"),
                    "REC_NB_PERSONNE_BASE" => $this->request->getPost("REC_NBPERSONNE"),
                );
                $bUpdated = $recetteModel->update($this->request->getPost("REC_ID"), $aParamsUpdate);
                if ($bUpdated) {
                    $aReturn['success'] = true;
                    $aReturn['error_message'] = "";
                    // pour le moment j'envoie pas les datas car je vais recharger la page
                } else {
                    $aReturn['error_message'] = "Une erreur est survenue lors de la modification de la recette.";
                }
            } else {
                // si getErrors est pas valide, une vérif à la main n'est pas passée
                if (!empty($this->validator->getErrors())) {
                    $aReturn['error_message'] = "Merci de vérifier les erreurs du formulaire.";
                    $aReturn["form_errors"]   = $this->validator->getErrors();
                } else {
                    $aReturn['error_message'] = "Merci de ne pas modifier la liste des ustensiles.";
                }
            }
        }

        return $this->response->setJSON($aReturn);
    }

    public function addIngredientRecette():Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "Le formulaire n'a pas correctement été envoyé. Merci de recharger la page."
        );

        if (!empty($this->request->getPost())) {
            if ($this->__validateIngredientRecetteForm($aReturn)) {
                $igeModel = model("IngredientRecetteModel");
                $aParamsInsert = array(
                    "ING_ID"     => $this->request->getPost("ING_ID"),
                    "REC_ID"     => $this->request->getPost("REC_ID"),
                    "IGE_NOMBRE" => $this->request->getPost("IGE_NOMBRE"),
                );
                $idIgeInserted = $igeModel->insert($aParamsInsert);

                if ($idIgeInserted > 0) {
                    $aReturn['success']       = true;
                    $aReturn['error_message'] = "";
                } else {
                    $aReturn['error_message'] = "Une erreur est survenue lors de l'ajout de l'ingrédient pour la recette.";
                }
            }
        }

        return $this->response->setJSON($aReturn);
    }

    private function __validateIngredientRecetteForm(array &$response):bool
    {
        $isSuccess = false;

        $recetteModel = model("RecetteModel");
        $ingredientModel = model("IngredientModel");
        $aAllIdIngredient = $ingredientModel->findAllIdActive();

        $aAllRules = array(
            "ING_ID"     => "required|in_list[". implode(",", $aAllIdIngredient)."]",
            "IGE_NOMBRE" => "required|greater_than[0]",
        );
        $bFormIsValid = $this->validateData($this->request->getPost(), $aAllRules);

        if ($bFormIsValid) {
            $aExistingRecette = $recetteModel->find($this->request->getPost("REC_ID"));
            if (!empty($aExistingRecette)) {
                $isSuccess = true;
            } else {
                $response['error_message'] = "Merci de ne pas tricher. Veuiller recharger la page.";
            }
        } else {
            $response['error_message'] = "Merci de vérifier les erreurs du formulaire.";
            $response['form_errors']   = $this->validator->getErrors();
        }

        return $isSuccess;
    }

    public function editIngredientRecette():Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "Le formulaire n'a pas correctement été envoyé. Merci de recharger la page."
        );

        if (!empty($this->request->getPost())) {
            if ($this->__validateIngredientRecetteForm($aReturn)) {
                $igeModel = model("IngredientRecetteModel");
                $aIge = $igeModel->find((int)$this->request->getPost("IGE_ID"));
                if (!empty($aIge) && $aIge["REC_ID"] === (int)$this->request->getPost("REC_ID")) {
                    $bUpdated = $igeModel->update((int)$this->request->getPost("IGE_ID"), array(
                        "ING_ID"     => $this->request->getPost("ING_ID"),
                        "IGE_NOMBRE" => $this->request->getPost("IGE_NOMBRE")
                    ));

                    if ($bUpdated) {
                        $aReturn['success']       = true;
                        $aReturn['error_message'] = "";
                    } else {
                        $aReturn['error_message'] = "Une erreur est survenue lors de la modification.";
                    }
                } else {
                    $aReturn['error_message'] = "Aucun ingrédient de recette trouvé avec les infos envoyées";
                }
            }
        }

        return $this->response->setJSON($aReturn);
    }

    public function deleteIngredientRecette():Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "J'ai po assé d'info pour faire ce que je dois faire :3"
        );

        if (!empty($this->request->getPost()) && (int)$this->request->getPost("IGE_ID") > 0) {
            $igeModel = model("IngredientRecetteModel");
            $aExistingIge = $igeModel->find((int)$this->request->getPost("IGE_ID"));

            if (!empty($aExistingIge)) {
                $bDeleted = $igeModel->delete((int)$this->request->getPost("IGE_ID"));

                if ($bDeleted) {
                    $aReturn['success']       = true;
                    $aReturn['error_message'] = "";
                } else {
                    $aReturn['error_message'] = "J'ai po réussi à suppresser !";
                }
            } else {
                $aReturn['error_message'] = "J'ai po trouvé chef";
            }
        }

        return $this->response->setJSON($aReturn);
    }

    public function addEtape(): Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "Pas les infos pour l'étape :c"
        );

        if (!empty($this->request->getPost())) {
            if ($this->__validateEtapeForm($aReturn)) {
                $etapeModel = model('EtapeModel');
                $aLastEtapeOfRecette = $etapeModel->findLastEtapeOfRecette((int)$this->request->getPost("REC_ID"));

                $aExplodedDuree = explode(":", $this->request->getPost("ETR_DUREE"));
                $intNbSecondFromDuree = ($aExplodedDuree[0] * 60) + $aExplodedDuree[1];
                $intOrdreEtape = (!empty($aLastEtapeOfRecette)?$aLastEtapeOfRecette['ETR_ORDRE']+1:1);
                $idEtapeInserted = $etapeModel->insert(array(
                    "ETR_ORDRE"       => $intOrdreEtape,
                    "ETR_DUREE"       => $intNbSecondFromDuree,
                    "ETR_DESCRIPTION" => $this->request->getPost("ETR_DESCRIPTION"),
                    "REC_ID"          => $this->request->getPost("REC_ID"),
                ));
                if ($idEtapeInserted > 0) {
                    $aReturn['success'] = true;
                    $aReturn['error_message'] = "";
                } else {
                    $aReturn['error_message'] = "Une erreur est survenue lors de l'ajout de l'étape.";
                }
            }
        }

        return $this->response->setJSON($aReturn);
    }

    private function __validateEtapeForm(&$response): bool
    {
        $isSuccess = false;

        // TODO : mettre durée facultatif
        $aAllRules = array(
            "ETR_DUREE"       => "required",
            "ETR_DESCRIPTION" => "required",
            "REC_ID"          => "required",
        );
        $bFormIsValid = $this->validateData($this->request->getPost(), $aAllRules);
        if ($bFormIsValid) {
            $recetteModel = model("RecetteModel");
            $aExistingRecette = $recetteModel->find((int)$this->request->getPost("REC_ID"));

            if (!empty($aExistingRecette)) {
                $isSuccess = true;
            } else {
                $response['error_message'] = "Il n'y a pas de recette pour ces éléments. Dommage.";
            }
        } else {
            $response['error_message'] = "Vérifie les erreurs de formulaire.";
            $response['form_errors'] = $this->validator->getErrors();
        }

        return $isSuccess;
    }

    public function editEtape(): Response
    {
        $aReturn = array(
            "success"       => false,
            "error_message" => "J'ai po assé d'info pour faire ce que je dois faire :3"
        );

        if (!empty($this->request->getPost())) {
            if ($this->__checkFormUpdateEtape()) {
                $etapeModel = model("EtapeModel");
                $aExistingEtape = $etapeModel->find((int)$this->request->getPost("ETR_ID"));

                if (!empty($aExistingEtape)) {
                    $bUpdated = $etapeModel->update((int)$this->request->getPost("ETR_ID"), array(
                        "ETR_DESCRIPTION" => $this->request->getPost("ETR_DESCRIPTION")
                    ));

                    if ($bUpdated) {
                        $aReturn['success']       = true;
                        $aReturn['error_message'] = "";
                    } else {
                        $aReturn['error_message'] = "J'ai po réussi à modifier !";
                    }
                } else {
                    $aReturn['error_message'] = "J'ai po trouvé létap chef";
                }
            } else {
                $aReturn['error_message'] = "Pas bon le formulaire :c";
            }
        }

        return $this->response->setJSON($aReturn);
    }

    private function __checkFormUpdateEtape():bool
    {
        return (int)$this->request->getPost("ETR_ID") > 0
            && $this->request->getPost("ETR_DESCRIPTION") !== "";
    }

    public function addIngredient():Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "J'ai pas reçu le formulaire"
        );

        if (!empty($this->request->getPost())) {
            if ($this->__validateIngredientForm($aReturn)) {
                $ingredientModel = model('IngredientModel');
                $intIdIngredient = $ingredientModel->insert(array(
                    "ING_NOM"             => $this->request->getPost("ING_NOM"),
                    "ING_UNITE"           => $this->request->getPost("ING_UNITE"),
                    "ING_LISTEMOISSAISON" => $this->request->getPost("ING_LISTEMOISSAISON"),
                ));

                if ($intIdIngredient > 0) {
                    $aReturn['success'] = true;
                    $aReturn['error_message'] = "";
                } else {
                    $aReturn['error_message'] = "Une erreur est survenue lors de l'ajout de l'ingrédient.";
                }
            }
        }

        return $this->response->setJSON($aReturn);
    }

    private function __validateIngredientForm(array &$response): bool
    {
        $aAllRules = array(
            "ING_NOM"             => "required",
            "ING_UNITE"           => "required",
            "ING_LISTEMOISSAISON" => "required",
        );
        $isSuccess = $this->validateData($this->request->getPost(), $aAllRules);

        if (!$isSuccess) {
            $response['error_message'] = "Vérifie les erreurs de formulaire.";
            $response['form_errors'] = $this->validator->getErrors();
        }

        return $isSuccess;
    }

    public function editIngredient():Response
    {
        $aReturn = array(
            
        );

        if (!empty($this->request->getPost())) {
            if ($this->__validateIngredientForm($aReturn)) {
                $ingredientModel = model('IngredientModel');
                $aExistingIngredient = $ingredientModel->find($this->request->getPost("ING_ID"));

                if (!empty($aExistingIngredient)) {
                    $bUpdated = $ingredientModel->update($aExistingIngredient['ING_ID'], array(
                        "ING_NOM"             => $this->request->getPost("ING_NOM"),
                        "ING_UNITE"           => $this->request->getPost("ING_UNITE"),
                        "ING_LISTEMOISSAISON" => $this->request->getPost("ING_LISTEMOISSAISON"),
                    ));

                    if ($bUpdated) {
                        $aReturn['success'] = true;
                        $aReturn['error_message'] = "";
                    } else {
                        $aReturn['error_message'] = "Problème de mise à jour de l'ingrédient";
                    }
                } else {
                    $aReturn['error_message'] = "Pas d'ingrédient pour ces infos :/";
                }
            }
        }

        return $this->response->setJSON($aReturn);
    }

    public function desactivateIngredient():Response
    {
        $aReturn = array(
            "success" => false,
        );

        if ($this->request->getPost("id") !== null) {
            $ingredientModel = model('IngredientModel');
            $aIngredientToDelete = $ingredientModel->find($this->request->getPost("id"));

            if (!empty($aIngredientToDelete)) {
                $aReturn['success'] = $ingredientModel->update($this->request->getPost("id"), array(
                    "ING_ACTIVE" => false
                ));
            }
        }

        return $this->response->setJSON($aReturn);
    }

    public function selectListeRecetteSemaine():Response
    {
        $aReturn = array(
            "success" => false,
            "error_message" => "Merci de sélectionner au moins 1 recette"
        );

        if (!empty($this->request->getPost()) && $this->request->getPost("all_recette") !== null) {
            helper("h_utils_helper");
            $recetteModel = model("RecetteModel");

            $aAllRecette = $recetteModel->findAllActive();
            $aAllIdRecette = array_keys(array_group_by_key($aAllRecette, "REC_ID"));
            $aAllRecetteSelected = explode(",", $this->request->getPost("all_recette"));

            if ($this->__checkAllIdRecette($aAllRecetteSelected, $aAllIdRecette)) {
                $semaineModel = model("SemaineModel");
                // TODO : voir pour laisser la possibilité de choisir la semaine qu'on prépare
                $intNewSemaineId = $semaineModel->insert(array(
                    "SEM_NUMERO"     => date('W')+1,
                    "SEM_YEAR"       => date('Y'),
                    "SEM_LISTEREPAS" => $aAllRecetteSelected,
                ));

                if ($intNewSemaineId > 0) {
                    $aReturn['success'] = true;
                    $aReturn['error_message'] = "";
                } else {
                    $aReturn['error_message'] = "N'ai pas pu valider la semaine.";
                }
            }
        }

        return $this->response->setJSON($aReturn);
    }

    private function __checkAllIdRecette(array $recetteSelected, array $allRecette):bool
    {
        $bAllIsOk = true;

        foreach($recetteSelected as $sRecetteId){
            if (!in_array((int)$sRecetteId, $allRecette)) {
                $bAllIsOk = true;
            }
        }

        return $bAllIsOk;
    }
}