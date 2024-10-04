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
        <form action="index.php?controller=articles&action=save" method="post">
            <h3>Article detaillé</h3>
            <hr/>
            <input type="hidden" name="id" value="<?php echo $data["article"]->art_id ?>" />
            Nom: <input type="text" name="nom" value="<?php echo $data["article"]->art_nom ?>" class="form-control" />
            Prix: <input type="text" name="prix" value="<?php echo $data["article"]->art_prix ?>" class="form-control" />
            Poids: <input type="text" name="poid" value="<?php echo $data["article"]->art_poid ?>" class="form-control" />
            <input type="submit" value="Modifier" class="btn btn-success"/>
        </form>
        <!--<a href="index.php" class="btn btn-info">Retour</a>
        <a href="index.php?controller=articles&action=getAll" class="btn btn-info">Retour</a>-->
        <a href="index.php?controller=articles&action=read&id=<?php echo $data["article"]->art_id ?>" class="btn btn-info">Retour</a>
    </div>

</body>
</html>