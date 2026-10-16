<?php require __DIR__ . "/layout/header.php"; ?>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <h1 class="h3 mb-4"><i class="bi bi-pencil"></i> Modifier l'article n°<?php echo e($data["article"]->art_id); ?></h1>

        <form action="index.php?controller=articles&action=maj" method="post" class="card card-body shadow-sm">
            <input type="hidden" name="id" value="<?php echo e($data["article"]->art_id); ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" required maxlength="100"
                       value="<?php echo e($data["article"]->art_nom); ?>">
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix (€)</label>
                <input type="number" id="prix" name="prix" class="form-control" required min="0" step="0.01"
                       value="<?php echo e($data["article"]->art_prix); ?>">
            </div>
            <div class="mb-3">
                <label for="poid" class="form-label">Poids</label>
                <input type="number" id="poid" name="poid" class="form-control" required min="0" step="0.01"
                       value="<?php echo e($data["article"]->art_poid); ?>">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="index.php?controller=articles&action=gestion" class="btn btn-outline-secondary">Retour</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . "/layout/footer.php"; ?>
