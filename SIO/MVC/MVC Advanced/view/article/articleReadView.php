<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["titre"] ?></title>
   <style>
        input{
            margin-top:5px;
            margin-bottom:5px;
        }
        .right{
            float:right;
        }
    </style>
    <?php include "view/header.php"; ?>

</head>
<body>

    <?php include "view/navbar.php"; ?>

    <!--<div class="col-lg-5 mr-auto">-->
    <div class="container mt-3">
        <h3>Article detaillé</h3>
        <hr/>
        <input type="hidden" name="id" value="<?php echo $data["article"]->art_id ?>" />
        Nom: <input type="text"  readonly name="nom" value="<?php echo $data["article"]->art_nom ?>" class="form-control bg-light"  />
        Prix: <input type="text" readonly name="prix" value="<?php echo $data["article"]->art_prix ?>" class="form-control bg-light" />
        Poids: <input type="text" readonly name="poids" value="<?php echo $data["article"]->art_poid ?>" class="form-control bg-light" />

        <a href="index.php?controller=articles&action=edition&id=<?php echo $data["article"]->art_id ?>" class="btn btn-info">Editer</a>
        <a href="index.php?controller=articles&action=delete&id=<?php echo $data["article"]->art_id ?>" class="btn btn-danger">Supprimer</a>
        <a href="index.php?controller=articles&action=getAll" class="btn btn-secondary">Retour</a>
    </div>

</body>
</html>