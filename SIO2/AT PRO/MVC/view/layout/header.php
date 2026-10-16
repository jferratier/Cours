<?php
    // Petite fonction d'échappement pour éviter les failles XSS dans les vues
    if(!function_exists('e')){
        function e($valeur){ return htmlspecialchars((string)$valeur, ENT_QUOTES, 'UTF-8'); }
    }
    $action = isset($_GET["action"]) ? $_GET["action"] : "index";
    $connecte = isset($_SESSION["utilisateur"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(isset($data["titre"]) ? $data["titre"] : "PHP MVC"); ?> - Gestion des articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

<?php if($connecte){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="bi bi-box-seam"></i> PHP MVC</a>

        <!-- Bouton burger (visible sur petit écran) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal" aria-expanded="false" aria-label="Afficher le menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'index' ? 'active' : ''; ?>" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'ajout' ? 'active' : ''; ?>"
                       href="index.php?controller=articles&action=ajout"><i class="bi bi-plus-circle"></i> Ajout articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo in_array($action, array('gestion', 'detaille')) ? 'active' : ''; ?>"
                       href="index.php?controller=articles&action=gestion"><i class="bi bi-list-ul"></i> Gérer articles</a>
                </li>
            </ul>
            <span class="navbar-text me-3">
                <i class="bi bi-person-circle"></i>
                <?php echo e($_SESSION["utilisateur"]["prenom"] . " " . $_SESSION["utilisateur"]["nom"]); ?>
            </span>
            <a class="btn btn-outline-light btn-sm" href="index.php?controller=auth&action=logout">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </a>
        </div>
    </div>
</nav>
<?php } ?>

<main class="container flex-grow-1 py-4">
<?php
    // Message "flash" (affiché une seule fois)
    if(isset($_SESSION["message"])){ ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e($_SESSION["message"]); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
<?php   unset($_SESSION["message"]);
    } ?>
