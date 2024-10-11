<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple PHP+PDO+POO+MVC</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
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


    
    <div class="container">
          
    <div class="col-lg-7">
        <h3>Articles</h3>
        <hr/> 
    </div>
    <section class="col-lg-7" style="height:400px;">
        <!-- $article["nom"]; -> $article["art_nom"]; -->
        <?php foreach($data["articles"] as $article) {?>
            <?php echo $article["art_nom"]; ?> - 
            <?php echo $article["art_prix"]; ?> - 
            <?php echo $article["art_poid"]; ?> - 
            <div class="right">
                <a href="index.php?controller=articles&action=suppression&id=<?php echo $article['art_id']; ?>" 
                class="btn btn-danger">
                    <i class="fa fa-trash" style="font-size:20px;"></i>
                </a>
                <a href="index.php?controller=articles&action=detail&id=<?php echo $article['art_id']; ?>" 
                class="btn btn-info">
                detail
                </a>  
        </div>
        <hr/>
        <?php } ?>
    </section>
        </div>
    <?php 
    include 'composantsView/footer.php';
    ?>
</body>
</html>