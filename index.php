<?php

    include_once('_header.php');

?>

<div class="container">

    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <center><h1>Accès rapides:</h1></center><br/>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <a href="search/search.php" type="button" class="btn btn-primary btn-block">Accès à la recherche de colonnes</a>
        </div>
    </div>&nbsp;

    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <a href="replace/replace.php"  type="button" class="btn btn-primary btn-block">Accès au remplacement des colonnes</a>
        </div>
    </div>&nbsp;

    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <a href="replace/list.php"  type="button" class="btn btn-primary btn-block">Accès à la saisie des colonnes à remplacer</a>
        </div>
    </div>&nbsp;

    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <a href="params/params.php"  type="button" class="btn btn-primary btn-block">Accès aux paramètres de l'application</a>
        </div>
    </div>&nbsp;

    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <a href="replace/logs.php"  type="button" class="btn btn-primary btn-block">Accès au fichier de logs</a>
        </div>
    </div>&nbsp;
</div>


<?php

    include_once('_footer.php');

?>