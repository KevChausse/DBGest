<?php
    set_time_limit(0);
    include_once('../_header.php');
    include_once('../class/replace.class.php');

    $nb_col = 0;

    $nb_success = 0;

    $nb_err = 0;

    $replace = new Replace();

    $replace->start();

    $nb_col = $replace->nb_col;
    $nb_err = $replace->nb_err;
    $nb_success = $replace->nb_success;
    $temps_exec = $replace->temps;
?>


<div class="container">
    
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <center><h1>Status de l'execution - Replace:</h1></center><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <p>
<?php 
    echo "Traitement terminé : ".$nb_col." colonnes a modifier / ".$nb_success." colonnes modifiees / ".$nb_err." erreur(s). <br/> \n";
    echo "Durée de l'execution : ".$temps_exec." secondes<br/> \n";
?> 
                </p><a href="replace.php" type="button" class="btn btn-primary btn-block">Retour</a><br/>
                
            </div>
        </div>
</div>

<?

    include_once('../_footer.php');

?>