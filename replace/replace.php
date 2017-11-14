<?php

    include_once('../_header.php');

    include_once('../class/replace.class.php');

    $replace = new Replace();

    $results = $replace->test();

    $status = $results['status'];

    $type = $results['type'];
?>


    <div class="container" id="c1">
    
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <center><h1>Fonctions de remplacement de colonnes:</h1></center><br/>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <a href="_start.php" type="button" class="<?php if($type=="start" || $type=="none") echo "launch ";?>btn btn-primary btn-block"<?php if($type == "reverse") echo " disabled=\"disabled\" onclick=\"return false;\""; ?>>Lancer le changement de noms</a><br/>

            </div>
        </div>&nbsp;
    
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <a href="_reverse.php" type="button" class="<?php if($type=="reverse" || $type=="none") echo "launch ";?>btn btn-primary btn-block" <?php if($type == "start") echo " disabled=\"disabled\" onclick=\"return false;\""; ?>>Annuler le changement de noms</a><br/>
            </div>
        </div>&nbsp;

        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <center><h2>Résultats du test de fonctionnement</h2></center><br/>
            
<?php

    if($status == 0){
        echo "<div class=\"alert alert-success\" role=\"alert\"><span class=\"glyphicon glyphicon-ok-sign\" aria-hidden=\"true\"></span> Aucune erreur à signaler.</div>";
    }
    if($status == 1){
        echo "<div class=\"alert alert-warning\" role=\"alert\"><span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span> Attention, des erreurs peuvent survenir au lancement du script. <a href=\"list.php\" class=\"alert-link\">Voir les erreurs</a></div>";
    }
    if($status == 2){
        echo "<div class=\"alert alert-danger\" role=\"alert\"><span class=\"glyphicon glyphicon-remove-sign\" aria-hidden=\"true\"></span> Attention, si vous lancez le script, des erreurs vont survenir ! <a href=\"list.php\" class=\"alert-link\">Voir les erreurs</a></div>";
    }

?>
            </div>
        </div>&nbsp;
    </div>

    <div class="container" id="c2">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <center><h1>Replacement des colonnes en cours ...</h1>&nbsp;
                <p>Ne pas recharger la page durant l'exécution</p></center>
            </div>
        </div>
    </div>


    <script>

        $('#c2').hide();

        $('.launch').click(function(){

            $('#c2').show();
            $('#c1').hide();
        });

    </script>

<?php

    include_once('../_footer.php');

?>