<div class="container text-center">
    <h1>Courette</h1>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="<?= base_url() ?>">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("semaine/preparation_repas") ?>">Préparer la semaine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("recette/liste") ?>">Liste des recettes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("ingredients/liste") ?>">Liste des ingrédients</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
