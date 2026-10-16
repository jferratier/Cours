<?php require __DIR__ . "/layout/header.php"; ?>

<h1 class="h3 mb-4">Bonjour <?php echo e($_SESSION["utilisateur"]["prenom"]); ?></h1>
<p class="text-muted">Il y a actuellement <strong><?php echo (int)$data["nbArticles"]; ?></strong> article(s) en base.</p>

<div class="row g-3">
    <div class="col-12 col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5"><i class="bi bi-plus-circle"></i> Ajout articles</h2>
                <p>Saisir un nouvel article (nom, prix, poids).</p>
                <a href="index.php?controller=articles&action=ajout" class="btn btn-success">Ajouter</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5"><i class="bi bi-list-ul"></i> Gérer articles</h2>
                <p>Consulter, modifier ou supprimer les articles existants.</p>
                <a href="index.php?controller=articles&action=gestion" class="btn btn-primary">Gérer</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/layout/footer.php"; ?>
