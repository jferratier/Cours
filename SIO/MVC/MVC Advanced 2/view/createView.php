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
        <form action ="index.php?controller=articles&action=creer" 
        method ="post" class="col-lg-5">
            <h3>Add article</h3>
            Nom: <input type="text" name="nom" class="form-control">
            Poid: <input type="text" name="poid" class="form-control">
            Prix: <input type="text" name="prix" class="form-control">
            <input type="submit" value="Send" class="btn btn-success"/>
        </form>
    </div>
    
    <?php 
    include 'composantsView/footer.php';
    ?>
</body>
</html>