<?php

    include_once('../_header.php');
    include_once('../class/replace.class.php');

    $replace = new Replace();


    $tab = csv_to_tab('../files/list.csv');
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Importer un fichier CSV</h3>
                </div>
                
                <div class="panel-body">

                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8">

                        <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Fonctionnalité en cours de développement.</div>
                        <div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Le fichier a bien été téléchargé.</div>
                        <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Erreur lors du téléchargement du fichier.</div>
                        <form method="post" action="_import.php">
                            <fieldset>

                                <div class="form-group">
                                    <label for="hostname">Fichier à ajouter</label><br/>
                                    <input type="file" name="newfile" placeholder="Nom de l'hôte" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="submit" id="submit" value="Envoyer" class="form-control btn btn-primary">
                                </div>

                                <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Attention, le précédent fichier sera écrasé.</div>
                            </fieldset>
                        </form>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
    

<?php

    include_once('../_footer.php');

?>