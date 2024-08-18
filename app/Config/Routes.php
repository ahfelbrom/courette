<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// accueil
$routes->get('/', 'SemaineController::showSemaine'); // TODO : peut-être l'accueil plus tard

// recettes
$routes->get('/recette/liste', 'RecetteController::index');
$routes->get('recettes/detail/(:num)', 'RecetteController::detail/$1');
$routes->post('recettes/add_recette', 'AjaxController::addRecette');
$routes->post('recettes/add_ingredient_recette', 'AjaxController::addIngredientRecette');
$routes->post('recettes/edit_recette', 'AjaxController::editRecette');
$routes->post('recettes/edit_ingredient_recette', 'AjaxController::editIngredientRecette');
$routes->post('recettes/delete_ingredient_recette', 'AjaxController::deleteIngredientRecette');
$routes->post('recettes/add_etape', 'AjaxController::addEtape');
$routes->post('recettes/edit_etape', 'AjaxController::editEtape');

// ingredients
$routes->get('ingredients/liste', 'IngredientController::index');
$routes->post('ingredients/add_ingredient', 'AjaxController::addIngredient');
$routes->post('ingredients/edit_ingredient', 'AjaxController::editIngredient');
$routes->post('ingredients/desactivate_ingredient', 'AjaxController::desactivateIngredient');

// semaine
$routes->get('semaine/preparation_repas', 'SemaineController::index');
$routes->get('semaine/liste', 'SemaineController::listAllSemaine');
$routes->post('semaine/select_recette_semaine', 'AjaxController::selectListeRecetteSemaine');
