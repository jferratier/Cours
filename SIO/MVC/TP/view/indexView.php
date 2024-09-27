<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple PHP+PDO+POO+MVC</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
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
    <form action ="index.php?controller=articles&action=creer" 
    method ="post" class="col-lg-5">
        <h3>Add article</h3>
        Nom: <input type="text" name="nom" class="form-control">
        Poid: <input type="text" name="poid" class="form-control">
        Prix: <input type="text" name="prix" class="form-control">
        <input type="submit" value="Send" class="btn btn-success"/>
    </form>

    <div class="col-lg-7">
        <h3>Articles</h3>
        <hr/> 
    </div>
    
    <section class="col-lg-7" style="height:400px;overflow-y:scroll;">
        <!-- $article["nom"]; -> $article["art_nom"]; -->
        <?php foreach($data["articles"] as $article) {?>
            <?php echo $article["art_nom"]; ?> - 
            <?php echo $article["art_prix"]; ?> - 
            <?php echo $article["art_poid"]; ?> - 
            <div class="right">
                <a href="index.php?controller=articles&action=detail&id=<?php echo $article['art_id']; ?>" 
                class="btn btn-info">
                detail
                </a>  
        </div>
        <hr/>
        <?php } ?>
    </section>
</body>
</html>