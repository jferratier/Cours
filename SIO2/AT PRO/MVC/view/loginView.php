<?php require __DIR__ . "/layout/header.php"; ?>

<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-sm mt-5">
            <div class="card-body p-4">
                <h1 class="h4 text-center mb-4"><i class="bi bi-lock"></i> Connexion</h1>

                <?php if(!empty($data["erreur"])){ ?>
                    <div class="alert alert-danger"><?php echo e($data["erreur"]); ?></div>
                <?php } ?>

                <form action="index.php?controller=auth&action=login" method="post">
                    <div class="mb-3">
                        <label for="login" class="form-label">Identifiant</label>
                        <input type="text" id="login" name="login" class="form-control" required autofocus
                               value="<?php echo isset($_POST['login']) ? e($_POST['login']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" id="mdp" name="mdp" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/layout/footer.php"; ?>
