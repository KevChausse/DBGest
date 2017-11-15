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
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Liste des colonnes à remplacer</h4>
                <div class="btn-group pull-right">
                    <a class="btn btn-default pull-right" href="import.php">Importer un fichier</a>
                </div>
            </div>
            
            <table class="table table-hover" id="cols">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom de la table</th>
                        <th>Ancien nom de la colonne</th>
                        <th>Nouveau nom de la colonne</th>
                    </tr>
                </thead>
                <tbody id="results-col">
<?php
                for($i = 0; $i <count($tab); $i++){
                    $res = $replace->test_col($tab[$i]['table'],$tab[$i]['old_name'],$tab[$i]['new_name']);
                    if($res==0){
                        echo "<tr class=\"danger\">";
                    }
                    else echo "<tr class=\"success\">";
                    echo "    <td><b>#".($i+1)."</b></td>";
                    echo "    <td><i>".$tab[$i]['table']."</i></td>";
                    if($res==1){
                        echo "    <td><i>".$tab[$i]['old_name']."</i></td>";
                    }
                    else {
                        echo "    <td>".$tab[$i]['old_name']."</td>";
                    }
                    if($res==2){
                        echo "    <td><i>".$tab[$i]['new_name']."</i></td>";
                    }
                    else {
                        echo "    <td>".$tab[$i]['new_name']."</td>";
                    }
                    echo "</tr>";
                }
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
    

<?php

    include_once('../_footer.php');

?>