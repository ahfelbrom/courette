<?php

namespace App\Controllers;

class IngredientController extends BaseController
{
    public function index(): string
    {
        $ingredientModel = model("IngredientModel");

        parent::setJsFiles(array(
            base_url("js/ingredient/liste.js")
        ));
        return parent::showView('ingredient/index', array(
            "aAllIngredient" => $ingredientModel->findAllActive()
        ));
    }
}
