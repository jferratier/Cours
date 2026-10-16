<?php require __DIR__ . "/layout/header.php"; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><i class="bi bi-list-ul"></i> Gérer les articles</h1>
    <a href="index.php?controller=articles&action=ajout" class="btn btn-success btn-sm">
        <i class="bi bi-plus"></i> Nouvel article
    </a>
</div>

<?php if(empty($data["articles"])){ ?>
    <div class="alert alert-info">Aucun article pour le moment.</div>
<?php } else { ?>
<div class="table-responsive">
    <table class="table table-striped table-hover align-middle bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Poids</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data["articles"] as $article) { ?>
            <tr>
                <td><?php echo e($article["art_id"]); ?></td>
                <td><?php echo e($article["art_nom"]); ?></td>
                <td><?php echo e($article["art_prix"]); ?> €</td>
                <td><?php echo e($article["art_poid"]); ?></td>
                <td class="text-end text-nowrap">
                    <a href="index.php?controller=articles&action=detaille&id=<?php echo e($article['art_id']); ?>"
                       class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                    <form action="index.php?controller=articles&action=supprimer" method="post" class="d-inline"
                          onsubmit="return confirm('Supprimer cet article ?');">
                        <input type="hidden" name="id" value="<?php echo e($article['art_id']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>

<?php require __DIR__ . "/layout/footer.php"; ?>
