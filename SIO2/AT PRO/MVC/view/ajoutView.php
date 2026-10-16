<?php require __DIR__ . "/layout/header.php"; ?>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <h1 class="h3 mb-4"><i class="bi bi-plus-circle"></i> Ajouter un article</h1>

        <form action="index.php?controller=articles&action=creation" method="post" class="card card-body shadow-sm">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" required maxlength="100">
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix (€)</label>
                <input type="number" id="prix" name="prix" class="form-control" required min="0" step="0.01">
            </div>
            <div class="mb-3">
                <label for="poid" class="form-label">Poids</label>
                <input type="number" id="poid" name="poid" class="form-control" required min="0" step="0.01">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="index.php?controller=articles&action=gestion" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . "/layout/footer.php"; ?>
