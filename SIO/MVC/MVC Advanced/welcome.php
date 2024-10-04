<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple PHP+PDO+POO+MVC</title>
    <style>
        input{
            margin-top:5px;
            margin-bottom:5px;
        }
        .right{
            float:right;
        }
        .center{
            float:center;
        }
    </style>
    <?php include "./view/header.php"; ?>

</head>
<body>

    <?php include "./view/navbar.php"; ?>

    <div class="col-lg-5">
        <h3>Articles</h3>
        <hr/> 
        <div class="center">
                <a href="index.php?controller=articles&action=getAll" 
                class="btn btn-info">
                Liste
                </a>                
        </div>
    </div>
    
</body>
</html>