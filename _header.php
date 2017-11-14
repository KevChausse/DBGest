<?php

    include_once('functions.php');
    $path = 'http://'.$_SERVER['HTTP_HOST'].'/DBGest/';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DBGest</title>
        <link rel="stylesheet" href="<?php echo $path; ?>scripts/bootstrap/css/bootstrap.min.css">
        <script src="<?php echo $path; ?>scripts/jquery.js"></script>
        <script src="<?php echo $path; ?>scripts/bootstrap/js/bootstrap.min.js"></script>
    
    </head>

    <body>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default"> 
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo $path; ?>index.php">DBGest - Outils de gestion de base de données</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li> <a href="<?php echo $path; ?>index.php">Accueil</a> </li> 
                        <li> <a href="<?php echo $path; ?>search/search.php">Rechercher</a> </li> 
                        <li> <a href="<?php echo $path; ?>replace/replace.php">Remplacer</a> </li>
                        <li> <a href="<?php echo $path; ?>replace/list.php">Colonnes à remplacer</a> </li>
                        <li> <a href="<?php echo $path; ?>params/params.php">Paramètres de l'application</a> </li>
                        <li> <a href="<?php echo $path; ?>replace/logs.php">Logs</a> </li>
                    </ul>
                </nav>
            </div>
        </div>