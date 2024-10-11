<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple PHP+PDO+POO+MVC</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> <!-- Correction ajout CSS bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> <!-- Correction ajout JS bootstrap -->
    <style>
        input{
            margin-top:5px;
            margin-bottom:5px;
        }
        .right{
            float:right;
        }
    </style>
</head>
<body>
    <?php 
    include 'composantsView/menu.php';
    ?>

    <?php 
    include 'composantsView/panelPresentation.php';
    ?>

    <div class="col-lg-5 mr-auto">
        <form action="index.php?controller=articles&action=maj" method="post">
            <h3>Article detaillé</h3>
            <hr/>
            <input type="hidden" name="id" value="<?php echo $data["article"]->art_id ?>" />
            Nom: <input type="text" name="nom" value="<?php echo $data["article"]->art_nom ?>" class="form-control" />
            Prix: <input type="text" name="prix" value="<?php echo $data["article"]->art_prix ?>" class="form-control" />
            Poid: <input type="text" name="poid" value="<?php echo $data["article"]->art_poid ?>" class="form-control" />
            <input type="submit" value="Modifier" class="btn btn-sucess"/>
        </form>
        <form action="index.php?controller=articles&action=suppression" method="post">
            <input type="hidden" name="id" value="<?php echo $data["article"]->art_id ?>" />
            
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash" style="font-size:20px;"></i>
            </button>
        </form>
        <a href="index.php" class="btn btn-info">Retour</a>
    </div>
    <?php 
    include 'composantsView/footer.php';
    ?>
</body>
</html>